<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proyecto;
use App\Empleado;
use App\Proyectosupervisor;

class ProyectoController extends Controller
{
    public function home(){
        $proyectos = $this->obtener(null);
        
        return view('proyectos.proyecto',['proyectos' => $proyectos]);
    }
    //inicio de funcion crear que muestra la vista del formulario de creacion de proyecto
        public function crear($id = null){
            $departamentos = DB::table('departamento')->get();
            $supervisores = DB::table('empleado')->get();
            return view('proyectos.crearProyecto',['departamento' => $departamentos,'supervisores' => $supervisores]);
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
            $proyectos = Proyecto::join('departamento', 'proyectos.IDDEPARTAMENTO', '=', 'departamento.SERIAL_DEP')
                                ->select('proyectos.*','departamento.DESCRIPCION_DEP')
                                ->get();
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
                    $datos['mensaje'] = '<strong>!AVISO:</strong> El supervisor seleccionado ya se encuentra asignado a este proyecto';
                }else{
                    $asignacion = new Proyectosupervisor([
                        'IDPROYECTO' => $r->IDPROYECTO,
                        'IDSUPERVISOR' => $r->IDSUPERVISOR,
                        'ESTADO' => '1',
                        'FECHAPROYECTOSUPERVISOR' => date('Y-m-d')
                    ]);
                    $asignacion->save();
                    $datos['respuesta'] = 'ok';
                    $datos['mensaje'] = '<strong>!INFO:</strong> Supervisor asignado con exito';
                }
                
                echo json_encode($datos);
            }
        }
    //end funcion asignarSupervisor
    
    //inicio de funcion para obtener supervisores de un determinado proyecto
        public function obtenerSupervisoresDeProyecto(Request $r){
            if($r->ajax()){
                $datosdesupervisor = Empleado::join('proyectosupervisor','IDPROYECTO',$r->IDPROYECTO)
                                                ->join('proyectosupervisor','IDSUPERVISOR','empleado.SERIAL_EPL')
                                                ->get();
                var_dump($datosdesupervisor);
                if(isset($datosdesupervisor)){
                    foreach($datosdesupervisor as $ds){
                        ?>
                       
                        <?php
                    }
                }
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

}
