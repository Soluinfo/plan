<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Mail\emailsupervisor;
use Illuminate\Support\Facades\Mail;



Route::get('/', 'Auth\LoginController@login');
//Route::get('/login', 'Auth\LoginController@home');

Route::post('/principal', 'Auth\LoginController@principal')->name('principal');
Route::get('/principal', 'PrincipalController@home');
Route::get('/inicio', 'PrincipalController@home')->name('inicio');

Route::get('/objetivos', 'objetivos\CatalogoController@home');
Route::get('/crearobjetivo', 'objetivos\CatalogoController@crear');
Route::get('/proyectos', 'proyectos\ProyectoController@home');
//ruta para detalle de proyecto
Route::get('/proyectos/detalleProyecto/{id}','proyectos\DetalleProyectoController@home');
//sirve para guardar y editar proyectos
Route::get('/proyectos/crear/{id?}','proyectos\ProyectoController@crear')->where('id', '[0-9]+');
Route::get('/actividadesprogreso', 'proyectos\ActividadController@home');

Route::post('/proyectos/guardar', 'proyectos\ProyectoController@guardar');
Route::post('/proyectos/asignarSupervisorProyecto','proyectos\ProyectoController@asignarSupervisor');
Route::post('/proyectos/obtenerSupervisorProyecto','proyectos\ProyectoController@obtenerSupervisores');

Route::post('/objetivos/detalles', 'proyectos\DetalleProyectoController@obtenerDetalleObjetivo');
Route::post('/supervisor/detalles','proyectos\DetalleProyectoController@obtenerDetalleSupervisor');

Route::post('/proyectos/asignarObjetivoProyecto','proyectos\ProyectoController@asignarObjetivoProyecto');
Route::post('/proyectos/eliminarProyectoObjetivos','proyectos\ProyectoController@eliminarProyectoObjetivo');

//validaciones
Route::post('/proyectos/validacion/proyectoExiste','proyectos\ProyectoController@validarExisteProyecto');

//datatables
Route::post('/proyectos/objetivos','proyectos\ProyectoController@datatableObjetivo');
Route::post('/proyectos/indicador','proyectos\ProyectoController@datatableIndicador');
Route::post('/proyectos/datatableObjetivosProyecto','proyectos\ProyectoController@datatableObjetivosProyecto');
Route::post('/proyectos/obtenerSupervisoresProyectos','proyectos\ProyectoController@obtenerSupervisoresDeProyecto');
Route::post('/proyectos/obtenerIndicadorProyectos','proyectos\ProyectoController@datatableIndicadorProyectos');

//Diego Intriago
Route::post('/ambito/detalles', 'objetivos\DetalleObjetivoController@obtenerDetalleAmbito');


Route::get('/objetivos', 'objetivos\ObjetivosController@home');

Route::get('/objetivos/detalleObjetivo/{id}','objetivos\DetalleObjetivoController@home');

Route::post('/objetivos/datatableAmbitosObjetivo','objetivos\ObjetivosController@datatablesAmbito');
Route::post('/objetivos/datatableAlcanceObjetivo','objetivos\ObjetivosController@datatablesAlcance');

Route::get('/crearobjetivos/{id?}', 'objetivos\ObjetivosController@crear');
Route::post('/objetivos/guardar', 'objetivos\ObjetivosController@guardar');


Route::post('/ambito/editar', 'objetivos\DetalleObjetivoController@editarDetalleAmbito');

Route::post('/ambito/guardara', 'objetivos\ObjetivosController@guardarambito');
Route::post('/alcance/guardaralcance', 'objetivos\ObjetivosController@guardaralcance');


// rutas de catalogo
//Route::get('/catalogo', 'objetivos\CatalogoController@home');
Route::get('/catalogoObjetivos/editar/{id?}', 'indicadores\CatalogoIndicadorController@crear')->where('id', '[0-9]+');
Route::get('/crearcatalogo/{id?}', 'objetivos\CatalogoObjetivosController@crear');
Route::post('/crearcatalogo/guardar', 'objetivos\CatalogoController@guardar');

Route::get('/catalogo/detalleCatalogoObjetivos/{id}','objetivos\DetalleCatalogoObjetivosController@home');
Route::post('/catalogo/datatableCataloObjetivos','objetivos\CatalogoObjetivosController@datatablesCataObjetivos');

//rutas de indicadores
Route::get('/indicadores', 'indicadores\IndicadorController@home');
Route::get('/crearindicadores/{id?}', 'indicadores\IndicadorController@crear');
Route::post('/crearindicadores/guardar', 'indicadores\IndicadorController@guardar');
Route::get('/indicadores/detalleIndicador/{id}','indicadores\DetalleIndicadorController@home');
Route::get('/indicadores/detalleCatalogoIndicador/{id}','indicadores\DetalleCatalogoIndicadorController@home');
Route::post('/indicadores/datatableIndicadorActividad','proyectos\ActividadController@datatablesIndicador');
Route::post('/catalogo/datatableCatalogoIndicadores','indicadores\DetalleCatalogoIndicadorController@datatablesCatalogoIndicadores');

Route::post('/indicadores/datatableActividadIndicador','indicadores\IndicadorController@datatablesActividades');

Route::get('/catalogoindicadores', 'indicadores\CatalogoIndicadorController@home');
Route::get('/catalogo/crear{id?}', 'indicadores\CatalogoIndicadorController@crear');
Route::post('/crearcatalogoindicador/guardar', 'indicadores\CatalogoIndicadorController@guardar');

Route::get('/actividades', 'proyectos\ActividadController@inicio');
Route::get('/crearactividad/{id?}', 'proyectos\ActividadController@crear');
Route::post('/crearactividades/guardar', 'proyectos\ActividadController@guardar');
Route::post('/actividad/reprogramar', 'proyectos\ActividadController@guardaractividadFechas');
Route::post('/indicadores/reproActividades','proyectos\ActividadController@datatablesReproActividad');

