<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActividadController extends Controller
{
    public function home(){
        return view('proyectos.actividades');
    }
}
