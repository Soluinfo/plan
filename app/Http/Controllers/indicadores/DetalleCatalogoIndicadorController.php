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
        $obtenerIndicadores = Catalogoindicador::select('IDCATALOGOINDICADORES',
                                                            'NOMBRE',
                                                            'FECHA',
                                                            'ESTADO'
                                                        )
                                                        ->get();
                                                    
        return Datatables($obtenerIndicadores)
                    ->editColumn('ESTADO', function($obtenerIndicadores){
                        $estado = '';
                        if($obtenerIndicadores->ESTADO == 1){
                            $estado = '<span class="label label-success">ACTIVO</span>';
                        }else{
                            $estado = '<span class="label label-danger">INACTIVO</span>';
                        }
                        return $estado;
                    })
                    ->addColumn('action', function ($obtenerIndicadores) {
                        return '
                        <a href="'.action('indicadores\DetalleCatalogoIndicadorController@home',$obtenerIndicadores->IDCATALOGOINDICADORES) .'" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                        <a href="'.action('indicadores\CatalogoIndicadorController@crear',$obtenerIndicadores->IDCATALOGOINDICADORES) .'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                        <a class="btn btn-danger btn-xs" onclick="eliminarCatalogoDeIndicadores('.$obtenerIndicadores->IDCATALOGOINDICADORES.')" role="button"><i class="fa fa-trash-o"></i></a> 
                        ';
                    })
                    ->rawColumns(['ESTADO', 'action'])
                    ->make(true);
    }
    public function datatablesIndicadores(Request $r){
        $obtenerIndicadores = Indicador::where('IDCATALOGOINDICADORES',$r->idcatalogoindicador)
                                                        ->select('IDINDICADORES',
                                                            'LITERAL',
                                                            'DESCRIPCION'
                                                        );
                                                    
        return Datatables($obtenerIndicadores)
                    ->addColumn('action', function ($obtenerIndicadores) {
                        return '<a onclick="agregarObjetivos('.$obtenerIndicadores->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>Agregar</a>';
                    })
                    ->make(true);
    }
}
