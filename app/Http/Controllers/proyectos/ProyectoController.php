<?php

namespace App\Http\Controllers\proyectos;

use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Proyecto;
use App\Empleado;
use App\Proyectosupervisor;
use App\Catalogoobjetivo;
use App\Objetivo;
use App\Proyectosobjetivos;
use App\Catalogoindicador;
use App\Indicador;
use App\Proyectoindicador;
use App\Fechaproyecto;
use App\Helpers\ProyectoHelper;
use App\Helpers\ActividadHelper;
use App\Helpers\ObjetivoHelper;
use App\Helpers\IndicadorHelper;
use App\Providers\GoogleDriveServiceProvider;


class ProyectoController extends Controller
{
    public function home(){
        //$proyectos = $this->obtener(null);
        $proyectos = ProyectoHelper::obtenerProyectos(null);
        return view('proyectos.proyecto',['proyectos' => $proyectos]);
    }
    //inicio de funcion crear que muestra la vista del formulario de creacion de proyecto
        public function crear($id = null){
            $datosDeProyecto = array();
            $transaccion = 1;
            if($id == null){

            }else{
                $Proyecto = ProyectoHelper::obtenerProyectos($id);
                $datosDeProyecto = ProyectoHelper::obtenerArrayProyecto($Proyecto);
            }
            
            $departamentos = DB::table('departamento')->get();
            $supervisores = $this->obtenerSupervisores(null);
            $catalogo = $this->obtenerCatalogoObjetivo(null);
            $catalogoindicador = $this->obtenerCatalogoIndicador(null);
            return view('proyectos.crearProyecto')->with(['departamento' => $departamentos,
                                                            'supervisores' => $supervisores,
                                                            'catalogo' => $catalogo,
                                                            'catalogoindicador' => $catalogoindicador
                                                            ])
                                                            ->with($datosDeProyecto);
        }
    //fin de funcion crear

    //inicio de funcion para guardar proyectos
        public function guardar(Request $r){
            if($r->ajax()){
                $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
                $idProyecto = $r->idproyecto;
                /* Se obtiene la informacion del proyecto */
                $infoproyecto = ProyectoHelper::obtenerProyectos($idProyecto);
                $datosDeProyecto = ProyectoHelper::obtenerArrayProyecto($infoproyecto);

                $messages = [
                    'txtnombreProyecto.unique' => 'El nombre de proyecto ya esta en uso',
                ];
                
                if($idProyecto > 0){
                    $nombretemp1 = str_ireplace(" ", "_", $datosDeProyecto['NOMBREPROYECTO']);
                    $nombretemp2 = str_ireplace(" ", "_", $r->txtnombreProyecto);
                    if($r->txtnombreProyecto == $datosDeProyecto['NOMBREPROYECTO']){
                        $rule = [
                            
                        ];
                        $validator = Validator::make($r->all(),$rule,$messages)->validate();
                    }else{
                        $rule = [
                            'txtnombreProyecto' => 'unique:proyectos,NOMBREPROYECTO',
                        ];
                        $validator = Validator::make($r->all(),$rule,$messages)->validate();

                        $dir = '/';
                        $recursive = false; // Get subdirectories also?
                        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
                        $directory = $contents
                            ->where('type', '=', 'dir')
                            ->where('filename', '=', $nombretemp1)
                            ->first(); // there can be duplicate file names!
                        Storage::cloud()->move($directory['path'], $nombretemp2);
                    }
                    
                    $proyecto = Proyecto::where('IDPROYECTO', $idProyecto)
                                        ->update([
                                        'NOMBREPROYECTO' => $r->txtnombreProyecto,
                                        /*'FECHAPROYECTO' => $r->dpFechaProyecto,
                                        'FECHAFINAL' => $r->dpFechaFinalProyecto,*/
                                        'ESTADOPROYECTO' => $r->slEstado,
                                        'IDDEPARTAMENTO' => $r->slDepartamento
                                        ]);
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $idProyecto;
                    $datos['transaccion'] = 'actualizar';
                }else{
                    //$nombretemp1 = str_ireplace(" ", "_", $datosDeProyecto['NOMBREPROYECTO']);
                    $nombretemp2 = str_ireplace(" ", "_", $r->txtnombreProyecto);
                    //reglas de validacion
                    $rule = [
                        'txtnombreProyecto' => 'unique:proyectos,NOMBREPROYECTO',
                    ];
                    //validacion enviara un json con un error 422
                    $validator = Validator::make($r->all(),$rule,$messages)->validate();

                    $iddirectorio = '';
                    $nombreProyecto = $r->txtnombreProyecto;
                    $info = Storage::cloud()->makeDirectory($nombretemp2);
                    if($info){
                        $dir = '/';
                        $recursive = false; // Get subdirectories also?
                        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

                        $directory = $contents
                        ->where('type', '=', 'dir')
                        ->where('filename', '=', $nombretemp2)
                        ->first();
                        $iddirectorio = $directory['path'];
                        $proyecto = new Proyecto(array(
                            'NOMBREPROYECTO' => $nombreProyecto,
                            'FECHAPROYECTO' => $r->dpFechaProyecto,
                            'FECHAFINAL' => $r->dpFechaFinalProyecto,
                            'ESTADOPROYECTO' => $r->slEstado,
                            'IDDEPARTAMENTO' => $r->slDepartamento,
                            'IDDIRECTORIO' => $iddirectorio,
                            'PROGRESODECREACION' => 50
                        ));
                        $proyecto->save();
                        $id = $proyecto->id;
                        $fechaproyecto = new Fechaproyecto(
                            array(
                                'FECHAINICIAL' => $r->dpFechaProyecto,
                                'FECHAFINAL' => $r->dpFechaFinalProyecto,
                                'IDPROYECTO' => $id,
                                'ESTADOFECHAP' => '1',
                                'OBSEVACIONP' => 'CREACION DE PROYECTO',
                            )
                        );
                        $fechaproyecto->save();
                        $datos['respuesta'] = 'ok';
                        $datos['codigo'] = $id;
                        $datos['path'] = $directory['path'];
                       
                        
                    }else{

                    }
                    
                }                
                echo json_encode($datos);
            }
        }
    //fin de funcion guardar

