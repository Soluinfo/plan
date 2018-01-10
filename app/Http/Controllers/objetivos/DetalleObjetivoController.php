<?php

namespace App\Http\Controllers\objetivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;

class DetalleObjetivoController extends Controller
{
    public function home($id){
        
        $Objetivos = ObjetivoHelper::obtenerObjetivos($id);
        $arrayObjetivo = ObjetivoHelper::obtenerArrayObjetivo($Objetivos);
        return view('objetivos.detalleObjetivo')->with($arrayObjetivo);
    }

    /*public function obtenerDetalleObjetivo(Request $r){
        if($r->ajax()){
            $tabla = ObjetivoHelper::obtenerTablaObjetivo($r->IDOBJETIVOESTRATEGICO);
            echo $tabla;
        }
    }*/

    public function obtenerDetalleAmbito(Request $r){
        if($r->ajax()){
            $tabla = ObjetivoHelper::obtenerAmbito($r->IDOBJETIVOESTRATEGICO);
            echo $tabla;
        }
    }
}
