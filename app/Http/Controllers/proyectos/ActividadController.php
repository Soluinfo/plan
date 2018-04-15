<?php

namespace App\Http\Controllers\proyectos;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Actividad;
use App\Actividadresponsable;
use App\Empleado;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;
use App\Helpers\ActividadHelper;
use App\Helpers\RecursoHelper;
use App\Catalogoindicador;
use App\Objetivo;
use App\Proyecto;
use App\Indicador;
use App\Ambitoinfluencia;
use App\ActividadFechaFinal;
use App\Recurso;
use App\Providers\GoogleDriveServiceProvider;
use App\Recursofechafinal;

class ActividadController extends Controller
{
    public function home(){
        $datosDeProyecto = ProyectoHelper::obtenerProyectos(null);
        return view('proyectos.progresoactividades')
                    ->with(['proyectos' => $datosDeProyecto]);
        
    }

    public function detalleactividades($id = null){
        $Actividades = ActividadHelper::obtener($id);
        $datosDeActividad = ActividadHelper::obtenerArrayActividad($Actividades);
        return view('proyectos.detalleActividad')
                    ->with($datosDeActividad);
    }

   
    //funcion para obtener actividades abiertas en progreso de actividades
    public function obtenerActividadesDeProyecto(Request $r){
        if($r->ajax()){
            $actividadimprimir = '';
            $IDPROYECTO = $r->IDPROYECTO;
            $ESTADO = $r->ESTADO;
            $marcaestado = 'task-info';
            if($ESTADO == 1){
                $marcaestado = 'task-primary';
            }else if($ESTADO == 2){
                $marcaestado = 'task-info';
            }else if($ESTADO == 3){
                $marcaestado = 'task-danger';
            }else if($ESTADO == 4){
                $marcaestado = 'task-success';
            }
            
            $datosDeActividad = ActividadHelper::obtenerActividadesProyecto($IDPROYECTO,$ESTADO);
            
            if(isset($datosDeActividad)){
            //if($datosDeActividad){
                foreach($datosDeActividad as $da){
                    $actividadimprimir .= '
                        <div class="task-item '.$marcaestado.'">                                    
                            <div class="task-text">'.$da->NOMBREACTIVIDAD.'</div>
                            <div class="task-footer">
                            
                            <div class="pull-left"><a onclick="programarFechaActividad('.$da->IDACTIVIDAD.')">1h 45min</a></div>
                            <div class="pull-right"><a onclick="detalleActividad('.$da->IDACTIVIDAD.')"><span class="fa fa-info-circle"></span></a><a onclick="responsablesDeActividad('.$da->IDACTIVIDAD.')"><span class="fa fa-users"></span></a><a onclick="recursoDeActividad('.$da->IDACTIVIDAD.')"><span class="fa fa-cloud-upload"></span></a></div>                                   
                            </div>                                    
                        </div>
                    ';
                }
            }
            echo $actividadimprimir;
            
        }
    }
    //funcion para obtener las fechas de las actividades
    public function obtenerFechaActividad(Request $r){
        if($r->ajax()){
            $objetoactividad = ActividadHelper::obtenerFechasActividad($r->IDACTIVIDAD);
            $datosfechas = ActividadHelper::arrayFechasActividad($objetoactividad);
            echo json_encode($datosfechas);
        }
    }

    public function obtenerDetalleActividadesEnModal(Request $r){
        if($r->ajax()){
            $datos = '';
            $id = $r->IDACTIVIDAD;
            $Actividades = ActividadHelper::obtener($id);
            $datosDeActividad = ActividadHelper::obtenerArrayActividad($Actividades);
            //var_dump($datosDeActividad);
            if($datosDeActividad['IDACTIVIDAD'] != null){
                $datos .= '<a class="list-group-item"><strong>codigo : </strong> '.$datosDeActividad['IDACTIVIDAD'].'</a>';
            }else{
                $datos .= '<a class="list-group-item"><strong>codigo : </strong> </a>';
            }

            if($datosDeActividad['NOMBREACTIVIDAD']){
                $datos .= '<a class="list-group-item"><strong>Nombre de actividad : </strong> '.$datosDeActividad['NOMBREACTIVIDAD'].'</a>';
            }else{
                $datos .= '<a class="list-group-item"><strong>Nombre de actividad : </strong> </a>';
            }

            if($datosDeActividad['NOMBREPROYECTO']){
                $datos .= '<a class="list-group-item"><strong>Proyecto : </strong> '.$datosDeActividad['NOMBREPROYECTO'].'</a>';
            }else{
                $datos .= '<a class="list-group-item"><strong>Proyecto : </strong> </a>';
            }

            if($datosDeActividad['OBJETIVO']){
                $datos .= '<a class="list-group-item"><strong>Objetivo : </strong> '.$datosDeActividad['OBJETIVO'].'</a>';
            }else{
                $datos .= '<a class="list-group-item"><strong>Objetivo : </strong> </a>';
            }

            if($datosDeActividad['INDICADOR']){
                $datos .= '<a class="list-group-item"><strong>Indicador : </strong> '.$datosDeActividad['INDICADOR'].'</a>';
            }else{
                $datos .= '<a class="list-group-item"><strong>Indicador : </strong> </a>';
            }

            echo $datos;
        }
    }

