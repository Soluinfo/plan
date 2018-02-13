<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Objetivo;
use App\Ambitoinfluencia;
use App\Alcance;
use App\Empleado;
use App\Catalogoobjetivo;
 
class ObjetivoHelper {
    /**
     * @param int $id
     * 
     * @return object
     */
    public function obtenerObjetivo($id){
        
    }
    public static function obtenerObjetivos($id = null){
        if($id == null){
            $objetivos = Objetivo::join('catalogoobjetivos', 'objetivosestrategicos.IDCATALOGOOBJETIVO', '=', 'catalogoobjetivos.IDCATALOGOOBJETIVO')
                                
                                ->select('objetivosestrategicos.*','catalogoobjetivos.*')
                                ->get();
        }else{
            $objetivos = Objetivo::join('catalogoobjetivos', 'objetivosestrategicos.IDCATALOGOOBJETIVO', '=', 'catalogoobjetivos.IDCATALOGOOBJETIVO')
            ->where('IDOBJETIVOESTRATEGICO',$id)
            ->select('objetivosestrategicos.*','catalogoobjetivos.*')
            ->get();
        }
        return $objetivos;
    }

    public static function obtenerArrayObjetivo($objetoObjetivo){
        $datosDeObjetivo = array();
        if(isset($objetoObjetivo)){
            foreach($objetoObjetivo as $p){
                $datosDeObjetivo['IDOBJETIVOESTRATEGICO'] = $p->IDOBJETIVOESTRATEGICO;
                $datosDeObjetivo['NOMBRE'] = $p->NOMBRE;
                $datosDeObjetivo['LITERAL'] = $p->LITERAL;
                $datosDeObjetivo['DESCRIPCION'] = $p->DESCRIPCION;
                $datosDeObjetivo['created_at'] = $p->created_at;
                $datosDeObjetivo['updated_at'] = $p->updated_at;
                $datosDeObjetivo['idusuario'] = $p->idusuario;
                //$datosDeObjetivo['IDCATALOGOOBJETIVO'] = $p->IDCATALOGOOBJETIVO;
            }
        }
        return $datosDeObjetivo;
    }

    public static function obtenerTablaObjetivo($IDOBJETIVOESTRATEGICO){
     
        $tabla = '<div class="table-responsive">
                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>Objetivos Estrategicos</th>
                        </tr>
                        </thead>
                        <tbody>';
        $objetivos = Objetivo::where('IDOBJETIVOESTRATEGICO',$IDOBJETIVOESTRATEGICO)
                                        ->get();
        if(isset($objetivos)){
            foreach($objetivos as $o){
                $tabla .= '<tr>
                                <td>
                                    <ul>
                                        <li><p><strong>'.$o->LITERAL.'.&nbsp; &nbsp;</strong>'.$o->DESCRIPCION.'<p>
                                        </li>
                                    </ul>
                                </td>
                            </tr>';
                $ambito = ObjetivoHelper::obtenerAmbito($o->IDOBJETIVOESTRATEGICO);
                $tabla .= '<tr><td>Ambito e influencia <p class="text-center">';
                if(isset($ambito)){
                    foreach($ambito as $a){
                        $tabla .= $a->NOMBREAMBITO.',';
                    }
                }
                $tabla .= '</p></td></tr>';
                $alcance = ObjetivoHelper::obtenerAlcance($o->IDOBJETIVOESTRATEGICO);
                $tabla .= '<tr>
                                <td>Alcance
                                <ul>';
                if(isset($alcance)){
                    foreach($alcance as $a){
                        $tabla .= '<li><p>'.$a->DESCRIPCIONALCANCE.'</p></li>';
                    }
                }
                $tabla .= '</ul></p></td></tr>';
                
            }
        }
        $tabla .= '</tbody>
                </table>
            </div>';
        return $tabla;
    }

    public static function obtenerAmbito($IDOBJETIVOESTRATEGICO){
        $ambitoinfluencia = Ambitoinfluencia::where('IDOBJETIVOESTRATEGICO',$IDOBJETIVOESTRATEGICO)
                                            ->get();
        return $ambitoinfluencia;
    }
    public static function editarAmbito($IDAMBITOINFLUENCIA){
        $ambitoinfluencia = Ambitoinfluencia::where('IDAMBITOINFLUENCIA',$IDAMBITOINFLUENCIA)
                                            ->select('ambitosinfluencias.NOMBREAMBITO')
                                            ->get();
                                            
        return $ambitoinfluencia;
    }

