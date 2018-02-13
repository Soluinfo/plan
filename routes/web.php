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

Route::get('/', 'Auth\LoginController@home');
Route::get('/principal', 'PrincipalController@home');
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
Route::get('/objetivos/eliminar{id}', 'objetivos\ObjetivosController@destroy');

Route::post('/ambito/editar', 'objetivos\DetalleObjetivoController@editarDetalleAmbito');

Route::post('/ambito/guardara', 'objetivos\ObjetivosController@guardarambito');
Route::post('/alcance/guardaralcance', 'objetivos\ObjetivosController@guardaralcance');


// rutas de catalogo
Route::get('/catalogo', 'objetivos\CatalogoController@home');
//Route::get('/crearobjetivo/crear/{id?}', 'objetivos\CatalogoController@crear')->where('id', '[0-9]+');
Route::get('/crearcatalogo/{id?}', 'objetivos\CatalogoController@crear');
Route::post('/crearcatalogo/guardar', 'objetivos\CatalogoController@guardar');

Route::get('/catalogo/detalleCatalogo/{id}','objetivos\DetalleCatalogoController@home');
Route::post('/catalogo/datatableCataloObjetivos','objetivos\CatalogoController@datatablesCataObjetivos');

//rutas de indicadores
Route::get('/indicadores', 'indicadores\IndicadorController@home');
Route::get('/crearindicadores/{id?}', 'indicadores\IndicadorController@crear');
Route::post('/crearindicadores/guardar', 'indicadores\IndicadorController@guardar');
Route::get('/indicadores/detalleIndicador/{id}','indicadores\DetalleIndicadorController@home');
Route::post('/indicadores/datatableIndicadorActividad','proyectos\ActividadController@datatablesIndicador');

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
<<<<<<< HEAD
Route::get('/actividades/detalleActividad/{id}','proyectos\DetalleActividadController@home');


=======
Route::post('/actividades/eliminarResponsableActividad','proyectos\ActividadController@eliminarResponsableActividad');
Route::post('/actividades/eliminarFechaActividad','proyectos\ActividadController@eliminarfechasActividad');
>>>>>>> origin/test

Route::post('/ambito/guardara', 'objetivos\ObjetivosController@guardarambito');
Route::post('/alcance/guardaralcance', 'objetivos\ObjetivosController@guardaralcance');


// rutas de catalogo
Route::get('/catalogo', 'objetivos\CatalogoController@home');
//Route::get('/crearobjetivo/crear/{id?}', 'objetivos\CatalogoController@crear')->where('id', '[0-9]+');
Route::get('/crearcatalogo/{id?}', 'objetivos\CatalogoController@crear');
Route::post('/crearcatalogo/guardar', 'objetivos\CatalogoController@guardar');

Route::get('/catalogo/detalleCatalogo/{id}','objetivos\DetalleCatalogoController@home');

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
