<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;

class DetalleActividadController extends Controller
{
    public function home($id){
        $arrayActividad = array();
        $Actividades = ProyectoHelper::obtenerActividades($id);
        $arrayActividad = ProyectoHelper::obtenerArrayActividad($Actividades);
        return view('proyectos.detalleActividad')->with($arrayActividad);
    }

    public function obtenerDetalleObjetivo(Request $r){
        if($r->ajax()){
            $tabla = ObjetivoHelper::obtenerTablaObjetivo($r->IDOBJETIVOESTRATEGICO);
            echo $tabla;
        }
    }
}
