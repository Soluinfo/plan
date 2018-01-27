<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Indicador;
use App\Catalogoindicador;
 
class IndicadorHelper {
    /**
     * @param int $id
     * 
     * @return object
     */
    public static function obtenerIndicadores($id = null){
        if($id == null){
            $catalogoindicadores = Indicador::join('catalogoindicadores', 'indicadores.IDCATALOGOINDICADORES', '=', 'catalogoindicadores.IDCATALOGOINDICADORES')
                                
                                ->select('indicadores.*','catalogoindicadores.*')
                                ->get();
        }else{
            $catalogoindicadores = Indicador::join('catalogoindicadores', 'indicadores.IDCATALOGOINDICADORES', '=', 'catalogoindicadores.IDCATALOGOINDICADORES')
            ->where('IDINDICADORES',$id)
            ->select('indicadores.*','catalogoindicadores.*')
            ->get();
        }
        return $catalogoindicadores;
    }
    public static function obtenerArrayIndicador($objetoIndicador){
        $datosDeIndicador = array();
        if(isset($objetoIndicador)){
            foreach($objetoIndicador as $p){
                $datosDeIndicador['IDINDICADORES'] = $p->IDINDICADORES;
                $datosDeIndicador['NOMBRE'] = $p->NOMBRE;
                $datosDeIndicador['LITERAL'] = $p->LITERAL;
                $datosDeIndicador['DESCRIPCION'] = $p->DESCRIPCION;
                $datosDeIndicador['created_at'] = $p->created_at;
                $datosDeIndicador['updated_at'] = $p->updated_at;
                $datosDeIndicador['idusuario'] = $p->idusuario;
                //$datosDeObjetivo['IDCATALOGOOBJETIVO'] = $p->IDCATALOGOOBJETIVO;
            }
        }
        return $datosDeIndicador;
    }
    //Inicio de funcion para obtener todos los proyecto con su departamento respectivo
    public static function obtenerActividades($id = null){
        if($id == null){
            $actividad = Actividad::join('indicadores', 'actividades.IDINDICADORES', '=', 'indicadores.IDINDICADORES')
            
            ->select('indicadores.*','actividades.*')
            ->get();
}else{
$actividad = Actividad::join('indicadores', 'actividades.IDINDICADORES', '=', 'indicadores.IDINDICADORES')
            ->where('IDACTIVIDAD',$id)
            ->select('indicadores.*','actividades.*')
            ->get();
        }
    
        return $actividad;
    }
//fin de funcion obtener
}