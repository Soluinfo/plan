<?php

namespace App\Http\Controllers\objetivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;

class DetalleCatalogoController extends Controller
{
    public function home($id){
        
        $catalogo = ObjetivoHelper::obtenerCatalogo($id);
        var_dump($catalogo);
        $arrayCatalogo = ObjetivoHelper::obtenerArrayCatalogo($catalogo);
        return view('objetivos.detalleCatalogo')->with($arrayCatalogo);
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
