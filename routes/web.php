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
Route::get('/proyectos/crear/{id?}','proyectos\ProyectoController@crear')->where('id', '[0-9]+');
Route::get('/actividades', 'proyectos\ActividadController@home');
Route::post('/proyectos/guardar', 'proyectos\ProyectoController@guardar');
Route::post('/proyectos/asignarSupervisorProyecto','proyectos\ProyectoController@asignarSupervisor');
Route::post('/proyectos/obtenerSupervisorProyecto','proyectos\ProyectoController@obtenerSupervisores');
Route::post('/proyectos/obtenerSupervisoresProyectos','proyectos\ProyectoController@obtenerSupervisoresDeProyecto');
Route::post('/proyectos/obtenerObjetivos','proyectos\ProyectoController@obtenerObjetivos');