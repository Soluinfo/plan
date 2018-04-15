<?php

namespace App\Http\Controllers\indicadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;
use App\Helpers\IndicadorHelper;
use App\Catalogoindicador;
use App\Indicador;

class DetalleCatalogoIndicadorController extends Controller
{
    public function home($id){
        
        $catalogoIndicador = IndicadorHelper::obtenerCatalogoIndicadores($id);
        //var_dump($catalogo);
        $arrayCatalogoIndicador = IndicadorHelper::obtenerArrayCatalogoIndicadores($catalogoIndicador);
        return view('indicadores.detalleCatalogoIndicadores')->with($arrayCatalogoIndicador);
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
    public function datatablesCatalogoIndicadores(Request $r){
        $obtenerIndicadores = Indicador::where('IDCATALOGOINDICADORES',$r->idcatalogoindicador)
                                                        ->select('IDINDICADORES',
                                                            'LITERAL',
                                                            'DESCRIPCIONINDICADOR'
                                                        );
                                                    
        return Datatables($obtenerIndicadores)
                    ->addColumn('action', function ($obtenerIndicadores) {
                        return '<a onclick="agregarObjetivos('.$obtenerIndicadores->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>Agregar</a>';
                    })
                    ->make(true);
    }
}
