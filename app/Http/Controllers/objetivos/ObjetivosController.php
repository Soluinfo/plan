<?php

namespace App\Http\Controllers\objetivos;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Objetivo;
use App\Ambitoinfluencia;
use App\Alcance;



class ObjetivosController extends Controller
{
    public function home(){
        
        $objetivosestrategicos = $this->obtener(null);
        return view('objetivos.objetivos',['objetivosestrategicos' => $objetivosestrategicos]);
       
    }
    public function crear($id = null){
        $datosDeObjetivo = array();
        $transaccion = 1;
        if($id == null){

        }else{
            $Objetivo = $this->obtener($id);
            if(isset($Objetivo)){
                foreach($Objetivo as $p){
                    $datosDeObjetivo['IDOBJETIVOESTRATEGICO'] = $p->IDOBJETIVOESTRATEGICO;
                    $datosDeObjetivo['LITERAL'] = $p->LITERAL;
                    $datosDeObjetivo['DESCRIPCION'] = $p->DESCRIPCION;
                    //$datosDeObjetivo['ALCANCE'] = $p->ALCANCE;
                    $datosDeObjetivo['IDCATALOGOOBJETIVO'] = $p->IDCATALOGOOBJETIVO;
                }
            }
        }
        $catalogoobjetivo = DB::table('catalogoobjetivos')->get();        
        //$ambitos = $this->obtenerAmbitos(null);
        //$alcances = $this->obtenerAlcances(null);
        return view('objetivos.crearObjetivos')->with(['catalogoobjetivos' => $catalogoobjetivo])
                                                            ->with($datosDeObjetivo);
    }
            //fin de la funcion crear