    public static function obtenerAlcance($IDOBJETIVOESTRATEGICO){
        $alcance = Alcance::where('IDOBJETIVOESTRATEGICO',$IDOBJETIVOESTRATEGICO)
                                            ->get();
        return $alcance;
    }

    public function obtenerTablaSupervisor($IDSUPERVISOR){
        $tabla = '<div class="table-responsive">
                    <table class="table table-bordered table-striped table-actions">
                        <thead>
                        <tr>
                            <th>informacion de supervisor</th>
                        </tr>
                        </thead>
                        <tbody>';
        $empleado = Empleado::where('SERIAL_EPL',$IDSUPERVISOR)
                                        ->get();
        if(isset($empleado)){
            foreach($empleado as $e){
                $tabla .= '<tr>
                                <td>
                                    <ul>
                                        <li><p><strong>'.$o->LITERAL.'.&nbsp; &nbsp;</strong>'.$o->DESCRIPCION.'<p>
                                        </li>
                                    </ul>
                                </td>
                            </tr>';
                $ambito = ObjetivoHelper::obtenerAmbito($o->IDOBJETIVOESTRATEGICO);
                $tabla .= '<tr><td>Ambito e influencia <p class="text-center">';
                if(isset($ambito)){
                    foreach($ambito as $a){
                        $tabla .= $a->NOMBREAMBITO.',';
                    }
                }
                $tabla .= '</p></td></tr>';
                $alcance = ObjetivoHelper::obtenerAlcance($o->IDOBJETIVOESTRATEGICO);
                $tabla .= '<tr>
                                <td>Alcance
                                <ul>';
                if(isset($alcance)){
                    foreach($alcance as $a){
                        $tabla .= '<li><p>'.$a->DESCRIPCIONALCANCE.'</p></li>';
                    }
                }
                $tabla .= '</ul></p></td></tr>';
                
            }
        }
        $tabla .= '</tbody>
                </table>
            </div>';
        return $tabla;
    }

    public static function obtenerCatalogo($id = null){
        if($id == null){
            $catalogo = Catalogoobjetivo::join('objetivosestrategicos', 'catalogoobjetivos.IDCATALOGOOBJETIVO', '=', 'objetivosestrategicos.IDCATALOGOOBJETIVO')
            
                                ->select('catalogoobjetivos.*','objetivosestrategicos.*')
                                ->get();
        }else{
            $catalogo = Catalogoobjetivo::join('objetivosestrategicos', 'catalogoobjetivos.IDCATALOGOOBJETIVO', '=', 'objetivosestrategicos.IDCATALOGOOBJETIVO')
            ->where('catalogoobjetivos.IDCATALOGOOBJETIVO',$id)
            ->select('catalogoobjetivos.*','objetivosestrategicos.*')
            ->get();
        }
        return $catalogo;
    }

    public static function obtenerArrayCatalogo($objetoCatalogo){
        $datosDeCatalogo = array();
        if(isset($objetoCatalogo)){
            foreach($objetoCatalogo as $p){
                $datosDeCatalogo['IDCATALOGOOBJETIVO'] = $p->IDCATALOGOOBJETIVO;
                $datosDeCatalogo['NOMBRE'] = $p->NOMBRE;
                $datosDeCatalogo['DESCRIPCION'] = $p->DESCRIPCION;
                $datosDeCatalogo['FECHA'] = $p->FECHA;
                $datosDeCatalogo['ESTADO'] = $p->ESTADO;
                $datosDeCatalogo['created_at'] = $p->created_at;
                $datosDeCatalogo['updated_at'] = $p->updated_at;
                $datosDeCatalogo['idusuario'] = $p->idusuario;
                $datosDeObjetivo['IDOBJETIVOESTRATEGICO'] = $p->IDOBJETIVOESTRATEGICO;
                
            }
        }
        return $datosDeCatalogo;
    }

    public static function obtenerObjetivosDeProyecto($idproyecto){
        $objetivosProyecto = Objetivo::join('proyectosobjetivos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','proyectosobjetivos.IDOBJETIVOESTRATEGICO')
                                    ->where('proyectosobjetivos.IDPROYECTO', $idproyecto)
                                    ->select('objetivosestrategicos.*','proyectosobjetivos.*')
                                    ->get();
        return $objetivosProyecto;
        
    }

}
