<?php

namespace App\Http\Controllers\proyectos;

use Illuminate\Support\Facades\DB;
use Excel;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Proyecto;
use App\Empleado;
use App\Proyectosupervisor;
use App\Catalogoobjetivo;
use App\Objetivo;
use App\Proyectosobjetivos;
use App\Catalogoindicador;
use App\Indicador;
use App\Helpers\ProyectoHelper;
use App\Helpers\ReporteHelper;
use App\ReportesGeneral;


class ProyectoController extends Controller
{
    public function home(){
        //$proyectos = $this->obtener(null);
        $proyectos = ProyectoHelper::obtenerProyectos(null);
        return view('proyectos.proyecto',['proyectos' => $proyectos]);
    }
    
    //inicio de funcion crear que muestra la vista del formulario de creacion de proyecto
        public function crear($id = null){
            $datosDeProyecto = array();
            $transaccion = 1;
            if($id == null){

            }else{
                $Proyecto = $this->obtener($id);
                if(isset($Proyecto)){
                    foreach($Proyecto as $p){
                        $datosDeProyecto['IDPROYECTO'] = $p->IDPROYECTO;
                        $datosDeProyecto['NOMBREPROYECTO'] = $p->NOMBREPROYECTO;
                        $datosDeProyecto['FECHAPROYECTO'] = $p->FECHAPROYECTO;
                        $datosDeProyecto['FECHAFINAL'] = $p->FECHAFINAL;
                        $datosDeProyecto['ESTADOPROYECTO'] = $p->ESTADOPROYECTO;
                        $datosDeProyecto['SERIAL_DEP'] = $p->SERIAL_DEP;
                    }
                }
            }
            
            $departamentos = DB::table('departamento')->get();
            $supervisores = $this->obtenerSupervisores(null);
            $catalogo = $this->obtenerCatalogoObjetivo(null);
            $catalogoindicador = $this->obtenerCatalogoIndicador(null);
            return view('proyectos.crearProyecto')->with(['departamento' => $departamentos,
                                                            'supervisores' => $supervisores,
                                                            'catalogo' => $catalogo,
                                                            'catalogoindicador' => $catalogoindicador
                                                            ])
                                                            ->with($datosDeProyecto);
        }
    //fin de funcion crear

    //inicio de funcion para guardar proyectos
        public function guardar(Request $r){
            if($r->ajax()){
                $datos = array('respuesta' => 'no','codigo' => 0,'transaccion' => 'guardar');
                $idProyecto = $r->idproyecto;
                
                if($idProyecto > 0){
                    $proyecto = Proyecto::where('IDPROYECTO', $idProyecto)
                                        ->update([
                                        'NOMBREPROYECTO' => $r->txtnombreProyecto,
                                        'FECHAPROYECTO' => $r->dpFechaProyecto,
                                        'FECHAFINAL' => $r->dpFechaFinalProyecto,
                                        'ESTADOPROYECTO' => $r->slEstado,
                                        'IDDEPARTAMENTO' => $r->slDepartamento
                                        ]);
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $idProyecto;
                    $datos['transaccion'] = 'actualizar';
                }else{
                    $proyecto = new Proyecto(array(
                        'NOMBREPROYECTO' => $r->txtnombreProyecto,
                        'FECHAPROYECTO' => $r->dpFechaProyecto,
                        'FECHAFINAL' => $r->dpFechaFinalProyecto,
                        'ESTADOPROYECTO' => $r->slEstado,
                        'IDDEPARTAMENTO' => $r->slDepartamento
                    ));
                    $proyecto->save();
                    $id = $proyecto->id;
                    $datos['respuesta'] = 'ok';
                    $datos['codigo'] = $id;
                    $datos['transaccion'] = 'guardar';
                }
                
                echo json_encode($datos);
            }
        }
    //fin de funcion guardar