            //inicio de la funcion para guardar objetivos estrategicos
            public function guardar(Request $r){
                if($r->ajax()){
                    $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
                    $idObjetivo = $r->idobjetivo;
        
                    if($idObjetivo > 0){
                        $objetivo = Objetivo::where('IDOBJETIVOESTRATEGICO', $idObjetivo)
                                            ->update([
                                            'IDCATALOGOOBJETIVO' => $r->slidcatalogo,   
                                            'LITERAL' => $r->txtLiteral,
                                            'DESCRIPCION' => $r->txtDescripcion
                                            
                                            ]);
                        $datos['respuesta'] = 'ok';
                        $datos['codigo'] = $idObjetivo;
                        $datos['transaccion'] = 'actualizar';
                        }else{
                            $objetivo = new Objetivo(array(
                                'IDCATALOGOOBJETIVO' => $r->slidcatalogo, 
                                'LITERAL' => $r->txtLiteral,
                                'DESCRIPCION' => $r->txtDescripcion
                                
                            ));
                            $objetivo->save();
                            $id = $objetivo->id;
                            $datos['respuesta'] = 'ok';
                            $datos['codigo'] = $id;
                            $datos['transaccion'] = 'guardar';
                        }
                        echo json_encode($datos);
                    }
                }
                public function obtener($id = null){
                    if($id == null){
                        $objetivosestrategicos = Objetivo::join('catalogoobjetivos', 'objetivosestrategicos.IDCATALOGOOBJETIVO', '=', 'catalogoobjetivos.IDCATALOGOOBJETIVO')
                                        ->select('objetivosestrategicos.*','catalogoobjetivos.*')
                                        ->get();
                    }else{
                        $objetivosestrategicos = Objetivo::join('catalogoobjetivos', 'objetivosestrategicos.IDCATALOGOOBJETIVO', '=', 'catalogoobjetivos.IDCATALOGOOBJETIVO')
                        ->where('IDOBJETIVOESTRATEGICO',$id)
                        ->select('objetivosestrategicos.*','catalogoobjetivos.*')
                        ->get();
                    }
                    return $objetivosestrategicos;
                }
//inicio de la funcion para guardar objetivos estrategicos

public function guardarambito(Request $r){
    if($r->ajax()){
        $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
        $idAmbitoinfluencia = $r->idambitoinfluencia;

        if($idAmbitoinfluencia > 0){
            $ambitoinfluencia = Ambitoinfluencia::where('IDAMBITOINFLUENCIA', $idAmbitoinfluencia)
                                ->update([
                                'IDOBJETIVOESTRATEGICO' => $r->idobjetivo,   
                                'NOMBREAMBITO' => $r->txtDescripcionAmbito
                                
                                
                                ]);
            $datos['respuesta'] = 'ok';
            $datos['codigo'] = $idAmbitoinfluencia;
            $datos['transaccion'] = 'actualizar';
            }else{
                $ambitoinfluencia = new Ambitoinfluencia(array(
                    'IDOBJETIVOESTRATEGICO' => $r->idobjetivo,
                    'NOMBREAMBITO' => $r->txtDescripcionAmbito
                    
                ));
                $ambitoinfluencia->save();
                $id = $ambitoinfluencia->id;
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $id;
                $datos['transaccion'] = 'guardar';
            }
            echo json_encode($datos);
        }
    }
        public function datatablesAmbito(Request $r){
            if($r->ajax()){
                $datosambitos = Ambitoinfluencia::join('objetivosestrategicos', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO', '=', 'ambitosinfluencias.IDOBJETIVOESTRATEGICO')
                                                    ->where('ambitosinfluencias.IDOBJETIVOESTRATEGICO', '=' ,$r->idobjetivo)
                                                    ->select('ambitosinfluencias.IDAMBITOINFLUENCIA','objetivosestrategicos.DESCRIPCION','ambitosinfluencias.NOMBREAMBITO')
                                                    ->get();
                                                
                return Datatables($datosambitos)
                 ->addColumn('action', function ($datosambitos) {
                    return '<a onclick="obtenerDetalleSupervisor('.$datosambitos->IDAMBITOINFLUENCIA.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                            <a onclick=class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>                   
                            <a onclick="agregarObjetivos('.$datosambitos->IDAMBITOINFLUENCIA.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                })
                ->make(true);
            }
        }
        public function guardaralcance(Request $r){
            if($r->ajax()){
                $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
                $idAlcance = $r->idalcance;
        
                if($idAlcance > 0){
                    $ambitoinfluencia = Alcance::where('IDALCANCE', $idAlcance)
                                        ->update([
                                        'IDOBJETIVOESTRATEGICO' => $r->idobjetivo,   
                                        'DESCRIPCIONALCANCE' => $r->txtDescripcionAlcance
                                        
                                        
                                        ]);
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $idAlcance;
                    $datos['transaccion'] = 'actualizar';
                    }else{
                        $alcance = new Alcance(array(
                            'IDOBJETIVOESTRATEGICO' => $r->idobjetivo,   
                            'DESCRIPCIONALCANCE' => $r->txtDescripcionAlcance
                            
                        ));
                        $alcance ->save();
                        $id = $alcance ->id;
                        $datos['respuesta'] = 'ok';
                        $datos['codigo'] = $id;
                        $datos['transaccion'] = 'guardar';
                    }
                    echo json_encode($datos);
                } 
    
}
public function datatablesAlcance(Request $r){
    if($r->ajax()){
        $datosalcance = Alcance::join('objetivosestrategicos', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO', '=', 'alcances.IDOBJETIVOESTRATEGICO')
                                            ->where('alcances.IDOBJETIVOESTRATEGICO', '=' ,$r->idobjetivo)
                                            ->select('alcances.IDALCANCE','objetivosestrategicos.DESCRIPCION','alcances.DESCRIPCIONALCANCE')
                                            ->get();
                                        
        return Datatables($datosalcance)
        ->addColumn('action', function ($datosalcance) {
            return '<a onclick="obtenerDetalleSupervisor('.$datosalcance->IDALCANCE.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                    <a onclick="agregarObjetivos('.$datosalcance->IDALCANCE.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
        })
        ->make(true);
    }
}
/*public function obtenerAmbitos($id = null){
    $ambitos = Ambitoinfluencia::all();
    return $ambitos;
}*/
}