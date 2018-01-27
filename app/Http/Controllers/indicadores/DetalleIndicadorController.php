<?php

namespace App\Http\Controllers\indicadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\IndicadorHelper;

class DetalleIndicadorController extends Controller
{
    public function home($id){
        $arrayIndicador = array();
        $Indicadores = IndicadorHelper::obtenerIndicadores($id);
        $arrayIndicador = IndicadorHelper::obtenerArrayIndicador($Indicadores);
        return view('indicadores.detalleIndicador')->with($arrayIndicador);
    }

    /*public function obtenerDetalleObjetivo(Request $r){
        if($r->ajax()){
            $tabla = ObjetivoHelper::obtenerTablaObjetivo($r->IDOBJETIVOESTRATEGICO);
            echo $tabla;
        }
    }*/

    public function obtenerDetalleAmbito(Request $r){
        if($r->ajax()){
            $tabla = IndicadorHelper::obtenerActividades($r->IDINDICADORES);
            echo $tabla;
        }
    }
}
