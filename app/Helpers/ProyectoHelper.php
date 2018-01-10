<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Proyecto;
 
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
                $datosDeProyecto['ESTADOPROYECTO'] = $p->ESTADOPROYECTO;
                $datosDeProyecto['DESCRIPCION_DEP'] = $p->DESCRIPCION_DEP;
                $datosDeProyecto['progreso'] = $p->progreso;
                $datosDeProyecto['created_at'] = $p->created_at;
                $datosDeProyecto['updated_at'] = $p->updated_at;
                $datosDeProyecto['idusuario'] = $p->idusuario;
                $datosDeProyecto['SERIAL_DEP'] = $p->SERIAL_DEP;
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
}