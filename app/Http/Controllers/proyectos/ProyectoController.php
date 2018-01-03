<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proyecto;
use App\Empleado;
use App\Proyectosupervisor;
use App\Catalogoobjetivo;
use App\Objetivoestrategico;
use App\Proyectosobjetivos;


class ProyectoController extends Controller
{
    public function home(){
        $proyectos = $this->obtener(null);
        
        return view('proyectos.proyecto',['proyectos' => $proyectos]);
    }
    //inicio de funcion crear que muestra la vista del formulario de creacion de proyecto
        public function crear($id = null){
            $datosDeProyecto = array();
            $transaccion = 1;
            if($id == null){

            }else{
                $Proyecto = $this->obtener($id);
                if(isset($Proyecto)){
                    foreach($Proyecto as $p){
                        $datosDeProyecto['IDPROYECTO'] = $p->IDPROYECTO;
                        $datosDeProyecto['NOMBREPROYECTO'] = $p->NOMBREPROYECTO;
                        $datosDeProyecto['FECHAPROYECTO'] = $p->FECHAPROYECTO;
                        $datosDeProyecto['ESTADOPROYECTO'] = $p->ESTADOPROYECTO;
                        $datosDeProyecto['SERIAL_DEP'] = $p->SERIAL_DEP;
                    }
                }
            }
            
            $departamentos = DB::table('departamento')->get();
            $supervisores = $this->obtenerSupervisores(null);
            $catalogo = $this->obtenerCatalogoObjetivo(null);
            return view('proyectos.crearProyecto')->with(['departamento' => $departamentos,
                                                            'supervisores' => $supervisores,
                                                            'catalogo' => $catalogo])
                                                            ->with($datosDeProyecto);
        }
    //fin de funcion crear

    //inicio de funcion para guardar proyectos
        public function guardar(Request $r){
            if($r->ajax()){
                $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
                $idProyecto = $r->idproyecto;
                
                if($idProyecto > 0){
                    $proyecto = Proyecto::where('IDPROYECTO', $idProyecto)
                                        ->update([
                                        'NOMBREPROYECTO' => $r->txtnombreProyecto,
                                        'FECHAPROYECTO' => $r->dpFechaProyecto,
                                        'ESTADOPROYECTO' => $r->slEstado,
                                        'IDDEPARTAMENTO' => $r->slDepartamento
                                        ]);
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $idProyecto;
                    $datos['transaccion'] = 'actualizar';
                }else{
                    $proyecto = new Proyecto(array(
                        'NOMBREPROYECTO' => $r->txtnombreProyecto,
                        'FECHAPROYECTO' => $r->dpFechaProyecto,
                        'ESTADOPROYECTO' => $r->slEstado,
                        'IDDEPARTAMENTO' => $r->slDepartamento
                    ));
                    $proyecto->save();
                    $id = $proyecto->id;
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $id;
                    $datos['transaccion'] = 'guardar';
                }
                
                echo json_encode($datos);
            }
        }
    //fin de funcion guardar

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
                                                    ->select('empleado.SERIAL_EPL','empleado.DOCUMENTOIDENTIDAD_EPL','empleado.NOMBRE_EPL','empleado.APELLIDO_EPL','empleado.EMAIL_EPL','empleado.CELULAR_EPL')
                                                    ->get();
                                                
                return Datatables($datosdesupervisor)
                ->addColumn('action', function ($datosdesupervisor) {
                    return '<a onclick="agregarObjetivos('.$datosdesupervisor->SERIAL_EPL.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                            <a onclick="agregarObjetivos('.$datosdesupervisor->SERIAL_EPL.')" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar!"><i class="fa fa-edit"></i></a>
                            <a onclick="agregarObjetivos('.$datosdesupervisor->SERIAL_EPL.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                })
                ->make(true);
            }
        }
    //final de funcion obtenerSupervisoresDeProyecto

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
  
    public function datatableObjetivo(Request $r){
        $obtenerObjetivos = Objetivoestrategico::where('IDCATALOGOOBJETIVO',$r->idcatalogo)
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

    public function datatableObjetivosProyecto(Request $r){
        $objetivosProyeto = Objetivoestrategico::join('proyectosobjetivos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','proyectosobjetivos.IDOBJETIVOESTRATEGICO')
                                                ->where('proyectosobjetivos.IDPROYECTO', $r->idproyecto)
                                                ->select('objetivosestrategicos.IDOBJETIVOESTRATEGICO',
                                                        'objetivosestrategicos.LITERAL',
                                                        'objetivosestrategicos.DESCRIPCION');
            return Datatables($objetivosProyeto)
                    ->addColumn('action', function ($objetivosProyeto) {
                        return '<a onclick="hola('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="hola('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Editar!"><i class="fa fa-edit"></i></a>
                                <a onclick="hola('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
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
                $datos['respuesta'] = 'ok';
                $datos['mensaje'] = 'Objetivo estrategico asignado al proyecto';
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

}