    public function obtenerAvanceActividadmodal(Request $r){
        if($r->ajax()){
            $datos = '';
            $id = $r->IDACTIVIDAD;
            $Actividades = ActividadHelper::obtener($id);
            $datosDeActividad = ActividadHelper::obtenerArrayActividad($Actividades);

            $numeroFechas = ActividadHelper::existeFechaActividad($id);
            if($numeroFechas > 0){
                $fechas = ActividadHelper::obtenerfechasDeActividad($id);
                foreach($fechas as $f){
                    $datos .= '<a class="list-group-item"><strong>Fecha de inicio : </strong>'.$f->FECHAINICIALACTIVIDAD.'</a>';
                    $datos .= '<a class="list-group-item"><strong>Fecha de final : </strong>'.$f->FECHAFINALACTIVIDAD.'</a>';
                }
            }else{
                $datos .= '<a class="list-group-item"><strong>Fecha de inicio : </strong></a>';
                $datos .= '<a class="list-group-item"><strong>Fecha de final : </strong></a>';
            }
            
            $datos .= '<a class="list-group-item"><strong>Estado : </strong>'.$datosDeActividad['ESTADO'].'</a>';
           
            $datos .= '
                <a class="list-group-item"><strong>Avance</strong>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: '.$datosDeActividad['progreso'].'%">'.$datosDeActividad['progreso'].'% Complete</div>
                    </div> 
                </a>
            ';
            echo $datos;
        }
    }

    public function inicio(){
       
        $actividades = ProyectoHelper::obtenerActividades(null);
        return view('proyectos.actividades',['actividades' => $actividades]);
    }
    public function  crear($id = null){
            $datosDeProyecto = ProyectoHelper::obtenerProyectos(null);
            $datosDeActividad = array();
            $transaccion = 1;
            if($id == null){

            }else{
                $Actividad = ActividadHelper::obtener($id);
                $datosDeActividad = ActividadHelper::obtenerArrayActividad($Actividad);
            }
            
            $indicador = DB::table('catalogoindicadores')->get();
            $supervisores = $this->obtenerSupervisores(null);
            //$catalogo = $this->obtenerCatalogoIndicador(null);
            $objetivo = $this->obtenerObjetivo(null);
            return view('proyectos.crearActividades')->with(['catalogoindicadores' => $indicador,
                                                            'supervisores' => $supervisores,
                                                            'objetivosestrategicos' => $objetivo,
                                                            'proyectos' => $datosDeProyecto])
                                                            ->with($datosDeActividad);
    }