    //Inicio de funcion para obtener todos los proyecto con su departamento respectivo
        public function obtener($id = null){
            if($id == null){
                $proyectos = Proyecto::join('departamento', 'proyectos.IDDEPARTAMENTO', '=', 'departamento.SERIAL_DEP')
                                    
                                    ->select('proyectos.*','departamento.*')
                                    ->get();
            }else{
                $proyectos = Proyecto::join('departamento', 'proyectos.IDDEPARTAMENTO', '=', 'departamento.SERIAL_DEP')
                                    ->where('IDPROYECTO',$id)
                                    ->select('proyectos.*','departamento.*')
                                    ->get();
            }
           
            return $proyectos;
        }
    //fin de funcion obtener

    //inicio de funcion para obtener todos los empleado o personal que puede ser un supervisor de proyecto
        public function obtenerSupervisores($id = null){
            $supervisores = Empleado::all();
            return $supervisores;
        }
    //final de funcion obtenerSupervisores

    //incion funcion para asignar un supervisor a un proyecto
        public function asignarSupervisor(Request $r){
            if($r->ajax()){
                $datos = array('respuesta' => 'no','mensaje' => '');
                $verificarSupervisor = $this->verificarSupervisorProyectoExiste($r->IDPROYECTO,$r->IDSUPERVISOR);
                if($verificarSupervisor == true){
                    $datos['respuesta'] = 'existe';
                    $datos['mensaje'] = 'El supervisor seleccionado ya se encuentra asignado a este proyecto';
                }else{
                    $asignacion = new Proyectosupervisor([
                        'IDPROYECTO' => $r->IDPROYECTO,
                        'IDSUPERVISOR' => $r->IDSUPERVISOR,
                        'ESTADO' => '1',
                        'FECHAPROYECTOSUPERVISOR' => date('Y-m-d')
                    ]);
                    $asignacion->save();
                    $datos['respuesta'] = 'ok';
                    $datos['mensaje'] = 'Supervisor asignado con exito';
                }
                
                echo json_encode($datos);
            }
        }
    //end funcion asignarSupervisor
    
