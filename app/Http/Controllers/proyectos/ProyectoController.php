<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proyecto;

class ProyectoController extends Controller
{
    public function home(){
        return view('proyectos.proyecto');
    }

    public function crear($id = null){
        $direcciones = DB::table('departamento')->get();
        return view('proyectos.crearProyecto',['departamento' => $direcciones]);
    }

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
}
