<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actividad;
use App\Actividadresponsable;
use App\Empleado;
use App\Helpers\ProyectoHelper;
use App\Catalogoindicador;
use App\Objetivo;
use App\Proyecto;
use App\Indicador;
use App\Ambitoinfluencia;
use App\ActividadFechaFinal;

class ActividadController extends Controller
{
    public function home(){
        return view('proyectos.progresoactividades');
        
    }
    public function inicio(){
       
        $actividades = ProyectoHelper::obtenerActividades(null);
        return view('proyectos.actividades',['actividades' => $actividades]);
    }
    public function  crear($id = null){
            $datosDeActividad = array();
            $transaccion = 1;
            if($id == null){

            }else{
                $Actividad = $this->obtener($id);
                if(isset($Actividad)){
                    foreach($Actividad as $p){
                        $datosDeActividad['IDACTIVIDAD'] = $p->IDACTIVIDAD;
                        $datosDeActividad['NOMBREACTIVIDAD'] = $p->NOMBREACTIVIDAD;
                        $datosDeActividad['FECHACREACIONACTIVIDAD'] = $p->FECHACREACIONACTIVIDAD;
                        $datosDeActividad['IDINDICADORES'] = $p->IDINDICADORES;
                        $datosDeActividad['IDOBJETIVOESTRATEGICO'] = $p->IDOBJETIVOESTRATEGICO;
                    }
                }
            }
            
            $indicador = DB::table('catalogoindicadores')->get();
            $supervisores = $this->obtenerSupervisores(null);
            //$catalogo = $this->obtenerCatalogoIndicador(null);
            $objetivo = $this->obtenerObjetivo(null);
            return view('proyectos.crearActividades')->with(['catalogoindicadores' => $indicador,
                                                            'supervisores' => $supervisores,
                                                            'objetivosestrategicos' => $objetivo])
                                                            ->with($datosDeActividad);
        
        
    }
    public function guardar(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
            $idActividad = $r->idactividad;
            
            if($idActividad > 0){
                $actividad = Actividad::where('IDACTIVIDAD', $idActividad)
                                    ->update([
                                    'NOMBREACTIVIDAD' => $r->txtNombre,
                                    'FECHACREACIONACTIVIDAD' => $r->dpFechaActividad,
                                    'IDINDICADORES' => $r->slIndicador,
                                    'IDOBJETIVOESTRATEGICO' => $r->slObjetivo
                                    ]);
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $idActividad;
                $datos['transaccion'] = 'actualizar';
            }else{
                $actividad = new Actividad(array(
                    'NOMBREACTIVIDAD' => $r->txtNombre,
                    'FECHACREACIONACTIVIDAD' => $r->dpFechaActividad,
                    'IDINDICADORES' => $r->slIndicador,
                    'IDOBJETIVOESTRATEGICO' => $r->slObjetivo
                ));
                $actividad->save();
                $id = $actividad->id;
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $id;
                $datos['transaccion'] = 'guardar';
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

public function obtener($id = null){
    if($id == null){
        $actividad = Actividad::join('objetivosestrategicos', 'actividades.IDOBJETIVOESTRATEGICO', '=', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO')
                            
                            ->select('actividades.*','objetivosestrategicos.*')
                            ->get();
    }else{
        $actividad = Actividad::join('objetivosestrategicos', 'actividades.IDOBJETIVOESTRATEGICO', '=', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO')
                            ->where('IDACTIVIDAD',$id)
                            ->select('actividades.*','objetivosestrategicos.*')
                            ->get();
    }
   
    return $actividad;
}
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
                                            ->select('empleado.SERIAL_EPL','empleado.DOCUMENTOIDENTIDAD_EPL','empleado.NOMBRE_EPL','empleado.APELLIDO_EPL','empleado.EMAIL_EPL','empleado.CELULAR_EPL')
                                            ->get();
                                        
        return Datatables($datosderesponsable )
        ->addColumn('action', function ($datosderesponsable ) {
            return '<a onclick="obtenerDetalleResponsable('.$datosderesponsable ->SERIAL_EPL.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                    <a onclick="agregarObjetivos('.$datosderesponsable ->SERIAL_EPL.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
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
//indicadores de la actividad

    
    //$supervisor = ProyectoHelper::obtenerSupervisoresDeProyectos(null);
    //$datos = array_collapse([$proyectos, $supervisor]);
    //$pdf = $dompdf>page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", $font, 10, array(0,0,0));
    //$pdf = App::make('dompdf.wrapper');
    
    //$pdf = PDF::get_canvas();
    //PDF::page_text(1,1, "{PAGE_NUM} of {PAGE_COUNT}", array(0,0,0));
    //tipo de hoja y orientación
    //$pdf->page_text(510, 18, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 6, array(0,0,0));
    //$pdf=PDF::render();
   
    //PDF::AddPage();
    //$pdf->render();
    //$pdf->setPaper('L', 'landscape');
    //$pdf = $this->PageNo();
    