    public function guardarFechas(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
            $desactualizarfechas = Fechaproyecto::where('IDPROYECTO',$r->idproyecto)
            ->update(['ESTADOFECHAP' => '2']);
            $fechaproyecto = new Fechaproyecto(
                array(
                    'FECHAINICIAL' => $r->dpFechaInicial,
                    'FECHAFINAL' => $r->dpFechaFinal,
                    'IDPROYECTO' => $r->idproyecto,
                    'ESTADOFECHAP' => '1',
                    'OBSEVACIONP' => $r->taobservacion,
                )
            );
            $fechaproyecto->save();
            Proyecto::where('IDPROYECTO',$r->idproyecto)->update(['FECHAPROYECTO' => $r->dpFechaInicial,'FECHAFINAL' => $r->dpFechaFinal]);
            $datos['respuesta'] = 'ok';
            echo json_encode($datos);
        }
    }

    public function obtenerFechasActivasDeProyecto(Request $r){
        if($r->ajax()){
            $objetoProyectoFechas = ProyectoHelper::obtenerFechasActivasProyecto($r->IDPROYECTO);
            $arrayProyectoFechas = ProyectoHelper::obtenerArrayFechasActivasProyecto($objetoProyectoFechas);
            echo json_encode($arrayProyectoFechas);
        }
    }

    //Inicio de funcion para obtener todos los proyecto con su departamento respectivo
        public function obtener($id = null){
            if($id == null){
                $proyectos = Proyecto::join('departamento', 'proyectos.IDDEPARTAMENTO', '=', 'departamento.SERIAL_DEP')
                                    
                                    ->select('proyectos.*','departamento.*')
                                    ->get();
            }else{
                $proyectos = Proyecto::join('departamento', 'proyectos.IDDEPARTAMENTO', '=', 'departamento.SERIAL_DEP')
                                    ->where('IDPROYECTO',$id)
                                    ->select('proyectos.*','departamento.*')
                                    ->get();
            }
           
            return $proyectos;
        }
    //fin de funcion obtener

    //inicio de funcion para obtener todos los empleado o personal que puede ser un supervisor de proyecto
        public function obtenerSupervisores($id = null){
            $supervisores = Empleado::all();
            return $supervisores;
        }
    //final de funcion obtenerSupervisores

    //incion funcion para asignar un supervisor a un proyecto
        public function asignarSupervisor(Request $r){
            if($r->ajax()){
                $datos = array('respuesta' => 'no','mensaje' => '');
                $verificarSupervisor = $this->verificarSupervisorProyectoExiste($r->IDPROYECTO,$r->IDSUPERVISOR);
                if($verificarSupervisor == true){
                    $datos['respuesta'] = 'existe';
                    $datos['mensaje'] = 'El supervisor seleccionado ya se encuentra asignado a este proyecto';
                }else{
                    $asignacion = new Proyectosupervisor([
                        'IDPROYECTO' => $r->IDPROYECTO,
                        'IDSUPERVISOR' => $r->IDSUPERVISOR,
                        'ESTADO' => '1',
                        'FECHAPROYECTOSUPERVISOR' => date('Y-m-d')
                    ]);
                    $asignacion->save();
                    $Proyecto = ProyectoHelper::obtenerProyectos($r->IDPROYECTO);
                    $datosDeProyecto = ProyectoHelper::obtenerArrayProyecto($Proyecto);
                    $suma = $datosDeProyecto['PROGRESODECREACION'] + 20;
                    $cantidadSupervisor = ProyectoHelper::numeroSupervisoresProyecto($r->IDPROYECTO);
                    if($cantidadSupervisor > 1){

                    }else{
                        Proyecto::where('IDPROYECTO',$r->IDPROYECTO)->update(['PROGRESODECREACION' => $suma]);
                    }
                    $datos['respuesta'] = 'ok';
                    $datos['mensaje'] = 'Supervisor asignado con exito';
                }
                
                echo json_encode($datos);
            }
        }
    //end funcion asignarSupervisor
    
    //inicio de funcion para obtener supervisores de un determinado proyecto
        public function obtenerSupervisoresDeProyecto(Request $r){
            if($r->ajax()){
                $datosdesupervisor = Empleado::join('proyectosupervisor', 'empleado.SERIAL_EPL', '=', 'proyectosupervisor.IDSUPERVISOR')
                                                    ->where('proyectosupervisor.IDPROYECTO', '=' ,$r->idproyecto)
                                                    ->select('proyectosupervisor.IDPROYECTO','empleado.SERIAL_EPL','empleado.DOCUMENTOIDENTIDAD_EPL','empleado.NOMBRE_EPL','empleado.APELLIDO_EPL','empleado.EMAIL_EPL','empleado.CELULAR_EPL')
                                                    ->get();
                                                
                return Datatables($datosdesupervisor)
                ->removeColumn('IDPROYECTO')
                ->addColumn('action', function ($datosdesupervisor) {
                    return '<a onclick="obtenerDetalleSupervisor('.$datosdesupervisor->SERIAL_EPL.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                            <a onclick="eliminarSupervisorProyecto('.$datosdesupervisor->SERIAL_EPL.','.$datosdesupervisor->IDPROYECTO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                })
                ->make(true);
            }
        }
    //final de funcion obtenerSupervisoresDeProyecto

    public function eliminarProyectoSupervisor(Request $r){
        $eliminar = Proyectosupervisor::where(['IDSUPERVISOR' => $r->IDSUPERVISOR, 'IDPROYECTO' => $r->IDPROYECTO])
        ->delete();

        echo 'eliminado';     
    }

    //inicio de funcion para validar si existe supervisor asignado a proyecto
        public function verificarSupervisorProyectoExiste($idproyecto,$idsupervisor){
            $datosdesupervisor = Proyectosupervisor::where([
                                                        ['IDPROYECTO','=',$idproyecto],
                                                        ['IDSUPERVISOR','=',$idsupervisor]
                                                    ])
                                                    ->count();
            if($datosdesupervisor > 0){
                return true;
            }else{
                return false;
            }
        }
    //final de funcion verificarSupervisorProyectoExiste

    //inicio de function para obtener los catalogos de objetivos
        public function obtenerCatalogoObjetivo($id = null){
            $catalogoObjetivos = Catalogoobjetivo::all();
            return $catalogoObjetivos;
        }
    //final de funcion obtenerCatalgoObjetivos
        public function obtenerCatalogoIndicador($id = null){
            $catalogoIndicador = Catalogoindicador::all();
            return $catalogoIndicador;
        }
    //inicio funcion para obtener catalogos indicadores

    //final funcion para obtener catalogos indicadores
  
    public function datatableObjetivo(Request $r){
        $obtenerObjetivos = Objetivo::where('IDCATALOGOOBJETIVO',$r->idcatalogo)
                                                        ->select('IDOBJETIVOESTRATEGICO',
                                                            'LITERAL',
                                                            'DESCRIPCION'
                                                        );
                                                    
        return Datatables($obtenerObjetivos)
                    ->addColumn('action', function ($obtenerObjetivos) {
                        return '<a onclick="agregarObjetivos('.$obtenerObjetivos->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>Agregar</a>';
                    })
                    ->make(true);
    }

    public function datatableIndicador(Request $r){
        $obtenerIndicador = Indicador::where('IDCATALOGOINDICADORES',$r->idcatalogo)
                                                        ->select('IDINDICADORES',
                                                            'DESCRIPCION'
                                                        );
                                                    
        return Datatables($obtenerIndicador)
                    ->addColumn('action', function ($obtenerIndicador) {
                        return '<a onclick="asignarIndicador('.$obtenerIndicador->IDINDICADORES.')" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>Agregar</a>';
                    })
                    ->make(true);
    }

    public function datatableObjetivosProyecto(Request $r){
        $idProyecto = $r->idproyecto;
        $objetivosProyeto = Objetivo::join('proyectosobjetivos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','proyectosobjetivos.IDOBJETIVOESTRATEGICO')
                                                ->where('proyectosobjetivos.IDPROYECTO', $r->idproyecto)
                                                ->select('objetivosestrategicos.IDOBJETIVOESTRATEGICO',
                                                        'objetivosestrategicos.LITERAL',
                                                        'objetivosestrategicos.DESCRIPCION',
                                                        'proyectosobjetivos.IDPROYECTO'
                                                    );
            return Datatables($objetivosProyeto)
                    ->addColumn('action', function ($objetivosProyeto) {
                        return '<a onclick="obtenerDetalleObjetivo('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarObjetivoProyecto('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.','.$objetivosProyeto->IDPROYECTO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->removeColumn('IDPROYECTO')
                    ->make(true);
    }

    public function datatableIndicadorProyectos(Request $r){
        $idProyecto = $r->idproyecto;
        $indicadorProyeto = Indicador::join('proyectosindicadores','indicadores.IDINDICADORES','=','proyectosindicadores.IDINDICADOR')
                                                ->where('proyectosindicadores.IDPROYECTO', $r->idproyecto)
                                                ->select('indicadores.IDINDICADORES',
                                                        'indicadores.DESCRIPCION',
                                                        'proyectosindicadores.IDPROYECTO'
                                                    );
            return Datatables($indicadorProyeto)
                    ->addColumn('action', function ($indicadorProyeto) {
                        return '<a onclick="obtenerDetalleIndicador('.$indicadorProyeto->IDINDICADORES.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarIndicadorProyecto('.$indicadorProyeto->IDINDICADORES.','.$indicadorProyeto->IDPROYECTO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->removeColumn('IDPROYECTO')
                    ->make(true);
    }

    public function datatableFechasProyecto(Request $r){
        $idProyecto = $r->idproyecto;
        $fechasProyeto = Fechaproyecto::where('IDPROYECTO', $r->idproyecto)
                                                ->select('proyectofechasfinales.IDPROYECTOFECHAFINAL',
                                                        'proyectofechasfinales.FECHAINICIAL',
                                                        'proyectofechasfinales.FECHAFINAL',
                                                        'proyectofechasfinales.ESTADOFECHAP',
                                                        'proyectofechasfinales.OBSEVACIONP'
                                                    );
            return Datatables($fechasProyeto)
                    ->addColumn('action', function ($fechasProyeto) {
                        return '<a onclick="obtenerDetalleIndicador('.$fechasProyeto->IDPROYECTOFECHAFINAL.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarIndicadorProyecto('.$fechasProyeto->IDPROYECTOFECHAFINAL.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                   
                    ->make(true);
    }

    public function asignarObjetivoProyecto(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','mensaje' => '');
            $verificarObjetivo = $this->verificarObjetivoProyectoExiste($r->IDPROYECTO,$r->IDOBJETIVOESTRATEGICO);
            if($verificarObjetivo == true){
                $datos['respuesta'] = 'existe';
                $datos['mensaje'] = 'El objetivo seleccionado ya se encuentra asignado a este proyecto';
            }else{
                $Proyectosobjetivos = new Proyectosobjetivos(array(
                    'IDPROYECTO' => $r->IDPROYECTO,
                    'IDOBJETIVOESTRATEGICO' => $r->IDOBJETIVOESTRATEGICO,
                ));
                $Proyectosobjetivos->save();
                $Proyecto = ProyectoHelper::obtenerProyectos($r->IDPROYECTO);
                $datosDeProyecto = ProyectoHelper::obtenerArrayProyecto($Proyecto);
                $suma = $datosDeProyecto['PROGRESODECREACION'] + 20;
                
                $cantidadObjetivos = ObjetivoHelper::numeroObjetivosProyecto($r->IDPROYECTO);
                if($cantidadObjetivos > 1){

                }else{
                    Proyecto::where('IDPROYECTO',$r->IDPROYECTO)->update(['PROGRESODECREACION' => $suma]);
                }
                
                $datos['respuesta'] = 'ok';
                $datos['mensaje'] = 'Objetivo estrategico asignado al proyecto';
            }
            
            echo json_encode($datos);
        }
    }

    public function asignarIndicadorProyecto(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','mensaje' => '');
            $verificarIndicador = $this->verficarIndicadorProyectoExiste($r->IDPROYECTO,$r->IDINDICADOR);
            if($verificarIndicador == true){
                $datos['respuesta'] = 'existe';
                $datos['mensaje'] = 'El Indicador seleccionado ya se encuentra asignado a este proyecto';
            }else{
                $Proyectosindicador = new Proyectoindicador(array(
                    'IDPROYECTO' => $r->IDPROYECTO,
                    'IDINDICADOR' => $r->IDINDICADOR,
                ));
                $Proyectosindicador->save();
                $Proyecto = ProyectoHelper::obtenerProyectos($r->IDPROYECTO);
                $datosDeProyecto = ProyectoHelper::obtenerArrayProyecto($Proyecto);
                $suma = $datosDeProyecto['PROGRESODECREACION'] + 20;
                
                $cantidadIndicador = IndicadorHelper::numeroIndicadoresProyecto($r->IDPROYECTO);
                if($cantidadIndicador > 1){

                }else{
                    Proyecto::where('IDPROYECTO',$r->IDPROYECTO)->update(['PROGRESODECREACION' => $suma]);
                }
                $datos['respuesta'] = 'ok';
                $datos['mensaje'] = 'Indicador asignado al proyecto';
            }
            
            echo json_encode($datos);
        }
    }

    //inicio de funcion para validar si existe objetivo asignado a proyecto
        public function verificarObjetivoProyectoExiste($idproyecto,$idobjetivo){
            $datosdeobjetivo = Proyectosobjetivos::where([
                                                        ['IDPROYECTO','=',$idproyecto],
                                                        ['IDOBJETIVOESTRATEGICO','=',$idobjetivo]
                                                    ])
                                                    ->count();
            if($datosdeobjetivo > 0){
                return true;
            }else{
                return false;
            }
        }
    //final de funcion verificarSupervisorProyectoExiste
        public function verficarIndicadorProyectoExiste($idproyecto,$idindicador){
            $datosdeindicadores = Proyectoindicador::where([
                                                            ['IDPROYECTO','=',$idproyecto],
                                                            ['IDINDICADOR','=',$idindicador]
                                                        ])
                                                        ->count();
            if($datosdeindicadores > 0){
                return true;
            }else{
                return false;
            }
        }
    //funcion de validacion si existe proyecto
        public function validarExisteProyecto(Request $r){
            if($r->ajax()){
                
                $respuesta = ProyectoHelper::existeProyecto($r->txtnombreProyecto,$r->IDPROYECTO);
                if($respuesta == true){
                    //return ['valid'=>true, 'messages' => 'Proyecto existe'];
                    echo 'false';
                }else{
                    //return ['valid'=>false];
                    echo 'true';
                }
            }
        }
    //end funcion validacion proyecto
    //funcion para eliminar objetivo de proyecto
    public function eliminarProyectoObjetivo(Request $r){
        if($r->ajax()){
            $validar = ActividadHelper::validarObjetivoActividad($r->IDOBJETIVOESTRATEGICO,$r->IDPROYECTO);
            if($validar > 0){
                echo 'existe';
            }else{
                $eliminar = Proyectosobjetivos::where(['IDOBJETIVOESTRATEGICO' => $r->IDOBJETIVOESTRATEGICO, 'IDPROYECTO' => $r->IDPROYECTO])
                                            ->delete();
                echo 'eliminado'; 
            }         
        }
    }

    public function eliminarIndicadorProyecto(Request $r){
        if($r->ajax()){
            $validar = ActividadHelper::validarIndicadorActividad($r->IDINDICADOR,$r->IDPROYECTO);
            if($validar > 0){
                echo 'existe';
            }else{
                $eliminar = Proyectoindicador::where(['IDINDICADOR' => $r->IDINDICADOR, 'IDPROYECTO' => $r->IDPROYECTO])
                                            ->delete();
            
                echo 'eliminado';  
            } 
        }
    }
    public function obtenerProgresoInformacion(Request $r){
        if($r->ajax()){
            $IDPROYECTO = $r->IDPROYECTO;
            $verificar = ProyectoHelper::verificarProyectoExiste($IDPROYECTO);
            if($verificar == 1){
                $Proyecto = ProyectoHelper::obtenerProyectos($r->IDPROYECTO);
                $datosDeProyecto = ProyectoHelper::obtenerArrayProyecto($Proyecto);
                echo $datosDeProyecto['PROGRESODECREACION'];
            }else{
                echo 0;
            }
        }
    }
}
