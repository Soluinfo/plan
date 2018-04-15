<?php

namespace App\Http\Controllers\objetivos;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Catalogoobjetivo;
use App\Objetivo;
use App\Helpers\ObjetivoHelper;


class CatalogoObjetivosController extends Controller
{
    public function home(){
        $catalogo = catalogoobjetivo::all();
        return view('objetivos.catalogoObjetivos', compact('catalogo'));
              
    }

    public function crear($id = null){
        $datosDeCatalogo = array();
        $transaccion = 1;
        if($id == null){
            
        }else{
            $Catalogoobjetivo = $this->obtener($id);
            if(isset($Catalogoobjetivo)){
                foreach($Catalogoobjetivo as $p){
                    $datosDeCatalogo['IDCATALOGOOBJETIVO'] = $p->IDCATALOGOOBJETIVO;
                    $datosDeCatalogo['NOMBRE'] = $p->NOMBRE;
                    $datosDeCatalogo['FECHA'] = $p->FECHA;
                    $datosDeCatalogo['ESTADO'] = $p->ESTADO;
                }
            }
        }
        $catalogoobjetivo = DB::table('objetivosestrategicos')->get();        
        //$ambitos = $this->obtenerAmbitos(null);
        //$alcances = $this->obtenerAlcances(null);
        return view('objetivos.crearcatalogo')->with(['objetivosestrategicos' => $catalogoobjetivo])
                                                            ->with($datosDeCatalogo);
        
    }
    

    public function guardar(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
            $idCatalogoobjetivo = $r->idcatalogoobjetivo;

            if($idCatalogoobjetivo > 0){
                $catalogoobjetivo = Catalogoobjetivo::where('IDCATALOGOOBJETIVO', $idCatalogoobjetivo)
                                    ->update([
                                    'NOMBRE' => $r->txtnombre,
                                    'FECHA' => $r->dpFecha,
                                    'ESTADO' => $r->slEstado
                                    ]);
                $datos['respuesta'] = 'ok';
                $datos['codigo'] = $idCatalogoobjetivo;
                $datos['transaccion'] = 'actualizar';
                }else{
                    $catalogoobjetivo = new Catalogoobjetivo(array(
                        'NOMBRE' => $r->txtnombre,
                        'FECHA' => $r->dpFecha,
                        'ESTADO' => $r->slEstado 
                    ));
                    $catalogoobjetivo->save();
                    $id = $catalogoobjetivo->id;
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $id;
                    $datos['transaccion'] = 'guardar';
                }
                echo json_encode($datos);
            }
        }
        public function obtener($id = null){
            if($id == null){
                $catalogoobjetivos = Catalogoobjetivo::all();
            }else{
                $catalogoobjetivos = Catalogoobjetivo::where('catalogoobjetivos.IDCATALOGOOBJETIVO',$id)
                
                ->get();
            }
            return $catalogoobjetivos;
        }
       
       
        /*public function obtener($id = null){
            $catalogo = Catalogoobjetivos::select('catalogoobjetivos.*')
                                ->get();
            return $catalogo;
        }*/

        public function actualizar($id)
        { 
            $catalogoobjetivo = Catalogoobjetivo::where('IDCATALOGOOBJETIVO', $id)->first(); 
    
            Session::flash('message','Usuario actualizado correctamente');
            return view('objetivos.crearcatalogo');   
        }

        public function eliminar($id)
        {
            
            $id = $catalogoobjetivo->id;
            $id::destroy($id);
            return view('objetivos.objetivos');
        }

        
        /*public function destroy2($IDCATALOGOOBJETIVO)
        {
            
            $catalogo = catalogoobjetivo::find($IDCATALOGOOBJETIVO);
            $catalogo->delete();
           
          Session::flash('message','Catalogo eliminado correctamente');
          return view('objetivos.objetivos');
        }*/

        public function datatablesCataObjetivos(Request $r){
            if($r->ajax()){
                $datoscatalogo = Catalogoobjetivo::select('catalogoobjetivos.IDCATALOGOOBJETIVO', 
                                                    'catalogoobjetivos.NOMBRE',
                                                    'catalogoobjetivos.FECHA',
                                                    'catalogoobjetivos.ESTADO')
                                                    ->get();
                                                
                return Datatables($datoscatalogo)
                /*->editColumn('ESTADO', function($datoscatalogo) {
                    if($datoscatalogo->ESTADO == 1){
                        return '<a class="btn btn-default">ACTIVO</a>';
                    }else{
                        return '<span class="label label-danger">INACTIVO</span>';
                    }
                })*/
                
                ->editColumn('ESTADO', function ($datoscatalogo){
                    $datos = '';
                    if($datoscatalogo->ESTADO == 1){
                        $datos .= '<span class="label label-success">ACTIVO</span>';
                    }else{
                        $datos .= '<span class="label label-danger">INACTIVO</span>';
                    }
                    return $datos;
                })
                 ->addColumn('action', function ($datoscatalogo) {
                    return '<a href="'.action('objetivos\DetalleCatalogoObjetivosController@home',$datoscatalogo->IDCATALOGOOBJETIVO).'" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                            <a href="'.action('objetivos\CatalogoObjetivosController@crear',$datoscatalogo->IDCATALOGOOBJETIVO).'" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>                   
                            <a onclick="eliminarCatalogoDeObjetivos('.$datoscatalogo->IDCATALOGOOBJETIVO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                })->rawColumns(['ESTADO', 'action'])
                ->make(true);
            }
        }
        public function eliminarCatalogoObjetivos(Request $r){
            if($r->ajax()){
                $respuesta = '';
                $verificarSiTieneObjetivos = ObjetivoHelper::numeroObjetivoCatalogo($r->IDCATALOGOOBJETIVO);
                if($verificarSiTieneObjetivos > 0){
                    $respuesta = 'TieneObjetivosAsignados';
                }else{
                    $eliminar = Catalogoobjetivo::where(['IDCATALOGOOBJETIVO' => $r->IDCATALOGOOBJETIVO])
                                                ->delete();
                    $respuesta = 'eliminado';
                }
                echo $respuesta;     
            }
        }
    
                    
    }

