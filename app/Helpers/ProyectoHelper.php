<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Proyecto;
use App\Actividad;
use App\Proyectosupervisor;
use App\Fechaproyecto;
 
class ProyectoHelper {
    /**
     * @param int $id
     * 
     * @return object
     */
    
    //Inicio de funcion para obtener todos los proyecto con su departamento respectivo
        public static function obtenerProyectos($id = null){
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

    public static function obtenerArrayProyecto($objetoProyecto){
        $datosDeProyecto = array();
        if(isset($objetoProyecto)){
            foreach($objetoProyecto as $p){
                $datosDeProyecto['IDPROYECTO'] = $p->IDPROYECTO;
                $datosDeProyecto['NOMBREPROYECTO'] = $p->NOMBREPROYECTO;
                $datosDeProyecto['FECHAPROYECTO'] = $p->FECHAPROYECTO;
                $datosDeProyecto['FECHAFINAL'] = $p->FECHAFINAL;
                $datosDeProyecto['ESTADOPROYECTO'] = $p->ESTADOPROYECTO;
                $datosDeProyecto['DESCRIPCION_DEP'] = $p->DESCRIPCION_DEP;
                $datosDeProyecto['IDDIRECTORIO'] = $p->IDDIRECTORIO;
                $datosDeProyecto['progreso'] = $p->progreso;
                $datosDeProyecto['created_at'] = $p->created_at;
                $datosDeProyecto['updated_at'] = $p->updated_at;
                $datosDeProyecto['idusuario'] = $p->idusuario;
                $datosDeProyecto['SERIAL_DEP'] = $p->SERIAL_DEP;
                $datosDeProyecto['PROGRESODECREACION'] = $p->PROGRESODECREACION;
            }
        }
        return $datosDeProyecto;
    }

    public static function existeProyecto($nombre,$idproyecto){
        $resultado = false;
        $respuesta = Proyecto::where('NOMBREPROYECTO','=',$nombre)
                            ->count();
        if($respuesta > 0){
            if($idproyecto > 0){
                $respuesta2 = Proyecto::where(['NOMBREPROYECTO' => $nombre,'IDPROYECTO' => $idproyecto])
                            ->count();
                if($respuesta2 > 0){
                    $resultado = false;
                }else{
                    $resultado = true;
                }
            }else{
                $resultado = true;
            }
        }
        
        return $resultado;
    }
    //Inicio de funcion para obtener todos los proyecto con su departamento respectivo
    public static function obtenerActividades($id = null){
        if($id == null){
            $actividad = Actividad::join('indicadores', 'actividades.IDINDICADORES', '=', 'indicadores.IDINDICADORES')
            
            ->select('indicadores.*','actividades.*')
            ->get();
        }else{
        $actividad = Actividad::join('indicadores', 'actividades.IDINDICADORES', '=', 'indicadores.IDINDICADORES')
            ->where('IDACTIVIDAD',$id)
            ->select('indicadores.*','actividades.*')
            ->get();
        }
    
        return $actividad;
    }
    //fin de funcion obtener

    public static function verificarProyectoExiste($id){
        $verificador = Proyecto::where('IDPROYECTO',$id)->count();
        return $verificador;
    }
    public static function numeroSupervisoresProyecto($idproyecto){
        $numero = Proyectosupervisor::where('IDPROYECTO',$idproyecto)->count();
        return $numero;
    }

    public static function obtenerFechasActivasProyecto($idproyecto){
        $fechas = Fechaproyecto::where(['IDPROYECTO' => $idproyecto,'ESTADOFECHAP' => '1'])->get();
        return $fechas;
    }

    public static function obtenerArrayFechasActivasProyecto($objetoFechasProyecto){
        $datosDeProyectoFecha = array();
        if(isset($objetoFechasProyecto)){
            foreach($objetoFechasProyecto as $ofp){
                $datosDeProyectoFecha['FECHAINICIAL'] = $ofp->FECHAINICIAL;
                $datosDeProyectoFecha['FECHAFINAL'] = $ofp->FECHAFINAL;
                $datosDeProyectoFecha['ESTADOFECHAP'] = $ofp->ESTADOFECHAP;
                $datosDeProyectoFecha['OBSEVACIONP'] = $ofp->OBSEVACIONP;
            }
        }
        return $datosDeProyectoFecha;
    }
}