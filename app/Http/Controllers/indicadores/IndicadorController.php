<?php

namespace App\Http\Controllers\indicadores;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Indicador;
use App\Actividad;

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
                    $datosDeIndicador['DESCRIPCIONINDICADOR'] = $p->DESCRIPCIONINDICADOR;
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
                                    'DESCRIPCIONINDICADOR' => $r->txtDescripcion
                                   
                                    ]);
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $idIndicador;
                $datos['transaccion'] = 'actualizar';
                }else{
                    $indicador = new Indicador(array(
                        'IDCATALOGOINDICADORES' => $r->slidcatalogo,
                        'LITERAL' => $r->txtLiteral,
                        'DESCRIPCIONINDICADOR' => $r->txtDescripcion
                        
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

public function datatablesActividades(Request $r){
    if($r->ajax()){
        $datosactividad = Actividad::join('indicadores', 'indicadores.IDINDICADORES', '=', 'actividades.IDINDICADORES')
                                            ->where('actividades.IDINDICADORES', '=' ,$r->idindicador)
                                            ->select('actividades.IDACTIVIDAD', 'actividades.NOMBREACTIVIDAD')
                                            ->get();
                                        
        return Datatables($datosactividad)
         ->addColumn('action', function ($datosactividad) {
            return '<a onclick="obtenerDetalleActividad('.$datosactividad->IDACTIVIDAD.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                    <a onclick=class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>                   
                    <a onclick="agregarObjetivos('.$datosactividad->IDACTIVIDAD.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
        })
        ->make(true);
    }
}
//actividades del indicador


}
