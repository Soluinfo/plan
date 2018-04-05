<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Proyecto;
use App\Actividad;
use App\Actividadfechafinal;
use App\Actividadresponsable;

class ActividadHelper {

    public static function obtenerArrayActividad($objetoActividad){
        $datosDeActividad = array();
        if(isset($objetoActividad)){
            foreach($objetoActividad as $p){
                $datosDeActividad['IDACTIVIDAD'] = $p->IDACTIVIDAD;
                $datosDeActividad['IDPROYECTO'] = $p->IDPROYECTO;
                $datosDeActividad['NOMBREACTIVIDAD'] = $p->NOMBREACTIVIDAD;
                $datosDeActividad['NOMBREPROYECTO'] = $p->NOMBREPROYECTO;
                $datosDeActividad['IDINDICADORES'] = $p->IDINDICADORES;
                $datosDeActividad['IDOBJETIVOESTRATEGICO'] = $p->IDOBJETIVOESTRATEGICO;
                $datosDeActividad['OBJETIVO'] = $p->nombreobjetivo;
                $datosDeActividad['INDICADOR'] = $p->nombreindicador;
                $datosDeActividad['progreso'] = $p->progreso;
                $datosDeActividad['ESTADO'] = $p->ESTADO;
                $datosDeActividad['created_at'] = $p->created_at;
                $datosDeActividad['updated_at'] = $p->updated_at;
                $datosDeActividad['IDDIRECTORIOACTIVIDAD'] = $p->IDDIRECTORIOACTIVIDAD;
                $datosDeActividad['PORCENTAJEACTIVIDAD'] = $p->PORCENTAJEACTIVIDAD;
                $datosDeActividad['FECHAINICIALACTIVIDAD'] = $p->FECHAINICIALACTIVIDAD;
                $datosDeActividad['FECHAFINALACTIVIDAD'] = $p->FECHAFINALACTIVIDAD;
            }
        }
        return $datosDeActividad;
    }

    public static function obtener($id = null){
        if($id == null){
            $actividad = Actividad::join('objetivosestrategicos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','actividades.IDOBJETIVOESTRATEGICO')
                                    ->join('indicadores','actividades.IDINDICADORES', '=', 'indicadores.IDINDICADORES')
                                    ->join('proyectos','proyectos.IDPROYECTO','=','actividades.IDPROYECTO')
                                    ->select('actividades.*','objetivosestrategicos.DESCRIPCION as nombreobjetivo','indicadores.DESCRIPCION as nombreindicador','proyectos.NOMBREPROYECTO','proyectos.IDDIRECTORIO')
                                    ->get();
        }else{
            $actividad = Actividad::join('objetivosestrategicos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','actividades.IDOBJETIVOESTRATEGICO')
                                ->join('indicadores','actividades.IDINDICADORES', '=', 'indicadores.IDINDICADORES')
                                ->join('proyectos','proyectos.IDPROYECTO','=','actividades.IDPROYECTO')                 
                                ->where('IDACTIVIDAD',$id)
                                ->select('actividades.*','objetivosestrategicos.DESCRIPCION as nombreobjetivo','indicadores.DESCRIPCION as nombreindicador','proyectos.NOMBREPROYECTO','proyectos.IDDIRECTORIO')
                                ->get();
        }
        return $actividad;
    }

    public static function obtenerActividadesProyecto($IDPROYECTO,$ESTADO){
        $actividad = Actividad::join('objetivosestrategicos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','actividades.IDOBJETIVOESTRATEGICO')
                                    ->join('indicadores','actividades.IDINDICADORES', '=', 'indicadores.IDINDICADORES')
                                    ->where(['IDPROYECTO' => $IDPROYECTO, 'ESTADO' => $ESTADO])
                                    ->select('actividades.*','objetivosestrategicos.DESCRIPCION as nombreobjetivo','indicadores.DESCRIPCION as nombreindicador')
                                    ->get();
        return $actividad;
    }

   

    public static function obtenerfechasDeActividad($id = null){
        $fechasActividades = Actividadfechafinal::where(['IDACTIVIDAD' => $id,'ESTADOACTIVIDADFECHA' => '1'])
                                                ->select('IDACTIVIDADFECHAFINAL','IDACTIVIDAD','FECHAINICIALACTIVIDAD','FECHAFINALACTIVIDAD','ESTADOACTIVIDADFECHA')
                                                ->get();
        return $fechasActividades;
    }

    public static function existeFechaActividad($id = null){
        $numerofechasActividades = Actividadfechafinal::where(['IDACTIVIDAD' => $id,'ESTADOACTIVIDADFECHA' => '1'])
                                                ->count();
        return $numerofechasActividades;
    }

    public static function obtenerValorMaxPorcentaje($idproyecto,$idactividad = null){
        $porcentajemax = 100;
        $porcentajevalidado = 0;
        if($idactividad == null){
            $contadormax = Actividad::where('IDPROYECTO','=', $idproyecto)->get();
        }else{
            $contadormax = Actividad::where([['IDPROYECTO','=', $idproyecto],['IDACTIVIDAD','<>',$idactividad]])->get();
        }
        
        if($contadormax){
            foreach($contadormax as $c){
                $porcentajevalidado = $porcentajevalidado + $c->PORCENTAJEACTIVIDAD;
            }
        }
        return $porcentajemax - $porcentajevalidado;
    }

    public static function verificarSolicitudesReprogramacion($IDACTIVIDAD){
        $cantidad = Actividadfechafinal::where(['IDACTIVIDAD' => $IDACTIVIDAD,'ESTADOACTIVIDADFECHA' => '3'])->count();
        return $cantidad;
    }

    //verifica si el objetivo esta asignado alguna actividad
    public static function validarObjetivoActividad($idobejtivos,$idproyecto){
        
        $objetivoActividad = Actividad::where(['IDOBJETIVOESTRATEGICO' => $idobejtivos, 'IDPROYECTO' => $idproyecto])->count();
        
        return $objetivoActividad;
    }

    public static function validarIndicadorActividad($idindicador,$idproyecto){
        $indicadorActividad = Actividad::where(['IDINDICADORES' => $idindicador, 'IDPROYECTO' => $idproyecto])->count();
        return $indicadorActividad;
    }

    public static function numeroResponsableActividad($idactividad){
        $numero = Actividadresponsable::where(['IDACTIVIDAD' => $idactividad,'ESTADOACTIVIDADRESPONSABLE' => '1'])->count();
        return $numero;
    }

    public static function obtenerFechasActividad($IDACTIVIDAD){
        $datos = Actividadfechafinal::where('IDACTIVIDAD',$IDACTIVIDAD)->get();
        return $datos;
    }

    public static function arrayFechasActividad($objetoDeActividad){
        $datosDeActividadFecha = array();
        if(isset($objetoDeActividad)){
            foreach($objetoDeActividad as $ofp){
                $datosDeActividadFecha['FECHAINICIALACTIVIDAD'] = $ofp->FECHAINICIALACTIVIDAD;
                $datosDeActividadFecha['FECHAFINALACTIVIDAD'] = $ofp->FECHAFINALACTIVIDAD;
                $datosDeActividadFecha['ESTADOACTIVIDADFECHA'] = $ofp->ESTADOACTIVIDADFECHA;
                $datosDeActividadFecha['OBSERVACION'] = $ofp->OBSERVACION;
            }
        }
        return $datosDeActividadFecha;
    }

}