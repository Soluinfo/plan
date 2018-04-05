<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Recurso;

class RecursoHelper {
    public static function obtener($idrecurso = null){
        if($idrecurso == null){
            $datosrecurso = Recurso::all();
        }else{
            $datosrecurso = Recurso::where('IDRECURSO','=',$idrecurso)
                                    ->get();
        }
        return $datosrecurso;
    }

    public static function obtenerarrayRecurso($objetorecurso){
        $datosDeRecurso = array();
        if(isset($objetorecurso)){
            foreach($objetorecurso as $p){
                $datosDeRecurso['IDRECURSO'] = $p->IDRECURSO;
                $datosDeRecurso['NOMBRERECURSO'] = $p->NOMBRERECURSO;
                $datosDeRecurso['ESTADO'] = $p->ESTADO;
                $datosDeRecurso['IDACTIVIDAD'] = $p->IDACTIVIDAD;
                $datosDeRecurso['IDDIRECTORIORECURSO'] = $p->IDDIRECTORIORECURSO;
                $datosDeRecurso['PORCENTAJERECURSO'] = $p->PORCENTAJERECURSO;
                $datosDeRecurso['NOMBREARCHIVO'] = $p->NOMBREARCHIVO;
                $datosDeRecurso['PESODEARCHIVO'] = $p->PESODEARCHIVO;
                $datosDeRecurso['IDDIRECTORIOARCHIVO'] = $p->IDDIRECTORIOARCHIVO;
                $datosDeRecurso['created_at'] = $p->created_at;
                $datosDeRecurso['updated_at'] = $p->updated_at;
                $datosDeRecurso['idusuario'] = $p->idusuario;
                
            }
        }
        return $datosDeRecurso;
    }

    public static function obtenerValorMaxPorcentaje($idactividad){
        $porcentajemax = 100;
        $porcentajevalidado = 0;
        $contadormax = Recurso::where('IDACTIVIDAD','=', $idactividad)->get();
        if($contadormax){
            foreach($contadormax as $c){
                $porcentajevalidado = $porcentajevalidado + $c->PORCENTAJERECURSO;
            }
        }
        return $porcentajemax - $porcentajevalidado;
    }
}