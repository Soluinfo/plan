<?php

namespace App\Http\Controllers\objetivos;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Catalogoobjetivo;


class CatalogoController extends Controller
{
    public function home(){
        $catalogo = catalogoobjetivo::all();
        return view('objetivos.catalogo', compact('catalogo'));
              
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
                $catalogoobjetivos = Catalogoobjetivo::join('objetivosestrategicos', 'catalogoobjetivos.IDCATALOGOOBJETIVO', '=', 'objetivosestrategicos.IDCATALOGOOBJETIVO')
                                ->select('catalogoobjetivos.*','objetivosestrategicos.*')
                                ->get();
            }else{
                $catalogoobjetivos = Catalogoobjetivo::join('objetivosestrategicos', 'catalogoobjetivos.IDCATALOGOOBJETIVO', '=', 'objetivosestrategicos.IDCATALOGOOBJETIVO')
                ->where('catalogoobjetivos.IDCATALOGOOBJETIVO',$id)
                ->select('catalogoobjetivos.*','objetivosestrategicos.*')
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
                    
    }

