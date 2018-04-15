<?php

namespace App\Http\Controllers\indicadores;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Catalogoindicador;
use App\Helpers\IndicadorHelper;

class CatalogoIndicadorController extends Controller
{
    public function home(){
        
        return view('indicadores.catalogoindicadores'); 
    }
    public function  crear($id = null){
        $datosDeCatalogoIndicador = array();
        $transaccion = 1;
        if($id == null){
            
        }else{
            $Catalogoindicador = IndicadorHelper::obtenerCatalogoIndicadores($id);
            if(isset($Catalogoindicador)){
                foreach($Catalogoindicador as $p){
                    $datosDeCatalogoIndicador['IDCATALOGOINDICADORES'] = $p->IDCATALOGOINDICADORES;
                    $datosDeCatalogoIndicador['NOMBRE'] = $p->NOMBRE;
                    $datosDeCatalogoIndicador['FECHA'] = $p->FECHA;
                    $datosDeCatalogoIndicador['ESTADO'] = $p->ESTADO;
                }
            }
        }
        $obtenercatalogoindicador = DB::table('indicadores')->get();        
        //$ambitos = $this->obtenerAmbitos(null);
        //$alcances = $this->obtenerAlcances(null);
        return view('indicadores.crearCatalogoIndicador')->with(['indicadores' => $obtenercatalogoindicador])
                                                            ->with($datosDeCatalogoIndicador);
    }
    public function guardar(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
            $idCatalogoIndicadores = $r->idcatalogoindicadores;

            if($idCatalogoIndicadores > 0){
                $catalogoindicador = Catalogoindicador::where('IDCATALOGOINDICADORES', $idCatalogoIndicadores)
                                    ->update([
                                    'NOMBRE' => $r->txtnombreIndicador,
                                    'FECHA' => $r->dpFechaIndicador,
                                    'ESTADO' => $r->slEstadoIndicador
                                   
                                    ]);
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $idCatalogoIndicadores;
                $datos['transaccion'] = 'actualizar';
                }else{
                    $catalogoindicador = new Catalogoindicador(array(
                        'NOMBRE' => $r->txtnombreIndicador,
                        'FECHA' => $r->dpFechaIndicador,
                        'ESTADO' => $r->slEstadoIndicador
                        
                    ));
                    $catalogoindicador->save();
                    $id = $catalogoindicador->id;
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $id;
                    $datos['transaccion'] = 'guardar';
                }
                echo json_encode($datos);
            }
}
    public function obtener($id = null){
        if($id == null){
            $catalogoindicadores = Catalogoindicador::join('indicadores', 'catalogoindicadores.IDCATALOGOINDICADORES', '=', 'indicadores.IDCATALOGOINDICADORES')
                            
                            ->select('catalogoindicadores.*','indicadores.*')
                            ->get();
        }else{
            $catalogoindicadores = Catalogoindicador::join('indicadores', 'catalogoindicadores.IDCATALOGOINDICADORES', '=', 'indicadores.IDCATALOGOINDICADORES')
                                ->where('catalogoindicadores.IDCATALOGOINDICADORES',$id)
                                ->select('catalogoindicadores.*','indicadores.*')
                                ->get();
        }
        return $catalogoindicadores;
    }

    public function eliminarCatalogoIndicador(Request $r){
        if($r->ajax()){
            $respuesta = '';
            $verificarSiTieneIndicadores = IndicadorHelper::numeroIndicadoresCatalogo($r->IDCATALOINDICADOR);
            if($verificarSiTieneIndicadores > 0){
                $respuesta =  "tieneindicadores";
            }else{
                Catalogoindicador::where('IDCATALOGOINDICADORES',$r->IDCATALOINDICADOR)->delete();
                $respuesta = 'eliminado';
            }
            echo $respuesta;
        }
    }
}
