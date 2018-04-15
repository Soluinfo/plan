<?php
//app/Helpers/Proyecto
namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Indicador;
use App\Catalogoindicador;
use App\Proyectoindicador;
 
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

        public static function numeroIndicadoresProyecto($idproyecto){
            $numero = Proyectoindicador::where('IDPROYECTO',$idproyecto)->count();
            return $numero;
        }
        public static function obtenerCatalogoIndicadores($id = null){
            if($id == null){
                $catalogoIndicadores = Catalogoindicador::all();
            }else{
                $catalogoIndicadores = Catalogoindicador::where('catalogoindicadores.IDCATALOGOINDICADORES',$id)
                                                        ->select('catalogoindicadores.*')
                                                        ->get();
            }
            return $catalogoIndicadores;
        }

        public static function obtenerArrayCatalogoIndicadores($objetoCatalogoIndicador){
            $datosDeCatalogoIndicador = array();
            if(isset($objetoCatalogoIndicador)){
                foreach($objetoCatalogoIndicador as $p){
                    $datosDeCatalogoIndicador['IDCATALOGOINDICADORES'] = $p->IDCATALOGOINDICADORES;
                    $datosDeCatalogoIndicador['NOMBRE'] = $p->NOMBRE;
                    $datosDeCatalogoIndicador['DESCRIPCION'] = $p->DESCRIPCION;
                    $datosDeCatalogoIndicador['FECHA'] = $p->FECHA;
                    $datosDeCatalogoIndicador['ESTADO'] = $p->ESTADO;
                    $datosDeCatalogoIndicador['created_at'] = $p->created_at;
                    $datosDeCatalogoIndicador['updated_at'] = $p->updated_at;
                    $datosDeCatalogoIndicador['idusuario'] = $p->idusuario;
                    $datosDeObjetivoIndicador['IDINDICADORES'] = $p->IDINDICADORES;
                    
                }
            }
            return $datosDeCatalogoIndicador;
            }

            public static function obtenerObjetivosDeProyecto($idproyecto){
            $objetivosProyecto = Objetivo::join('proyectosobjetivos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','proyectosobjetivos.IDOBJETIVOESTRATEGICO')
                                        ->where('proyectosobjetivos.IDPROYECTO', $idproyecto)
                                        ->select('objetivosestrategicos.*','proyectosobjetivos.*')
                                        ->get();
            return $objetivosProyecto;

        }

        public static function numeroIndicadoresCatalogo($idcatalogo){
            $numero = Indicador::where('IDCATALOGOINDICADORES',$idcatalogo)->count();
            return $numero;
        }

        public static function numeroIndicadoresEnProyecto($idindicador){
            $numero = Proyectoindicador::where('IDINDICADOR',$idindicador)->count();
            return $numero;
        }

}