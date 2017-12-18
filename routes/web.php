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

Route::get('/', 'PrincipalController@home');
Route::get('/objetivos', 'objetivos\CatalogoController@home');
Route::get('/crearobjetivo', 'objetivos\CatalogoController@crear');
Route::get('/indicadores', 'indicadores\IndicadorController@home');
