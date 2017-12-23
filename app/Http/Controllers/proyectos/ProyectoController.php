<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProyectoController extends Controller
{
    public function home(){
        return view('proyectos.proyecto');
    }

    public function crear($id = null){
        $direcciones = DB::table('departamento')->get();
        return view('proyectos.crearProyecto',['departamento' => $direcciones]);
    }

    public function guardar(){
        $datos = array('respuesta' => 'ok','codigo' => 2);
        echo json_encode($datos);
    }
}
