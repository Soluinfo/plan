<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Objetivoestrategico;
use App\Ambitoinfluencia;
use App\Alcance;
use App\Empleado;
 
class ObjetivoHelper {
    /**
     * @param int $id
     * 
     * @return object
     */
    public function obtenerObjetivo($id){
        
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
        $objetivos = Objetivoestrategico::where('IDOBJETIVOESTRATEGICO',$IDOBJETIVOESTRATEGICO)
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

}