    //inicio de funcion para obtener supervisores de un determinado proyecto
        public function obtenerSupervisoresDeProyecto(Request $r){
            if($r->ajax()){
                $datosdesupervisor = Empleado::join('proyectosupervisor', 'empleado.SERIAL_EPL', '=', 'proyectosupervisor.IDSUPERVISOR')
                                                    ->where('proyectosupervisor.IDPROYECTO', '=' ,$r->idproyecto)
                                                    ->select('empleado.SERIAL_EPL','empleado.DOCUMENTOIDENTIDAD_EPL','empleado.NOMBRE_EPL','empleado.APELLIDO_EPL','empleado.EMAIL_EPL','empleado.CELULAR_EPL')
                                                    ->get();
                                                
                return Datatables($datosdesupervisor)
                ->addColumn('action', function ($datosdesupervisor) {
                    return '<a onclick="obtenerDetalleSupervisor('.$datosdesupervisor->SERIAL_EPL.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                            <a onclick="agregarObjetivos('.$datosdesupervisor->SERIAL_EPL.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                })
                ->make(true);
            }
        }
    //final de funcion obtenerSupervisoresDeProyecto

    

    //inicio de funcion para validar si existe supervisor asignado a proyecto
        public function verificarSupervisorProyectoExiste($idproyecto,$idsupervisor){
            $datosdesupervisor = Proyectosupervisor::where([
                                                        ['IDPROYECTO','=',$idproyecto],
                                                        ['IDSUPERVISOR','=',$idsupervisor]
                                                    ])
                                                    ->count();
            if($datosdesupervisor > 0){
                return true;
            }else{
                return false;
            }
        }
    //final de funcion verificarSupervisorProyectoExiste

    //inicio de function para obtener los catalogos de objetivos
        public function obtenerCatalogoObjetivo($id = null){
            $catalogoObjetivos = Catalogoobjetivo::all();
            return $catalogoObjetivos;
        }
    //final de funcion obtenerCatalgoObjetivos
        public function obtenerCatalogoIndicador($id = null){
            $catalogoIndicador = Catalogoindicador::all();
            return $catalogoIndicador;
        }
    //inicio funcion para obtener catalogos indicadores

    //final funcion para obtener catalogos indicadores
  
    public function datatableObjetivo(Request $r){
        $obtenerObjetivos = Objetivo::where('IDCATALOGOOBJETIVO',$r->idcatalogo)
                                                        ->select('IDOBJETIVOESTRATEGICO',
                                                            'LITERAL',
                                                            'DESCRIPCION'
                                                        );
                                                    
        return Datatables($obtenerObjetivos)
                    ->addColumn('action', function ($obtenerObjetivos) {
                        return '<a onclick="agregarObjetivos('.$obtenerObjetivos->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>Agregar</a>';
                    })
                    ->make(true);
    }

    public function datatableIndicador(Request $r){
        $obtenerIndicador = Indicador::where('IDCATALOGOINDICADORES',$r->idcatalogo)
                                                        ->select('IDINDICADORES',
                                                            'DESCRIPCION'
                                                        );
                                                    
        return Datatables($obtenerIndicador)
                    ->addColumn('action', function ($obtenerIndicador) {
                        return '<a onclick="agregarObjetivos('.$obtenerIndicador->IDINDICADORES.')" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i>Agregar</a>';
                    })
                    ->make(true);
    }

    public function datatableObjetivosProyecto(Request $r){
        $idProyecto = $r->idproyecto;
        $objetivosProyeto = Objetivo::join('proyectosobjetivos','objetivosestrategicos.IDOBJETIVOESTRATEGICO','=','proyectosobjetivos.IDOBJETIVOESTRATEGICO')
                                                ->where('proyectosobjetivos.IDPROYECTO', $r->idproyecto)
                                                ->select('objetivosestrategicos.IDOBJETIVOESTRATEGICO',
                                                        'objetivosestrategicos.LITERAL',
                                                        'objetivosestrategicos.DESCRIPCION',
                                                        'proyectosobjetivos.IDPROYECTO'
                                                    );
            return Datatables($objetivosProyeto)
                    ->addColumn('action', function ($objetivosProyeto) {
                        return '<a onclick="obtenerDetalleObjetivo('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarObjetivoProyecto('.$objetivosProyeto->IDOBJETIVOESTRATEGICO.','.$objetivosProyeto->IDPROYECTO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->removeColumn('IDPROYECTO')
                    ->make(true);
    }

    public function datatableIndicadorProyectos(Request $r){
        $idProyecto = $r->idproyecto;
        $indicadorProyeto = Indicador::join('proyectosindicadores','indicadores.IDINDICADORES','=','proyectosindicadores.IDINDICADOR')
                                                ->where('proyectosindicadores.IDPROYECTO', $r->idproyecto)
                                                ->select('indicadores.IDINDICADORES',
                                                        'indicadores.DESCRIPCION',
                                                        'proyectosindicadores.IDPROYECTO'
                                                    );
            return Datatables($indicadorProyeto)
                    ->addColumn('action', function ($indicadorProyeto) {
                        return '<a onclick="obtenerDetalleIndicador('.$indicadorProyeto->IDINDICADORES.')" class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Detalle!"><i class="fa fa-info-circle"></i></a>
                                <a onclick="eliminarIndicadorProyecto('.$indicadorProyeto->IDINDICADORES.','.$indicadorProyeto->IDPROYECTO.')" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar!"><i class="fa fa-trash-o"></i></a>';
                    })
                    ->removeColumn('IDPROYECTO')
                    ->make(true);
    }

    public function asignarObjetivoProyecto(Request $r){
        if($r->ajax()){
            $datos = array('respuesta' => 'no','mensaje' => '');
            $verificarObjetivo = $this->verificarObjetivoProyectoExiste($r->IDPROYECTO,$r->IDOBJETIVOESTRATEGICO);
            if($verificarObjetivo == true){
                $datos['respuesta'] = 'existe';
                $datos['mensaje'] = 'El objetivo seleccionado ya se encuentra asignado a este proyecto';
            }else{
                $Proyectosobjetivos = new Proyectosobjetivos(array(
                    'IDPROYECTO' => $r->IDPROYECTO,
                    'IDOBJETIVOESTRATEGICO' => $r->IDOBJETIVOESTRATEGICO,
                ));
                $Proyectosobjetivos->save();
                $datos['respuesta'] = 'ok';
                $datos['mensaje'] = 'Objetivo estrategico asignado al proyecto';
            }
            
            echo json_encode($datos);
        }
    }
    //inicio de funcion para validar si existe objetivo asignado a proyecto
        public function verificarObjetivoProyectoExiste($idproyecto,$idobjetivo){
            $datosdeobjetivo = Proyectosobjetivos::where([
                                                        ['IDPROYECTO','=',$idproyecto],
                                                        ['IDOBJETIVOESTRATEGICO','=',$idobjetivo]
                                                    ])
                                                    ->count();
            if($datosdeobjetivo > 0){
                return true;
            }else{
                return false;
            }
        }
    //final de funcion verificarSupervisorProyectoExiste

    //funcion de validacion si existe proyecto
        public function validarExisteProyecto(Request $r){
            if($r->ajax()){
                
                $respuesta = ProyectoHelper::existeProyecto($r->txtnombreProyecto,$r->IDPROYECTO);
                if($respuesta == true){
                    //return ['valid'=>true, 'messages' => 'Proyecto existe'];
                    echo 'false';
                }else{
                    //return ['valid'=>false];
                    echo 'true';
                }
            }
        }
    //end funcion validacion proyecto
    //funcion para eliminar objetivo de proyecto
    public function eliminarProyectoObjetivo(Request $r){
        if($r->ajax()){
            $eliminar = Proyectosobjetivos::where(['IDOBJETIVOESTRATEGICO' => $r->IDOBJETIVOESTRATEGICO, 'IDPROYECTO' => $r->IDPROYECTO])
                                            ->delete();
            
            echo 'eliminado';          
        }
    }
    public function eliminarProyecto(Request $r){
        if($r->ajax()){
            
            $eliminar = Proyecto::where(['IDPROYECTO',$id])
            //$eliminar['mensaje'] = 'Esta seguro que desea eliminar el proyecto?';
            
                                            ->delete();
            
            echo 'Proyecto Eliminado';          
        }
    }
        

    public function ExportarExcel(){
        
                   Excel::create('Proyectos', function($excel) {
                    
                           $excel->sheet('proyecto', function($sheet)  {
                           
                                //$sheet->mergeCells('A1:E1');
                                
                                   $sheet->setBorder('A1:F1', 'thin');
                                
                                   $sheet->cells('A1:F1', function($cells)
                                   {
                                 $cells->setBackground('#C0C0C0');
                                 $cells->setFontColor('#800000');
                                 $cells->setAlignment('center');
                                 $cells->setValignment('center');
                                });
                                $sheet->setWidth(array
                                (
                                    'A' => '25',
                                    'B' => '35',
                                    'C' => '25',
                                    'D' => '25',
                                    'E' => '25',
                                    'F' => '25',
                                    
                                )
                               );
                            
                               $sheet->setHeight(array
                                (
                                 '1' => '25'
                                )
                               ); 
                            //$sheet->mergeCells('A1:E1');
                            //$sheet->row(1, ['ejemplo']);
                            $sheet->row(1, ['Proyecto', 'Departamento', 'Fecha', 'Estado', 'Supervisor', 'Objetivo']);
                               //$datos = Proyectosupervisor::all();
                               //$arrayProyecto = array();
                               //$proyectos = ProyectoHelper::obtenerProyectos(null);
                               $datosdesupervisor = ProyectoHelper::obtenerSupervisoresDeProyecto(null);
                               $supervisor = ProyectoHelper::obtenerSupervisoresDeProyectos(null);
                               
                               $datosf = array_collapse([$datosdesupervisor,$supervisor]);
                               //$datosdeproyecto = ProyectoHelper::obtenerObjetivosDeProyecto(null);
                              
                               //$datosf = $supervisor->$proyectos;
                               //$datos = $this->obtenerSupervisoresDeProyecto(null);
                                     
                               foreach ($datosf  as $p){
                                   $row = [];
                                   $row[0] = $p->NOMBREPROYECTO;
                                   $row[1] = $p->DESCRIPCION_DEP;
                                   $row[2] = $p->FECHAPROYECTO;
                                   $row[3] = $p->ESTADOPROYECTO;
                                   $row[4] = $p->NOMBRE_EPL;
                                   $row[5] = $p->IDOBJETIVOESTRATEGICO;
                                   //$row[6] = $p->DESCRIPCION;
                                   
                                $sheet->appendRow($row);
                               }
                              
                               
                               //$datos = Proyecto::select('IDPROYECTO', 'NOMBREPROYECTO', 'FECHAPROYECTO', 'ESTADOPROYECTO', 'IDDEPARTAMENTO')->get();
                               //$sheet->fromArray($datos);
        
                              
                            
                           });
                       })->export('xls');
                    
        }
        public function ExportarExcelId($id){
            
                       Excel::create('Proyecto', function($excel) {
                        
                               $excel->sheet('proyecto', function($sheet)  {
                               
                                    //$sheet->mergeCells('A1:E1');
                                    
                                       $sheet->setBorder('A1:F1', 'thin');
                                    
                                       $sheet->cells('A1:F1', function($cells)
                                       {
                                     $cells->setBackground('#C0C0C0');
                                     $cells->setFontColor('#800000');
                                     $cells->setAlignment('center');
                                     $cells->setValignment('center');
                                    });
                                    $sheet->setWidth(array
                                    (
                                        'A' => '25',
                                        'B' => '35',
                                        'C' => '25',
                                        'D' => '25',
                                        'E' => '25',
                                        'F' => '25',
                                        
                                    )
                                   );
                                
                                   $sheet->setHeight(array
                                    (
                                     '1' => '25'
                                    )
                                   ); 
                                //$sheet->mergeCells('A1:E1');
                                //$sheet->row(1, ['ejemplo']);
                                $sheet->row(1, ['Proyecto', 'Departamento', 'Fecha', 'Estado', 'Supervisor', 'idObjetivo', 'objetivo']);
                                   //$datos = Proyectosupervisor::all();
                                   
                                   $datos = ProyectoHelper::obtenerProyectos($id=null);
                                   $objetivos = ProyectoHelper::obtenerArrayProyecto($datos);
                                   $datosfinales = array_collapse([$datos,$objetivos]);
                                   //$obtiene = $datos->$obtiene;
                                   //$datos = $this->obtenerSupervisoresDeProyecto(null);
                                  
                                    
                                                                        
                                   foreach ($datosfinales as $p){
                                       $row = [];
                                       $row[0] = $p->NOMBREPROYECTO;
                                       $row[1] = $p->FECHAPROYECTO;
                                       $row[2] = $p->DESCRIPCION_DEP;
                                       
                                       
                                    $sheet->appendRow($row);
                                   }
                                   
                                   //$datos = Proyecto::select('IDPROYECTO', 'NOMBREPROYECTO', 'FECHAPROYECTO', 'ESTADOPROYECTO', 'IDDEPARTAMENTO')->get();
                                   //$sheet->fromArray($datos);  
                               });
                           })->export('xls');
                        
            }
//FUNCION PARA EXPORTAR EN FORMATO PDF UN SOLO PROYECTO
public function Exportarpdf($id){
    //$arrayProyecto = array();
    $mpdf = new mPDF();
    $mpdf = new \Mpdf\Mpdf(['setAutoTopMargin' => 'stretch']);
    $proyectos = ProyectoHelper::obtenerProyectos($id);
    $datosDeReporte = ReporteHelper::obtenerReportes(null);
    $supervisor = ProyectoHelper::obtenerSupervisoresDeProyectos($id);
    $datosdeproyecto = ProyectoHelper::obtenerObjetivosDeProyecto($id);
    $datosf = array_collapse([$datosDeReporte,$proyectos,$supervisor,$datosdeproyecto]);
   
    //$datosf = $proyectos->$supervisor->$datosdeproyecto;
    //$mpdf->SetHeader('Colegio Nacional Cristo Rey|Center Text|');
    $mpdf->SetFooter('<img src="img/direccion.png" width="700" height="80"/>{PAGENO}');
    $mpdf->SetTitle('Reportes');
    //$arrayProyecto = ProyectoHelper::obtenerArrayProyecto($Proyectos);
   $accion = view('proyectos.reportepdf',['datosf' => $datosf])->render();
if($accion=='html'){
    return view('proyectos.reportepdf',['datosf' => $datosf]);
}else{
    $html = view('proyectos.reportepdf',['datosf' => $datosf])->render();
}
//$html = view('proyectos.reportepdf',['proyectos' => $proyectos])->render();
$mpdf->writeHTML($html);
$mpdf->Output("prueba.pdf","I");
//return view('proyectos.reportepdf',['proyectos' => $proyectos]);
   
}
//FIN DE LA FUNCION PARA EXPORTAR EN PDF UN SOLO PROYECTO

//FUNCION PARA EXPORTAR EN FORMATO PDF LOS PROYECTOS DE FORMA GNERAL
public function  reportepdfcompleto(){
    //$proyectos = Proyecto::all();
    //$supervisor = ProyectoHelper::obtenerSupervisoresDeProyectos(null);
    //$datosDeReporte = ReporteHelper::obtenerReportes(null);
    //$datosdeproyecto = ProyectoHelper::obtenerdatosreportegeneral(null);
    
    $datosDeProyecto = ProyectoHelper::obtenerProyectos(null);
    $Objetivos = ProyectoHelper::obtenerObjetivosDeProyecto(null);  
    $datosfinales = array_collapse([$datosDeProyecto,$Objetivos]);
    $mpdf = new mPDF();
    $mpdf = new \Mpdf\Mpdf([
        'setAutoTopMargin' => 'stretch',
        'autoMarginPadding' => 5
       
    ]);
         
    $mpdf->SetHeader('<img src="img/colegio.jpg" width="300" height="50"/>');

    //$mpdf->SetFooter('<img src="img/direccion.png" width="700" height="80"/>{PAGENO}/{nbpg}');
    $mpdf->SetFooter('{PAGENO}/{nbpg}');
       $mpdf->SetTitle('Reportes');
       $mpdf->SetWatermarkText("Colegio Cristo Rey");//Marca de agua       
       $mpdf->showWatermarkText = true; // activar/Desactivar marca de agua (True/false)
       $mpdf->watermarkTextAlpha = 0.1;// Trasnparencia de la marca de agua (0-1)
       $mpdf->AddPage('P'); // Orientacion de la pagina (P/L)
       $mpdf->SetDisplayMode('fullpage'); // Modo de visualizacion a pantalla completa.

       $accion = view('proyectos.reportepdfgeneral',['datosfinales' => $datosfinales])->render();
       if($accion=='html'){
           return view('proyectos.reportepdfgeneral',['datosfinales' => $datosfinales]);
       }else{
           $html = view('proyectos.reportepdfgeneral',['datosfinales' => $datosfinales])->render();
       }

       $mpdf->writeHTML($html);
                $mpdf->Output("Reporte-Proyecto.pdf","I");
            }
        
    }


