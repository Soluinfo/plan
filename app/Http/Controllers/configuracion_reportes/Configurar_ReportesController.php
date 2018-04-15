<?php

namespace App\Http\Controllers\configuracion_reportes;

use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proyecto;
use App\Empleado;
use App\Proyectosupervisor;
use App\Catalogoobjetivo;
use App\Objetivo;
use App\Proyectosobjetivos;
use App\Catalogoindicador;
use App\Indicador;
use App\Helpers\ReporteHelper;
use App\Configuracion_reporte;


class Configurar_ReportesController extends Controller
{
    public function home(){
        //$proyectos = $this->obtener(null);
        $reporte = ReporteHelper::obtenerReportes(null);
        return view('configuracion_reportes.configurar_reportes',['reporte' => $reporte]);
    }
    public function crear($id = null){
        $datosDeReporte = array();
        $transaccion = 1;
        if($id == null){

        }else{
            $Configuracion_reporte = $this->obtener($id);
            if(isset($Configuracion_reporte)){
                foreach($Configuracion_reporte as $r){
                    $datosDeReporte['idconfiguracionreporte'] = $r->idconfiguracionreporte;
                    $datosDeReporte['encabezado1'] = $r->encabezado1;
                   
                   
                }
            }
        }
        
        $configuracion_repor = DB::table('configuracion_reportes')->get();
        $supervisores = $this->obtenerSupervisores(null);
        return view('configuracion_reportes.editar_reportes')->with(['configuracion_reportes' => $configuracion_repor,
                                                            'supervisores' => $supervisores,
                                                        ])
                                                        ->with($datosDeReporte);
    }
    public function obtenerSupervisores($id = null){
        $supervisores = Empleado::all();
        return $supervisores;
    }

    public function actualizar(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'actualizar');
            $idReporte = $r->idreporte;
            
            if($idReporte > 0){
                $reporte = Configuracion_reporte::where('idconfiguracionreporte', $idReporte)
                                    ->update([
                                    'encabezado1' => $r->txtDescripcion,
                                    
                                    ]);
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $idReporte;
                $datos['transaccion'] = 'actualizar';
            }else{
                $reporte = new Configuracion_reporte(array(
                    'encabezado1' => $r->txtDescripcion,
                ));
                $reporte->save();
                $id = $reporte->id;
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $id;
                $datos['transaccion'] = 'guardar';
            }
            
            echo json_encode($datos);
        }
    }
    //Inicio de funcion para obtener todos los proyecto con su departamento respectivo
    public function obtener($id = null){
        if($id == null){
            $reportes = Configuracion_reporte::join('tiposreportes', 'configuracion_reportes.idtiporeporte', '=', 'tiposreportes.idtiporeporte')              
                                ->select('configuracion_reportes.*','tiposreportes.*')
                                ->get();
        }else{
            $reportes = Configuracion_reporte::join('tiposreportes', 'configuracion_reportes.idtiporeporte', '=', 'tiposreportes.idtiporeporte')              
                                ->where('idconfiguracionreporte',$id)
                                ->select('configuracion_reportes.*','tiposreportes.*')
                                ->get();
        }
    
        return $reportes;
}
}
