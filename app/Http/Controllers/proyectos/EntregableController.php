<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;

class EntregableController extends Controller
{
    public function home(){
        
        return view('proyectos.entregable');
        
    }
}