Route::get('/proyectos/reporteexcel','proyectos\ProyectoController@ExportarExcel');
Route::get('/proyectos/reporteexcelid/{id?}','proyectos\ProyectoController@ExportarExcelId');
Route::get('/proyectos/reportepdf/{id}','proyectos\ProyectoController@Exportarpdf');


//Route::post('/actividades/datatableActividad','proyectos\ActividadController@datatableActividad');
Route::post('/actividades/asignarResponsableActividad','proyectos\ActividadController@asignarResponsable');
Route::post('/actividades/ObtenerResponsablesDeActividad','proyectos\ActividadController@obtenerResponsablesDeActividad');




Route::post('/ambito/guardara', 'objetivos\ObjetivosController@guardarambito');
Route::post('/alcance/guardaralcance', 'objetivos\ObjetivosController@guardaralcance');


// rutas de catalogo
Route::get('/catalogoObjetivos', 'objetivos\CatalogoObjetivosController@home');
//Route::get('/crearobjetivo/crear/{id?}', 'objetivos\CatalogoController@crear')->where('id', '[0-9]+');
//Route::get('/crearcatalogo/{id?}', 'objetivos\CatalogoController@crear');
Route::post('/crearcatalogo/guardar', 'objetivos\CatalogoController@guardar');

Route::get('/catalogo/detalleCatalogoIndicadores/{id}','objetivos\DetalleCatalogoIndicadorController@home');

Route::get('/proyectos/pdf', 'proyectos\ProyectoController@reportepdfcompleto');




//rutas de atividades
Route::post('/actividades/obtenerobjetivosproyecto','proyectos\ActividadController@obtenerObjetivosProyectos');
Route::post('/actividades/obtenerindicadorproyecto','proyectos\ActividadController@obtenerIndicadoresproyectos');
Route::post('/actividades/guardarFechas','proyectos\ActividadController@guardarFechas');
Route::post('/actividades/datatablesfechasactividades','proyectos\ActividadController@datatablesFechasActividades');
Route::get('/actividades/detalleactividades/{id}','proyectos\ActividadController@detalleactividades');
Route::get('/actividades/modalDetalleActividad','proyectos\ActividadController@modalDetalleActividad');
Route::post('/actividades/guardarRecursos','proyectos\ActividadController@guardarRecursosActividad');
Route::post('/actividades/datatablesrecursosactividades','proyectos\ActividadController@datatablesrecursosactividades');

Route::post('/ProgresoActividad/obtenerActividadesDeProyecto','proyectos\ActividadController@obtenerActividadesDeProyecto');
Route::post('/ProgresoActividad/obtenerDetalleActividadesEnModal','proyectos\ActividadController@obtenerDetalleActividadesEnModal');
Route::post('/ProgresoActividad/obtenerAvanceActividadmodal','proyectos\ActividadController@obtenerAvanceActividadmodal');
Route::post('/ProgresoActividad/obtenerRecursosActividadesEnModal','proyectos\ActividadController@obtenerRecursosActividadesEnModal');

//rutas para eliminar archivos
Route::post('/Proyectos/eliminar/{id}','proyectos\ProyectoController@eliminarProyecto');
Route::post('/objetivos/eliminarAmbitoObjetivos','objetivos\ObjetivosController@eliminarAmbitoObjetivo');
Route::post('/objetivos/eliminarAlcanceObjetivos','objetivos\ObjetivosController@eliminarAlcanceObjetivo');

Route::post('/actividades/eliminarFechaActividad','proyectos\ActividadController@eliminarfechasActividad');
Route::post('/proyectos/eliminarProgramacionActividad','proyectos\ProyectoController@eliminarProyectoObjetivo');
Route::post('/actividades/eliminarResponsableActividad','proyectos\ActividadController@eliminarResponsableActividad');

Route::post('/catalogo/eliminarCatalogoObjetivos','objetivos\CatalogoObjetivosController@eliminarCatalogoObjetivos');
Route::post('/indicadores/eliminarActividad','indicadores\IndicadorController@eliminarActividadIndicador');

Route::post('/objetivos/eliminarObjetivos/{id}','objetivos\ObjetivosController@eliminarObjetivo');

//rutas para ver detalles
Route::post('/catalogo/detalles', 'objetivos\DetalleCatalogoObjetivosController@obtenerDetalleObjetivoCatalogo');

Route::get('charts/grafico', 'graficas\TestController@grafica_columnas');


Route::get('enviarcorreo/principal', 'enviarcorreo\MailController@send');
Route::get('grafico', 'graficas\TestController@grafica_columnas');
Route::get('grafico2', 'graficas\TestController@grafica_pastel');

Route::get('enviarcorreo', 'enviarcorreo\MailController@enviarCorreo');


Route::get('enviar', function(){
    
    Mail::to('unidadeducativaprivadcristorey@gmail.com','Libreria mailtrap')
        ->send(new emailsupervisorcorreo());    
    });
//funcion para la libreria mailtrap
    Route::get('enviarm', function(){
        
        Mail::send('email.Mail', array('key' => 'value'), function($message) { $message->to('unidadeducativaprivadcristorey@gmail.com', 'Sender Name')->subject('Welcome!'); });
            return "mensaje enviado";
        });

        //rutas configurar reportes

        Route::get('configurar/reportes', 'configuracion_reportes\Configurar_ReportesController@home');
        Route::get('editar/reportes/{id?}', 'configuracion_reportes\Configurar_ReportesController@crear');
        Route::post('actualizar/reportes', 'configuracion_reportes\Configurar_ReportesController@actualizar');
        

        


       
    
  





  
    