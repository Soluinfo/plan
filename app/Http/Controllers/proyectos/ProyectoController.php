<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProyectoController extends Controller
{
    public function home(){
        return view('proyectos.proyecto');
    }

    public function crear(){
        return view('proyectos.crearProyecto');
    }
}
