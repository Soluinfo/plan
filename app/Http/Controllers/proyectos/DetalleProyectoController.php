<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;

class DetalleProyectoController extends Controller
{
    public function home($id){
        $arrayProyecto = array();
        $Proyectos = ProyectoHelper::obtenerProyectos($id);
        $arrayProyecto = ProyectoHelper::obtenerArrayProyecto($Proyectos);
        return view('proyectos.detalleProyecto')->with($arrayProyecto);
    }

    public function obtenerDetalleObjetivo(Request $r){
        if($r->ajax()){
            $tabla = ObjetivoHelper::obtenerTablaObjetivo($r->IDOBJETIVOESTRATEGICO);
            echo $tabla;
        }
    }
    public function Exportarpdf($id){
        $arrayProyectoPDF = array();
        $ProyectosPDF = ProyectoHelper::obtenerProyectos($id);
        $arrayProyectoPDF = ProyectoHelper::obtenerArrayProyecto($ProyectosPDF);
        return view('proyectos.reportepdf')->with($arrayProyectoPDF);
    }

}
