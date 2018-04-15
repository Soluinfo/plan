<?php

namespace App\Http\Controllers\indicadores;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Indicador;
use App\Actividad;
use App\Helpers\IndicadorHelper;

class IndicadorController extends Controller
{
    public function home(){        
        $indicadores = $this->obtener(null);
        return view('indicadores.indicadores',['indicadores' => $indicadores]);
    }
    public function crear($id = null){  
        $datosDeIndicador = array();
        $transaccion = 1;
        if($id == null){

        }else{
            $Indicador = $this->obtener($id);
            if(isset($Indicador)){
                foreach($Indicador as $p){
                    $datosDeIndicador['IDINDICADORES'] = $p->IDINDICADORES;
                    $datosDeIndicador['LITERAL'] = $p->LITERAL;
                    $datosDeIndicador['DESCRIPCIONINDICADOR'] = $p->DESCRIPCION;
                    //$datosDeObjetivo['ALCANCE'] = $p->ALCANCE;
                    $datosDeIndicador['IDCATALOGOINDICADORES'] = $p->IDCATALOGOINDICADORES;
                }
            }
        }
        $catalogoindicador = DB::table('catalogoindicadores')->get();        
        //$ambitos = $this->obtenerAmbitos(null);
        //$alcances = $this->obtenerAlcances(null);
        return view('indicadores.crearIndicadores')->with(['catalogoindicadores' => $catalogoindicador])
                                                            ->with($datosDeIndicador);
    }


    
        public function guardar(Request $r){
            if($r->ajax()){
                $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
                $idIndicador = $r->idindicador;

                if($idIndicador > 0){
                    $indicador = Indicador::where('IDINDICADORES', $idIndicador)
                                        ->update([
                                        'IDCATALOGOINDICADORES' => $r->slidcatalogo,
                                        'LITERAL' => $r->txtLiteral,
                                        'DESCRIPCION' => $r->txtDescripcion
                                    
                                        ]);
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $idIndicador;
                    $datos['transaccion'] = 'actualizar';
                }else{
                        $indicador = new Indicador(array(
                            'IDCATALOGOINDICADORES' => $r->slidcatalogo,
                            'LITERAL' => $r->txtLiteral,
                            'DESCRIPCION' => $r->txtDescripcion
                        ));
                        $indicador->save();
                        $id = $indicador->id;
                        $datos['respuesta'] = 'ok';
                        $datos['codigo'] = $id;
                        $datos['transaccion'] = 'guardar';
                    }
                    echo json_encode($datos);
                }
        }
        public function obtener($id = null){
            if($id == null){
                $indicadores = Indicador::join('catalogoindicadores', 'indicadores.IDCATALOGOINDICADORES', '=', 'catalogoindicadores.IDCATALOGOINDICADORES')
                                ->select('indicadores.*','catalogoindicadores.*')
                                ->get();
            }else{
                $indicadores = Indicador::join('catalogoindicadores', 'indicadores.IDCATALOGOINDICADORES', '=', 'catalogoindicadores.IDCATALOGOINDICADORES')
                ->where('IDINDICADORES',$id)
                ->select('indicadores.*','catalogoindicadores.*')
                ->get();
            }
            return $indicadores;
        }

        public function datatableIndicadores(Request $r){
            if($r->ajax()){
                if($r->idcatalogoindicador == null){
                    $datosindicadores = Indicador::join('catalogoindicadores', 'catalogoindicadores.IDCATALOGOINDICADORES', '=', 'indicadores.IDCATALOGOINDICADORES')
                                                    ->select('indicadores.IDINDICADORES', 'indicadores.LITERAL','indicadores.DESCRIPCION','catalogoindicadores.NOMBRE')
                                                    ->get();
                }else{
                    $datosindicadores = Indicador::join('catalogoindicadores', 'catalogoindicadores.IDCATALOGOINDICADORES', '=', 'indicadores.IDCATALOGOINDICADORES')
                                                    ->where('indicadores.IDCATALOGOINDICADORES', '=' ,$r->idcatalogoindicador)
                                                    ->select('indicadores.IDINDICADORES', 'indicadores.LITERAL','indicadores.DESCRIPCION','catalogoindicadores.NOMBRE')
                                                    ->get();
                }
                
                                                
                return Datatables($datosindicadores)
                ->addColumn('action', function ($datosindicadores) {
                    return '<a href="'.action('indicadores\DetalleIndicadorController@home',$datosindicadores->IDINDICADORES).'" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                            <a href="'.action('indicadores\IndicadorController@crear',$datosindicadores->IDINDICADORES).'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>                   
                            <a onclick="eliminarIndicador('.$datosindicadores->IDINDICADORES.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminari!"><i class="fa fa-trash-o"></i></a>';
                })
                ->make(true);
            }
        }

        //eliminar del indicador
        public function eliminarIndicador(Request $r){
            if($r->ajax()){
                $respuesta = '';
                $verificarSiTieneProyecto = IndicadorHelper::numeroIndicadoresEnProyecto($r->IDINDICADOR);
                if($verificarSiTieneProyecto > 0){
                    $respuesta = 'estaAsignadoAProyecto';
                }else{
                    Indicador::where(['IDINDICADORES' => $r->IDINDICADOR])
                    ->delete();
                    $respuesta = 'eliminado';
                }
                
                
                echo $respuesta;     
            }
        }

}
