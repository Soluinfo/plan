<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Proyecto;
use App\Actividad;
use App\Proyectosobjetivos;
use App\Empleado;
use App\Proyectosupervisor;
 
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
   //diego voy  conservar ambos cambios , revisa 
   //yo tb tengo funciones redundantes, esque asi trabajo hasta que me salga lo que estoy haciendo,
   // aya pues entonces una vez que ya termines eliminas las que esten redundatne , 
   //voy a consevear ambos cambios ok
    //diegao si sabes que hemos sido redundante , yo esta funcion obtenerArrayActividad la tengo en un helper aparte
//fin de funcion obtener
public static function obtenerArrayActividad($objetoActividad){
    $datosDeActividad = array();
    if(isset($objetoActividad)){
        foreach($objetoActividad as $p){
            $datosDeActividad['IDACTIVIDAD'] = $p->IDACTIVIDAD;
            $datosDeActividad['IDOBJETIVOESTRATEGICO'] = $p->IDOBJETIVOESTRATEGICO;
            $datosDeActividad['DESCRIPCION'] = $p->DESCRIPCION;
            $datosDeActividad['IDINDICADORES'] = $p->IDINDICADORES;
            $datosDeActividad['NOMBREACTIVIDAD'] = $p->NOMBREACTIVIDAD;
            $datosDeActividad['FECHACREACIONACTIVIDAD'] = $p->FECHACREACIONACTIVIDAD;
            $datosDeActividad['created_at'] = $p->created_at;
            $datosDeActividad['updated_at'] = $p->updated_at;
            $datosDeActividad['idusuario'] = $p->idusuario;
            $datosDeActividad['SERIAL_DEP'] = $p->SERIAL_DEP;
        }
    }
    return $datosDeActividad;
}
public static function obtenerSupervisoresDeProyecto($id = null){
    if($id == null){
        $datosdesupervisor = Proyecto::join('departamento', 'proyectos.IDDEPARTAMENTO', '=', 'departamento.SERIAL_DEP')
                                        //->join('proyectosupervisor', 'proyectosupervisor.IDSUPERVISOR ', '=', 'empleado.SERIAL_EPL')
                                        //->join('proyectosobjetivos', 'proyectos.IDPROYECTO', '=', 'proyectosobjetivos.IDPROYECTO')
                                        ->select('proyectos.*','departamento.*')
                                        ->get();
                                
                                }else{
                                $datosdesupervisor = Proyecto::join('departamento', 'proyectos.IDDEPARTAMENTO', '=', 'departamento.SERIAL_DEP')
                                                    //->join('proyectosupervisor', 'proyectosupervisor.IDSUPERVISOR ', '=', 'empleado.SERIAL_EPL')
                                                    ->where('IDPROYECTO',$id)
                                                    ->select('proyectos.*', 'departamento.*')
                                                    ->get();
                            }
                        
                            return $datosdesupervisor;
                        }
public static function obtenerSupervisores($id = null){
    if($id == null){
        $supervisor = Empleado::join('proyectosupervisor', 'empleado.SERIAL_EPL ', '=', 'proyectosupervisor.IDSUPERVISOR')
                                        ->select('proyectosupervisor.*', 'empleado.*')
                                        ->get();

                                       

                                    }else{
                                        $supervisor = Empleado::join('proyectosupervisor', 'empleado.SERIAL_EPL ', '=', 'proyectosupervisor.IDSUPERVISOR')
                                                            ->where('IDPROYECTOSUPERVISOR',$id)
                                                            ->select('proyectosupervisor.*', 'empleado.*')
                                                            ->get();
                                    }
                                
                                    return $supervisor;
                                }
                                        
                              
public static function obtenerObjetivosDeProyecto($id = null){
    if($id == null){
$datosdeproyecto = Proyectosobjetivos::join('objetivosestrategicos', 'proyectosobjetivos.IDOBJETIVOESTRATEGICO', '=', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO')
                                        ->select('proyectosobjetivos.*', 'objetivosestrategicos.*')
                                        ->get();
                        }else{
                        $datosdeproyecto = Proyectosobjetivos::join('objetivosestrategicos', 'proyectosobjetivos.IDOBJETIVOESTRATEGICO', '=', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO')
                                            ->where('IDPROYECTOOBJETIVO',$id)
                                            ->select('proyectosobjetivos.*', 'objetivosestrategicos.*')
                                            ->get();
                                        }
                                        return $datosdeproyecto;
    }
    //funcion para generar el pdf de proyectos
    public static function obtenerSupervisoresDeProyectos($id = null){
        if($id == null){
            $supervisor = Empleado::join('proyectosupervisor', 'empleado.SERIAL_EPL', '=', 'proyectosupervisor.IDSUPERVISOR')
                                               
                                                ->select('empleado.*', 'proyectosupervisor.*')
                                                ->get();
                        }else{
                            $supervisor = Empleado::join('proyectosupervisor', 'empleado.SERIAL_EPL', '=', 'proyectosupervisor.IDSUPERVISOR')
                            ->where('IDPROYECTO', '=' ,$id)
                            ->select('empleado.*', 'proyectosupervisor.*')
                            ->get();
                            }
                            return $supervisor;
    }
}

    //fin de funcion obtener
}
