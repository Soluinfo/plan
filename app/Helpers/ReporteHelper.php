<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Proyecto;
use App\Actividad;
use App\Proyectosobjetivos;
use App\Configuracion_reporte;
use App\Tiporeporte;
use App\Proyectosupervisor;
 
class ReporteHelper {
    /**
     * @param int $id
     * 
     * @return object
     */

    public static function obtenerReportes($id = null){
        if($id == null){
            $reportes = Configuracion_reporte::join('tiposreportes', 'configuracion_reportes.idtiporeporte', '=', 'tiposreportes.idtiporeporte')              
                                ->select('configuracion_reportes.*','tiposreportes.*')
                                ->get();
        }else{
            $reportes = Configuracion_reporte::join('tiposreportes', 'configuracion_reportes.idtiporeporte', '=', 'tiposreportes.idtiporeporte')              
                                
                                ->select('configuracion_reportes.*','tiposreportes.*')
                                ->get();
        }
    
        return $reportes;
}
public static function obtenerArrayReporte($objetoReporte){
    $datosDeReporte = array();
    if(isset($objetoReporte)){
        foreach($objetoReporte as $r){
            $datosDeReporte['idconfiguracionreporte'] = $r->idconfiguracionreporte;
            $datosDeReporte['encabezado1'] = $r->encabezado1;
            $datosDeReporte['nombretipo'] = $r->nombretipo;
           
        }
    }
    return $datosDeReporte;
}
}