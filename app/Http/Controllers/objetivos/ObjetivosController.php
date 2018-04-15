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
                            $idObjetivo = $r->idobjetivo;
                            $datosambitos = Ambitoinfluencia::join('objetivosestrategicos', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO', '=', 'ambitosinfluencias.IDOBJETIVOESTRATEGICO')
                                                                ->where('ambitosinfluencias.IDOBJETIVOESTRATEGICO', '=' ,$r->idobjetivo)
                                                                ->select('ambitosinfluencias.IDAMBITOINFLUENCIA',
                                                                'objetivosestrategicos.DESCRIPCION',
                                                                'ambitosinfluencias.NOMBREAMBITO')
                                                                ->get();
                                                                                                            
                            return Datatables($datosambitos)
                            ->addColumn('action', function ($datosambitos) {
                                return '<a onclick="editarDetalleAmbito('.$datosambitos->IDAMBITOINFLUENCIA.')"class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editareee!"><span class="fa fa-edit"></span></a>                   
                                        <a onclick="eliminarAmbito('.$datosambitos->IDAMBITOINFLUENCIA.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                            })
                            ->removeColumn('IDOBJETIVOESTRATEGICO')
                            ->make(true);
                        }
                    }
                    public function eliminarAmbitoObjetivo(Request $r){
                        if($r->ajax()){
                            $eliminar = Ambitoinfluencia::where(['IDAMBITOINFLUENCIA' => $r->IDAMBITOINFLUENCIA])
                                                            ->delete();
                            
                            echo 'eliminado';          
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
                    $idAlcance = $r->idalcance;
                    $datosalcance = Alcance::join('objetivosestrategicos', 'objetivosestrategicos.IDOBJETIVOESTRATEGICO', '=', 'alcances.IDOBJETIVOESTRATEGICO')
                                                        ->where('alcances.IDOBJETIVOESTRATEGICO', '=' ,$r->idobjetivo)
                                                        ->select('alcances.IDALCANCE','objetivosestrategicos.DESCRIPCION','alcances.DESCRIPCIONALCANCE')
                                                        ->get();
                                                    
                    return Datatables($datosalcance)
                    ->addColumn('action', function ($datosalcance) {
                        return '<a onclick="editarDetalleAmbito('.$datosalcance->IDALCANCE.')"class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>                   
                                <a onclick="eliminarAlcance('.$datosalcance->IDALCANCE.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminarte!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->removeColumn('IDOBJETIVOESTRATEGICO')
                    ->make(true);
                }
            }
            public function eliminarAlcanceObjetivo(Request $r){
                if($r->ajax()){
                    $eliminar = Alcance::where(['IDALCANCE' => $r->IDALCANCE])
                                                    ->delete();
                    
                    echo 'eliminado';          
                }
            }
            public function eliminarObjetivo(Request $r){
                    Objetivo::where('IDOBJETIVOESTRATEGICO',$r->IDOBJETIVO)->delete();                    
                    echo 'eliminado';          
                
            }
            /*public function obtenerAmbitos($id = null){
                $ambitos = Ambitoinfluencia::all();
                return $ambitos;
            }*/

            public function datatablesObjetivosDeCatalogoObjetivos(Request $r){
                if($r->ajax()){
                    $idcatalogoobjetivo = $r->idcatalogoobjetivo;
                    if($idcatalogoobjetivo == null){
                        $datoscatalogo = Objetivo::join('catalogoobjetivos', 'catalogoobjetivos.IDCATALOGOOBJETIVO', '=', 'objetivosestrategicos.IDCATALOGOOBJETIVO')
                                                        
                                                        ->select('objetivosestrategicos.IDOBJETIVOESTRATEGICO',
                                                                'objetivosestrategicos.DESCRIPCION as descripcionobjetivo',
                                                                'objetivosestrategicos.LITERAL',
                                                                'catalogoobjetivos.NOMBRE as descripcioncatalogoobjetivo')
                                                        ->get();
                    }else{
                        $datoscatalogo = Objetivo::join('catalogoobjetivos', 'catalogoobjetivos.IDCATALOGOOBJETIVO', '=', 'objetivosestrategicos.IDCATALOGOOBJETIVO')
                                                        ->where('catalogoobjetivos.IDCATALOGOOBJETIVO', '=' ,$r->idcatalogoobjetivo)
                                                        ->select('objetivosestrategicos.IDOBJETIVOESTRATEGICO',
                                                                'objetivosestrategicos.DESCRIPCION as descripcionobjetivo',
                                                                'objetivosestrategicos.LITERAL',
                                                                'catalogoobjetivos.NOMBRE as descripcioncatalogoobjetivo')
                                                        ->get();
                    }
                    
                                                                                                    
                    return Datatables($datoscatalogo)
                     ->addColumn('action', function ($datoscatalogo) {
                        return '<a href="'.action('objetivos\DetalleObjetivoController@home',$datoscatalogo->IDOBJETIVOESTRATEGICO).'" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                        <a href="'.action('objetivos\ObjetivosController@crear',$datoscatalogo->IDOBJETIVOESTRATEGICO).'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                        <a onclick="eliminarObjetivo('.$datoscatalogo->IDOBJETIVOESTRATEGICO.')" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="eliminar!"><span class="fa fa-trash-o"></span></a>';
                    })
                    
                    ->make(true);
                }
            }
}