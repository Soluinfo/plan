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

class ProyectoController extends Controller
{
    public function home(){
        $proyectos = $this->obtener(null);
        
        return view('proyectos.proyecto',['proyectos' => $proyectos]);
    }
    //inicio de funcion crear que muestra la vista del formulario de creacion de proyecto
        public function crear($id = null){
            $departamentos = DB::table('departamento')->get();
            $supervisores = $this->obtenerSupervisores(null);
            $catalogo = $this->obtenerCatalogoObjetivo(null);
            return view('proyectos.crearProyecto',['departamento' => $departamentos,'supervisores' => $supervisores,'catalogo' => $catalogo]);
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
                $tablaSupervisorProyecto = '';
                $datosdesupervisor = Empleado::join('proyectosupervisor', 'empleado.SERIAL_EPL', '=', 'proyectosupervisor.IDSUPERVISOR')
                                                    ->where('proyectosupervisor.IDPROYECTO', '=' ,$r->IDPROYECTO)
                                                    ->select('proyectosupervisor.*','empleado.*')
                                                    ->get();
                                                
                if(isset($datosdesupervisor)){
                    foreach($datosdesupervisor as $ds){
                        $tablaSupervisorProyecto .= '<tr id="trow_';
                        $tablaSupervisorProyecto .= $ds->SERIAL_EPL;
                        $tablaSupervisorProyecto .= '">';
                        $tablaSupervisorProyecto .= '<td class="text-center">'.$ds->SERIAL_EPL.'</td>';
                        $tablaSupervisorProyecto .= '<td>'.$ds->DOCUMENTOIDENTIDAD_EPL.'</td>';
                        $tablaSupervisorProyecto .= '<td>'.$ds->NOMBRE_EPL.'</td>';
                        $tablaSupervisorProyecto .= '<td>'.$ds->APELLIDO_EPL.'</td>';
                        $tablaSupervisorProyecto .= '<td>'.$ds->EMAIL_EPL.'</td>';
                        $tablaSupervisorProyecto .= ' <td>'.$ds->CELULAR_EPL.'</td>';
                        $tablaSupervisorProyecto .= '<td>
                                                        <button class="btn btn-default btn-sm"  ><span class="fa fa-pencil"></span></button>
                                                    </td>';
                        $tablaSupervisorProyecto .= ' </tr>';

                    }
                }
                echo $tablaSupervisorProyecto;
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
    public function obtenerObjetivos(Request $r){
        if($r->ajax()){
            $tablaObjetivos = '';
            $data = array();
            $obtenerObjetivos = Objetivoestrategico::where('IDCATALOGOOBJETIVO',$r->idcatalogo)
                                                    ->get();
            if(isset($obtenerObjetivos)){
                foreach($obtenerObjetivos as $o){
                    $tablaObjetivos .= '<tr id="trow_';
                    $tablaObjetivos .= $o->IDOBJETIVOESTRATEGICO;
                    $tablaObjetivos .= '">';
                    $tablaObjetivos .= '<td class="text-center">'.$o->IDOBJETIVOESTRATEGICO.'</td>';
                    $tablaObjetivos .= '<td>'.$o->LITERAL.'</td>';
                    $tablaObjetivos .= '<td>'.$o->DESCRIPCION.'</td>';
                   
                    $tablaObjetivos .= '<td>
                                            <button class="btn btn-default btn-sm"  ><span class="fa fa-pencil"></span></button>
                                        </td>';
                    $tablaObjetivos .= ' </tr>';
                    /*$row = array();
                    $row[] = $sol->IDOBJETIVOESTRATEGICO;
                    //$row[] = $sol->v_id_vehiculo;
                   
                    $row[] = $sol->LITERAL;
                    $row[] = $sol->DESCRIPCION;
                    $row[] = '<td>
                                <button class="btn btn-default btn-sm"  ><span class="fa fa-pencil"></span></button>
                            </td>';
                    $data[] = $row;*/
                }
            }
            //$datos['data'] = $data;
            //echo json_encode($datos);
            echo $tablaObjetivos;
        }
    }

}
