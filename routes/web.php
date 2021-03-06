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
Route::get('/indicadores', 'indicadores\IndicadorController@home');
Route::get('/proyectos', 'proyectos\ProyectoController@home');
//ruta para detalle de proyecto
Route::get('/proyectos/detalleProyecto/{id}','proyectos\DetalleProyectoController@home');
//sirve para guardar y editar proyectos
Route::get('/proyectos/crear/{id?}','proyectos\ProyectoController@crear')->where('id', '[0-9]+');
Route::get('/actividades', 'proyectos\ActividadController@home');
Route::post('/proyectos/guardar', 'proyectos\ProyectoController@guardar');
Route::post('/proyectos/asignarSupervisorProyecto','proyectos\ProyectoController@asignarSupervisor');
Route::post('/proyectos/obtenerSupervisorProyecto','proyectos\ProyectoController@obtenerSupervisores');

Route::post('/objetivos/detalles', 'proyectos\DetalleProyectoController@obtenerDetalleObjetivo');
Route::post('/supervisor/detalles','proyectos\DetalleProyectoController@obtenerDetalleSupervisor');

Route::post('/proyectos/asignarObjetivoProyecto','proyectos\ProyectoController@asignarObjetivoProyecto');

//datatables
Route::post('/proyectos/objetivos','proyectos\ProyectoController@datatableObjetivo');
Route::post('/proyectos/datatableObjetivosProyecto','proyectos\ProyectoController@datatableObjetivosProyecto');
Route::post('/proyectos/obtenerSupervisoresProyectos','proyectos\ProyectoController@obtenerSupervisoresDeProyecto');