    public function guardar(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
            $idActividad = $r->idactividad;

            $infoproyecto = ProyectoHelper::obtenerProyectos($r->slProyecto);
            $datosDeProyecto = ProyectoHelper::obtenerArrayProyecto($infoproyecto);
            //obtener datos de actividad
            $Actividades = ActividadHelper::obtener($idActividad);
            $datosDeActividad = ActividadHelper::obtenerArrayActividad($Actividades);

            $messages = [
                'txtNombre.unique' => 'El nombre de la activadad ya esta en uso',
                'txtPorcentajeActividad.max' => 'El campo porcentaje no puede exceder de :max %',
            ];

            $nombreActividad = $r->txtNombre;
            $nombretemp = str_ireplace(" ", "_", $nombreActividad);
            if($datosDeProyecto['PROGRESODECREACION'] == 100){
                if($idActividad > 0){
                    $valorMaxPorcentajeActividad = ActividadHelper::obtenerValorMaxPorcentaje($r->slProyecto,$idActividad);
                    if($r->txtNombre == $datosDeActividad['NOMBREACTIVIDAD']){
                        $rule = [
                            'txtPorcentajeActividad' => 'numeric|max:'.$valorMaxPorcentajeActividad.'',
    
                        ];
                        $validator = Validator::make($r->all(),$rule,$messages)->validate();
                    }else{
                        $rule = [
                            'txtNombre' => 'unique:actividades,NOMBREACTIVIDAD',
                            'txtPorcentajeActividad' => 'numeric|max:'.$valorMaxPorcentajeActividad.'',
                        ];
                        $validator = Validator::make($r->all(),$rule,$messages)->validate();
                        $nombresinespacion = str_ireplace(" ", "_", $datosDeActividad['NOMBREACTIVIDAD']);
                        $dir1 = '/'.$datosDeActividad['IDDIRECTORIOACTIVIDAD'].'/';
                        $dir2 = '/'.$datosDeProyecto['IDDIRECTORIO'].'/'.$nombretemp.'/';
                        
                        Storage::cloud()->move($dir1, $dir2);
                    }
    
                    $actividad = Actividad::where('IDACTIVIDAD', $idActividad)
                                        ->update([
                                        'NOMBREACTIVIDAD' => $r->txtNombre,
                                        'IDINDICADORES' => $r->slIndicador,
                                        'IDOBJETIVOESTRATEGICO' => $r->slObjetivo,
                                        'IDPROYECTO' => $r->slProyecto,
                                        'PORCENTAJEACTIVIDAD' => $r->txtPorcentajeActividad,
                                        ]);
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $idActividad;
                    $datos['transaccion'] = 'actualizar';
                    $datos['valormaximo'] = $valorMaxPorcentajeActividad;
                }else{
                    
                    $valorMaxPorcentajeActividad = ActividadHelper::obtenerValorMaxPorcentaje($r->slProyecto,null);
                    //reglas de validacion
                    $rule = [
                        'txtNombre' => 'unique:actividades,NOMBREACTIVIDAD',
                        'txtPorcentajeActividad' => 'numeric|max:'.$valorMaxPorcentajeActividad.'',
                    ];
                    //validacion enviara un json con un error 422
                    $validator = Validator::make($r->all(),$rule,$messages)->validate();
                    
                    $iddirectorio2 = '/'.$datosDeProyecto['IDDIRECTORIO'].'/'.$nombretemp.'/';
                    $info = Storage::cloud()->makeDirectory($iddirectorio2);
    
                    if($info){
                        $dir = '/'.$datosDeProyecto['IDDIRECTORIO'].'/';
                        $recursive = false; // Get subdirectories also?
                        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
    
                        $directory = $contents
                        ->where('type', '=', 'dir')
                        ->where('filename', '=', $nombretemp)
                        ->first();
                        $iddirectorioactividad = $directory['path'];
                        
                        $actividad = new Actividad(array(
                            'NOMBREACTIVIDAD' => $r->txtNombre,
                            'IDINDICADORES' => $r->slIndicador,
                            'IDOBJETIVOESTRATEGICO' => $r->slObjetivo,
                            'IDDIRECTORIOACTIVIDAD' => $iddirectorioactividad,
                            'IDPROYECTO' => $r->slProyecto,
                            'ESTADO' => '1',
                            'progreso' => 0,
                            'PORCENTAJEACTIVIDAD' => $r->txtPorcentajeActividad,
                            'FECHAINICIALACTIVIDAD' => $r->dpFechaActividadIncial,
                            'FECHAFINALACTIVIDAD' => $r->dpFechaActividadFinal,
                        ));
                        $actividad->save();
                        $id = $actividad->id;
                        $actividadFechas = new Actividadfechafinal(array(
                            'FECHAINICIALACTIVIDAD' => $r->dpFechaActividadIncial,
                            'FECHAFINALACTIVIDAD' => $r->dpFechaActividadFinal,
                            'IDACTIVIDAD' => $id,
                            'ESTADOACTIVIDADFECHA' => '1',
                            'OBSERVACION' => 'CREACIÓN DE ACTIVIDAD',
                        ));
                        $actividadFechas->save();
                        $datos['respuesta'] = 'ok';
                        $datos['codigo'] = $id;
                        $datos['transaccion'] = 'guardar';
                    }else{
                        $datos['respuesta'] = 'errorgoogle';
                    }
                }
            }else{
                $datos['respuesta'] = 'proyectonocumple';
            }
            
            echo json_encode($datos);
        }
    }
    
    public function guardaractividadFechas(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
            $idActividadFechaFinal = $r->idactividadfechafinal;
    
            if($idActividadFechaFinal > 0){
                $actividadfechafinal = ActividadFechaFinal::where('IDACTIVIDADFECHAFINAL', $idActividadFechaFinal)
                                    ->update([
                                    'IDACTIVIDAD' => $r->idactividad,   
                                    'FECHAINICIALACTIVIDAD' => $r->dpFechaInicialActividad,
                                    'FECHAFINALACTIVIDAD'=> $r->dpFechaFinalActividad,
                                    'ESTADOACTIVIDADFECHA'=> $r->slEstado
                                    
                                    
                                    ]);
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $idActividadFechaFinal;
                $datos['transaccion'] = 'actualizar';
                }else{
                    $actividadfechafinal = new ActividadFechaFinal(array(
                        'IDACTIVIDAD' => $r->idactividad,   
                        'FECHAINICIALACTIVIDAD' => $r->dpFechaInicialActividad,
                        'FECHAFINALACTIVIDAD'=> $r->dpFechaFinalActividad,
                        'ESTADOACTIVIDADFECHA'=> $r->slEstado
                        
                    ));
                    $actividadfechafinal->save();
                    $id = $actividadfechafinal->id;
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $id;
                    $datos['transaccion'] = 'guardar';
                }
                echo json_encode($datos);
            }
        }
    //incion funcion para asignar un supervisor a un proyecto
    public function asignarResponsable(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','mensaje' => '');
            $verificarResponsable = $this->verificarResponsableActividadExiste($r->IDACTIVIDAD,$r->IDRESPONSABLE);
            if($verificarResponsable == true){
                $datos['respuesta'] = 'existe';
                $datos['mensaje'] = 'El Responsable seleccionado ya se encuentra asignado a esta actividad';
            }else{
                $asignacion = new Actividadresponsable([
                    'IDACTIVIDAD' => $r->IDACTIVIDAD,
                    'IDRESPONSABLE' => $r->IDRESPONSABLE,
                    'ESTADOACTIVIDADRESPONSABLE' => '1',
                    'FECHAACTIVIDADRESPONSABLE' => date('Y-m-d')
                ]);
                $asignacion->save();
                $datos['respuesta'] = 'ok';
                $datos['mensaje'] = 'Responsable asignado con exito';
            }
            
            echo json_encode($datos);
        }
    }
    //end funcion asignarSupervisor
    //inicio de funcion para validar si existe supervisor asignado a proyecto
    public function verificarResponsableActividadExiste($idactividad,$idresponsable){
        $datosderesponsable = Actividadresponsable::where([
                                                    ['IDACTIVIDAD','=',$idactividad],
                                                    ['IDRESPONSABLE','=',$idresponsable]
                                                ])
                                                ->count();
        if($datosderesponsable > 0){
            return true;
        }else{
            return false;
        }
    }
    //final de funcion verificarSupervisorProyectoExiste

        //inicio de funcion para obtener todos los empleado o personal que puede ser un supervisor de proyecto
        public function obtenerSupervisores($id = null){
            $supervisores = Empleado::all();
            return $supervisores;
        }
    //final de funcion obtenerSupervisores

    //inicio de function para obtener los catalogos de objetivos
    public function obtenerCatalogoIndicador($id = null){
        $catalogoIndicadores = Catalogoindicador::all();
        return $catalogoIndicadores;
    }
    //final de funcion obtenerCatalgoObjetivos
    public function obtenerObjetivo($id = null){
        $objetivos = Objetivo::all();
        return $objetivos;
    }
    //inicio de funcion para obtener supervisores de una determinada actividad
    public function obtenerResponsablesDeActividad(Request $r){
        if($r->ajax()){
            $datosderesponsable = Empleado::join('actividadesresponsables', 'empleado.SERIAL_EPL', '=', 'actividadesresponsables.IDRESPONSABLE')
                                                ->where('actividadesresponsables.IDACTIVIDAD', '=' ,$r->idactividad)
                                                ->select('actividadesresponsables.IDACTIVIDADRESPONSABLE','empleado.SERIAL_EPL','empleado.DOCUMENTOIDENTIDAD_EPL','empleado.NOMBRE_EPL','empleado.APELLIDO_EPL','empleado.EMAIL_EPL','empleado.CELULAR_EPL')
                                                ->get();
                                            
            return Datatables($datosderesponsable)
            ->removeColumn('IDACTIVIDADRESPONSABLE')
            ->addColumn('action', function ($datosderesponsable) {
                return '<a onclick="obtenerDetalleResponsable('.$datosderesponsable ->IDACTIVIDADRESPONSABLE.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalles!"><i class="fa fa-info-circle"></i></a>
                        <a onclick="eliminarresponsableActidad('.$datosderesponsable ->IDACTIVIDADRESPONSABLE.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminarte!"><i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
        }
    }
    //final de funcion obtenerResponsablesDeActividad
    public function datatableActividad(Request $r){
        $actividadProyeto = Actividad::join('actividades','indicadores.IDINDICADORES','=','actividades.IDINDICADORES')
                                                ->where('actividades.IDACTIVIDAD', $r->idactividad)
                                                ->select('actividades.IDOBJETIVOESTRATEGICO',
                                                        'actividades.NOMBREACTIVIDAD',
                                                        'actividades.FECHACREACIONACTIVIDAD');
            return Datatables($actividadProyeto)
                    ->addColumn('action', function ($indicadoresProyeto) {
                        return '<a onclick="obtenerDetalleObjetivo('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarObjetivoProyecto('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->make(true);
    }

    public function obtenerObjetivosProyectos(Request $r){
        if($r->ajax()){
            $options = '';
            $idproyecto = $r->IDPROYECTO;
            $IDOBJETIVOESTRATEGICO = intval($r->IDOBJETIVOESTRATEGICO);
            
            $objetivosProyeto = ObjetivoHelper::obtenerObjetivosDeProyecto($idproyecto);
            
            if(isset($objetivosProyeto)){
                $options .= '<option value="">';
                $options .= 'Seleccione Objetivo';
                $options .= '</option>';
                foreach($objetivosProyeto as $o){
                    //var_dump($o->IDOBJETIVOESTRATEGICO);
                    if($IDOBJETIVOESTRATEGICO != ''){
                        if($IDOBJETIVOESTRATEGICO == $o->IDOBJETIVOESTRATEGICO){
                            $options .= '<option selected="selected" value="'.$o->IDOBJETIVOESTRATEGICO.'">';
                            $options .= $o->DESCRIPCION;
                            $options .= '</option>';
                        }else{
                            $options .= '<option value="'.$o->IDOBJETIVOESTRATEGICO.'">';
                            $options .= $o->DESCRIPCION;
                            $options .= '</option>';
                        }
                    }else{
                        $options .= '<option value="'.$o->IDOBJETIVOESTRATEGICO.'">';
                        $options .= $o->DESCRIPCION;
                        $options .= '</option>';
                    }
                    
                }
            }else{
                $options .= '<option value="">';
                $options .= 'Seleccione Objetivo';
                $options .= '</option>';
            }
            echo $options;
          
        }
        
    }

    public function obtenerIndicadoresproyectos(Request $r){
        if($r->ajax()){
            $options = '';
            $IDINDICADORES = $r->IDINDICADORES;
            $datosindicador = Indicador::join('proyectosindicadores','proyectosindicadores.IDINDICADOR','indicadores.IDINDICADORES')
                                        ->where('proyectosindicadores.IDPROYECTO','=',$r->IDPROYECTO)
                                        ->get();
            if(isset($datosindicador)){
                $options .= '<option value="">';
                $options .= 'Seleccione Indicador';
                $options .= '</option>';
                foreach($datosindicador as $o){
                    if($IDINDICADORES != ''){
                        if($IDINDICADORES = $r->IDINDICADORES){
                            $options .= '<option selected="selected" value="'.$o->IDINDICADORES.'">';
                            $options .= $o->DESCRIPCION;
                            $options .= '</option>';
                        }else{
                            $options .= '<option value="'.$o->IDINDICADORES.'">';
                            $options .= $o->DESCRIPCION;
                            $options .= '</option>';
                        }
                    }else{
                        $options .= '<option value="'.$o->IDINDICADORES.'">';
                        $options .= $o->DESCRIPCION;
                        $options .= '</option>';
                    }
                }
            }else{
                $options .= '<option value="">';
                $options .= 'Seleccione Indicador';
                $options .= '</option>';
            }
            echo $options;
        }
    }

    public function guardarFechas(Request $r){
        $datos = array('respuesta' => 'no','transaccion' => 'programar');
        $idActividad = $r->idactividad;
        
        if($idActividad > 0){
            $desactualizarfechas = Actividadfechafinal::where('IDACTIVIDAD',$idActividad)
                                                        ->update(['ESTADOACTIVIDADFECHA' => '2']);
            $actividadfechafinal = new Actividadfechafinal(array(
                'FECHAINICIALACTIVIDAD' => $r->dpFechaInicial,
                'FECHAFINALACTIVIDAD' => $r->dpFechaFinal,
                'ESTADOACTIVIDADFECHA' => '1',
                'IDACTIVIDAD' => $idActividad,
            ));
            $actividadfechafinal->save();
           
            $datos['respuesta'] = 'ok';
           
            $datos['transaccion'] = 'programar';
        }
        
        echo json_encode($datos);
    }

    public function datatablesFechasActividades(Request $r){
        $estadofechaactividad = '';
        $fechasactividad = Actividadfechafinal::where('IDACTIVIDAD', $r->idactividad)
                                                ->select('actividadesfechasfinales.IDACTIVIDADFECHAFINAL',
                                                        'actividadesfechasfinales.FECHAINICIALACTIVIDAD',
                                                        'actividadesfechasfinales.FECHAFINALACTIVIDAD',
                                                        'actividadesfechasfinales.ESTADOACTIVIDADFECHA'
                                                    );
           
            return Datatables($fechasactividad)
                    ->removeColumn('ESTADOACTIVIDADFECHA')
                    ->addColumn('ESTADOFECHA', function ($fechasactividad) {
                        if($fechasactividad->ESTADOACTIVIDADFECHA == '1'){
                            return 'ACTIVA';
                        }else{
                            return 'CADUCADA';
                        }
                        
                    })
                    ->addColumn('action', function ($fechasactividad) {
                        return '<a onclick="obtenerDetalleObjetivo('.$fechasactividad->IDACTIVIDADFECHAFINAL.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarfechaActidad('.$fechasactividad->IDACTIVIDADFECHAFINAL.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->make(true);
    }
    //final de funcion verificarSupervisorProyectoExiste
    public function datatablesReproActividad(Request $r){
        if($r->ajax()){
            $datosreproactividad = ActividadFechaFinal::join('actividades', 'actividades.IDACTIVIDAD', '=', 'actividadesfechasfinales.IDACTIVIDAD')
                                                ->where('actividadesfechasfinales.IDACTIVIDAD', '=' ,$r->idactividad)
                                                ->select('actividadesfechasfinales.IDACTIVIDADFECHAFINAL',
                                                'actividadesfechasfinales.FECHAINICIALACTIVIDAD',
                                                'actividadesfechasfinales.FECHAFINALACTIVIDAD',
                                                'actividadesfechasfinales.ESTADOACTIVIDADFECHA')
                                                ->get();
                                            
            return Datatables($datosreproactividad)
            ->addColumn('action', function ($datosreproactividad) {
                return '<a onclick="obtenerDetalleActividad('.$datosreproactividad->IDACTIVIDAD.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                        <a onclick=class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>                   
                        <a onclick="agregarObjetivos('.$datosreproactividad->IDACTIVIDAD.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
            })
            ->make(true);
        }
    }

    public function eliminarResponsableActividad(Request $r){
        if($r->ajax()){
            $eliminar = Actividadresponsable::where(['IDACTIVIDADRESPONSABLE' => $r->IDACTIVIDADRESPONSABLE])
                                            ->delete();
            
            echo 'eliminado';     
        }
    }

    public function eliminarfechasActividad(Request $r){
        if($r->ajax()){
            $eliminar = Actividadfechafinal::where(['IDACTIVIDADFECHAFINAL' => $r->IDACTIVIDADFECHAFINAL])
                                            ->delete();
            
            echo 'eliminado';     
        }
    }

    public function guardarRecursosActividad(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','transaccion' => 'guardar');
            $idActividad = $r->idactividad;

            $Actividades = ActividadHelper::obtener($idActividad);
            $datosDeActividad = ActividadHelper::obtenerArrayActividad($Actividades);

            $nombreRecurso = $r->txtnombrerecurso;
            $nombretemp = str_ireplace(" ", "_", $nombreRecurso);

            $messages = [
                'txtporcentaje.max' => 'El campo porcentaje no puede exceder del :max %',
            ];
            $numeroResponsables  = ActividadHelper::numeroResponsableActividad($idActividad);
            if($numeroResponsables > 0){
                if($idActividad > 0){
                    //verificar si existe carpeta
                    $valorMaxPorcentajeRecurso = RecursoHelper::obtenerValorMaxPorcentaje($idActividad);
                    //reglas de validacion
                    $rule = [
                        'txtporcentaje' => 'numeric|max:'.$valorMaxPorcentajeRecurso.'',
                    ];
                    //validacion enviara un json con un error 422
                    $validator = Validator::make($r->all(),$rule,$messages)->validate();
    
                    $iddirectorio2 = '/'.$datosDeActividad['IDDIRECTORIOACTIVIDAD'].'/'.$nombretemp.'/';
                    $info = Storage::cloud()->makeDirectory($iddirectorio2);
                    $datos['recurso'] = $valorMaxPorcentajeRecurso;
                    
                    if($info){
                        $dir = '/'.$datosDeActividad['IDDIRECTORIOACTIVIDAD'].'/';
                        $recursive = false; // Get subdirectories also?
                        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
    
                        $directory = $contents
                        ->where('type', '=', 'dir')
                        ->where('filename', '=', $nombretemp)
                        ->first();
                        $iddirectoriorecurso = $directory['path'];
                        $agregarrecurso = new Recurso(array(
                            'NOMBRERECURSO' => $r->txtnombrerecurso,
                            'ESTADO' => '1',
                            'IDACTIVIDAD' => $idActividad,
                            'IDDIRECTORIORECURSO' => $iddirectoriorecurso,
                            'PORCENTAJERECURSO' => $r->txtporcentaje,
                        ));
                        $agregarrecurso->save();
                        $agregarrecursofechafinal = new Recursofechafinal(array(
                            'FECHAINICIALRECURSO' => $r->dpFechaInicialRecurso,
                            'FECHAFINALRECURSO' => $r->dpFechaFinalRecurso,
                            'ESTADOFECHASFINALES' => '1',
                            'IDRECURSO' => $agregarrecurso->id,
                        ));
                        $agregarrecursofechafinal->save();
                        $datos['respuesta'] = 'ok';
                    
                        $datos['transaccion'] = 'guardar';
                    }else{
                        $datos['respuesta'] = 'no';
                    }
                    
                }
            }else{
                $datos['respuesta'] = 'actividadincompleta';
            }
            
            echo json_encode($datos);
        }
    }

    public function datatablesrecursosactividades(Request $r){
        if($r->ajax()){
           
            $datosrecurso = Recurso::where('IDACTIVIDAD', $r->idactividad)
                                                    ->select('recursos.IDRECURSO',
                                                            'recursos.NOMBRERECURSO',
                                                            'recursos.IDDIRECTORIORECURSO',
                                                            'recursos.ESTADO',
                                                            'recursos.PORCENTAJERECURSO'
                                                        )
                                                        ->get();
            
                return Datatables($datosrecurso)
                        ->removeColumn('IDDIRECTORIORECURSO')
                       
                        ->addColumn('action', function ($datosrecurso) {
                            return '<a onclick="obtenerDetalleObjetivo()" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                    <a onclick="eliminarfechaActidad()" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                        })
                        ->make(true);
        }
    }

    public function obtenerRecursosActividadesEnModal(Request $r){
        if($r->ajax()){
            $datoshtmlrecursos = '';
            $datosrecursos = Recurso::where('IDACTIVIDAD', $r->IDACTIVIDAD)
                                        ->select('recursos.*')
                                        ->get();
            if(isset($datosrecursos)){
                foreach($datosrecursos as $dr){
                    $datoshtmlrecursos .= '<div id="panel'.$dr->IDRECURSO.'" class="panel panel-';
                    if($dr->ESTADO == '1'){
                        $datoshtmlrecursos .= 'primary';
                    }else if($dr->ESTADO == '2'){
                        $datoshtmlrecursos .= 'warning';
                    }else if($dr->ESTADO == '3'){
                        $datoshtmlrecursos .= 'success';
                    }else{
                        $datoshtmlrecursos .= 'danger';
                    }
                    $datoshtmlrecursos .= '">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a href="#acordion'.$dr->IDRECURSO.'">';
                    $datoshtmlrecursos .= $dr->NOMBRERECURSO;
                    $datoshtmlrecursos .= '         </a> | Estado:
                                                    <span id="span'.$dr->IDRECURSO.'" class="label label-';
                    if($dr->ESTADO == '1'){
                        $datoshtmlrecursos .= 'primary">ABIERTO</span>';
                    }else if($dr->ESTADO == '2'){
                        $datoshtmlrecursos .= 'warning">EN PROGRESO</span>';
                        $datoshtmlrecursos .= '| ACCION: <div class="btn-group btn-group-md">
                                            <button title="APROBAR" onclick="aprobarDocumentoRecurso('.$dr->IDRECURSO.')" class="btn btn-success"><i class="fa fa-check"></i></butto>
                                            <button title="REPROBAR" onclick="desaprobarDocumentoRecurso('.$dr->IDRECURSO.')" class="btn btn-danger"><i class="fa fa-times"></i></button>                                                                                     
                                        </div>';
                    }else if($dr->ESTADO == '3'){
                        $datoshtmlrecursos .= 'success">COMPLETADO</span>';
                        $datoshtmlrecursos .= '| ACCION: <div class="btn-group btn-group-md">
                        <button title="APROBAR" onclick="aprobarDocumentoRecurso('.$dr->IDRECURSO.')" class="btn btn-success"><i class="fa fa-check"></i></butto>
                        <button title="REPROBAR" onclick="desaprobarDocumentoRecurso('.$dr->IDRECURSO.')" class="btn btn-danger"><i class="fa fa-times"></i></button>                                                                                     
                    </div>';
                    }else{
                        $datoshtmlrecursos .= 'danger">ATRASADO</span>';
                        $datoshtmlrecursos .= '| ACCION: <div class="btn-group btn-group-md">
                                            <button title="APROBAR" onclick="aprobarDocumentoRecurso('.$dr->IDRECURSO.')" class="btn btn-success"><i class="fa fa-check"></i></butto>
                                            <button title="REPROBAR" onclick="desaprobarDocumentoRecurso('.$dr->IDRECURSO.')" class="btn btn-danger"><i class="fa fa-times"></i></button>                                                                                     
                                        </div>';
                    }

                    if($dr->EVALUACION == '1'){
                        $datoshtmlrecursos .= '  | Evaluacion <span id="span2'.$dr->IDRECURSO.'" class="label label-primary">SIN ACCION</span>';
                    }else if($dr->EVALUACION == '2'){
                        $datoshtmlrecursos .= '  | Evaluacion <span id="span2'.$dr->IDRECURSO.'" class="label label-success">APROBADO</span>';
                    }else{
                        $datoshtmlrecursos .= '  | Evaluacion <span id="span2'.$dr->IDRECURSO.'" class="label label-danger">REPROBADO</span>';
                    }

                    
                    
                   
                                            
                    $datoshtmlrecursos .= '</h4>';
                    $datoshtmlrecursos .= '</div>';
                    $datoshtmlrecursos .= '<div class="panel-body panel-body-open" id="acordion'.$dr->IDRECURSO.'">';
                    $datoshtmlrecursos .= '<div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Subir documento</label>
                                                    <input id="file-'.$dr->IDRECURSO.'" name="file-'.$dr->IDRECURSO.'" type="file" class="file-loading"/>
                                                </div>
                                            </div>';
                    $datoshtmlrecursos .= '<script>
                                                _token : $("input[name=_token]").val();
                                                
                                                function aprobarDocumentoRecurso(IDRECURSO){
                                                    $.post("'.url('/ProgresoActividad/aprobarRecursoActividad').'",{IDRECURSO:IDRECURSO,_token:_token},function(data){
                                                        if(data = "aprobado"){
                                                            var element = $("#span" + IDRECURSO);
                                                            var element2 = $("#panel" + IDRECURSO);
                                                            var element3 = $("#span2" + IDRECURSO);
                                                            element.attr("class","label label-success").html("COMPLETADO");
                                                            element2.attr("class","panel panel-success");
                                                            element3.attr("class","label label-success").html("APROBADO");
                                                            noty({text: "El recurso fue aprobado", layout: "topRight", type: "success"});
                                                        }
                                                    });
                    
                                                }
                                                function desaprobarDocumentoRecurso(IDRECURSO){
                                                    $.post("'.url('/ProgresoActividad/desaprobarRecursoActividad').'",{IDRECURSO:IDRECURSO,_token:_token},function(data){
                                                        if(data = "desaprobado"){
                                                            var element = $("#span" + IDRECURSO);
                                                            var element2 = $("#panel" + IDRECURSO);
                                                            var element3 = $("#span2" + IDRECURSO);
                                                            element.attr("class","label label-info").html("EN PROGRESO");
                                                            element2.attr("class","panel panel-info");
                                                            element3.attr("class","label label-danger").html("REPROBADO");
                                                            noty({text: "El recurso fue reprobado", layout: "topRight", type: "error"});
                                                        }
                                                    });
                                                    
                                                }
                                                datos = $("#file-'.$dr->IDRECURSO.'").fileinput({
                                                    
                                                    language: "es",
                                                    uploadUrl: "'.url('/ProgresoActividad/subirDocumentoRecurso').'",
                                                    uploadAsync: false,
                                                    minFileCount: 1,
                                                    maxFileCount: 1,
                                                    validateInitialCount: true,
                                                    maxImageWidth: 1200,
                                                    overwriteInitial: false,
                                                    initialPreviewAsData: true,
                                                    initialPreviewFileType: "image",
                                                    resizeImage: true,
                                                   
                                                    uploadExtraData: {
                                                        idrecurso:'.$dr->IDRECURSO.',
                                                        _token: _token,
                                                        nombreInput: "file-'.$dr->IDRECURSO.'",
                                                    },';
                    if($dr->ESTADO == '1'){
                        
                    }else if($dr->ESTADO == '2'){
                                               
                        $datoshtmlrecursos .= "initialPreview: ['".url('fileinput/img/pdf.png')."'],";
                        $datoshtmlrecursos .= "initialPreviewConfig: [{caption: '".$dr->NOMBREARCHIVO."', downloadUrl: '".action('proyectos\ProgresoActividadController@descargarDocumentoRecurso',['id' => $dr->IDRECURSO])."', size: ".$dr->PESODEARCHIVO.", ancho: '20px', clave: ".$dr->IDRECURSO."}],";
                    }else if($dr->ESTADO == '3'){
                        $datoshtmlrecursos .= "initialPreview: ['".url('fileinput/img/pdf.png')."'],";
                        $datoshtmlrecursos .= "initialPreviewConfig: [{caption: '".$dr->NOMBREARCHIVO."', downloadUrl: '".action('proyectos\ProgresoActividadController@descargarDocumentoRecurso',['id' => $dr->IDRECURSO])."', size: ".$dr->PESODEARCHIVO.", ancho: '20px', clave: ".$dr->IDRECURSO."}],";
                    }else{
                        $datoshtmlrecursos .= "initialPreview: ['".url('fileinput/img/pdf.png')."'],";
                        $datoshtmlrecursos .= "initialPreviewConfig: [{caption: '".$dr->NOMBREARCHIVO."', downloadUrl: '".action('proyectos\ProgresoActividadController@descargarDocumentoRecurso',['id' => $dr->IDRECURSO])."', size: ".$dr->PESODEARCHIVO.", ancho: '20px', clave: ".$dr->IDRECURSO."}],";
                    }
                    $datoshtmlrecursos .= '});    
                                        </script>';
                    $datoshtmlrecursos .= '</div>                                
                                        </div>';
                }
            }
            echo $datoshtmlrecursos;
        }
    }

    public function datatablesIndicador(Request $r){
        $indicadoractividad = Indicador::join('actividades','actividades.IDINDICADORES','=','indicadores.IDINDICADORES')
                                                ->where('indicadores.IDINDICADORES', $r->idactividad)
                                                ->select('indicadores.IDINDICADORES',
                                                        'indicadores.LITERAL',
                                                        'indicadores.DESCRIPCION')
                                                        ->get();
            return Datatables($indicadoractividad)
                    ->addColumn('action', function ($indicadoractividad) {
                        return '<a onclick="obtenerDetalleObjetivo('.$indicadoractividad->IDINDICADORES.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarObjetivoProyecto('.$indicadoractividad->IDINDICADORES.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->make(true);
    }
}
