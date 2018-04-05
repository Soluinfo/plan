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
Route::get('/autenticacion/login','Autenticacion\IniciosesionController@iniciarsesion');
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
Route::post('/proyectos/asignarIndicadorProyectos','proyectos\ProyectoController@asignarIndicadorProyecto');
Route::post('/proyectos/eliminarIndicadorProyecto','proyectos\ProyectoController@eliminarIndicadorProyecto');
Route::post('/proyectos/obtenerFechasActivasDeProyecto','proyectos\ProyectoController@obtenerFechasActivasDeProyecto');
Route::post('/proyectos/guardarFechas','proyectos\ProyectoController@guardarFechas');
Route::post('/objetivos/detalles', 'proyectos\DetalleProyectoController@obtenerDetalleObjetivo');
Route::post('/supervisor/detalles','proyectos\DetalleProyectoController@obtenerDetalleSupervisor');

Route::post('/proyectos/asignarObjetivoProyecto','proyectos\ProyectoController@asignarObjetivoProyecto');
Route::post('/proyectos/eliminarProyectoObjetivos','proyectos\ProyectoController@eliminarProyectoObjetivo');
Route::post('/proyectos/eliminarProyectoSupervisor','proyectos\ProyectoController@eliminarProyectoSupervisor');
Route::post('/proyectos/obtenerProgresoInformacion','proyectos\ProyectoController@obtenerProgresoInformacion');
//validaciones
Route::post('/proyectos/validacion/proyectoExiste','proyectos\ProyectoController@validarExisteProyecto');

//datatables
Route::post('/proyectos/objetivos','proyectos\ProyectoController@datatableObjetivo');
Route::post('/proyectos/indicador','proyectos\ProyectoController@datatableIndicador');
Route::post('/proyectos/datatableObjetivosProyecto','proyectos\ProyectoController@datatableObjetivosProyecto');
Route::post('/proyectos/obtenerSupervisoresProyectos','proyectos\ProyectoController@obtenerSupervisoresDeProyecto');
Route::post('/proyectos/obtenerIndicadorProyectos','proyectos\ProyectoController@datatableIndicadorProyectos');
Route::post('/proyectos/datatableFechasProyecto','proyectos\ProyectoController@datatableFechasProyecto');

//Diego Intriago
Route::post('/ambito/detalles', 'objetivos\DetalleObjetivoController@obtenerDetalleAmbito');


Route::get('/objetivos', 'objetivos\ObjetivosController@home');

Route::get('/objetivos/detalleObjetivo/{id}','objetivos\DetalleObjetivoController@home');

Route::post('/objetivos/datatableAmbitosObjetivo','objetivos\ObjetivosController@datatablesAmbito');
Route::post('/objetivos/datatableAlcanceObjetivo','objetivos\ObjetivosController@datatablesAlcance');

Route::get('/crearobjetivos/{id?}', 'objetivos\ObjetivosController@crear');
Route::post('/objetivos/guardar', 'objetivos\ObjetivosController@guardar');
Route::get('/objetivos/eliminar{id}', 'objetivos\ObjetivosController@destroy');

Route::post('/ambito/guardara', 'objetivos\ObjetivosController@guardarambito');
Route::post('/alcance/guardaralcance', 'objetivos\ObjetivosController@guardaralcance');


// rutas de catalogo
Route::get('/catalogo', 'objetivos\CatalogoController@home');
//Route::get('/crearobjetivo/crear/{id?}', 'objetivos\CatalogoController@crear')->where('id', '[0-9]+');
Route::get('/crearcatalogo/{id?}', 'objetivos\CatalogoController@crear');
Route::post('/crearcatalogo/guardar', 'objetivos\CatalogoController@guardar');

Route::get('/catalogo/detalleCatalogo/{id}','objetivos\DetalleCatalogoController@home');

//rutas de indicadores
Route::get('/indicadores', 'indicadores\IndicadorController@home');
Route::get('/crearindicadores/{id?}', 'indicadores\IndicadorController@crear');
Route::post('/crearindicadores/guardar', 'indicadores\IndicadorController@guardar');
Route::get('/indicadores/detalleIndicador/{id}','indicadores\DetalleIndicadorController@home');

Route::post('/indicadores/datatableActividadesIndicadores','indicadores\IndicadorController@datatableActividadesIndicadores');

Route::get('/catalogoindicadores', 'indicadores\CatalogoIndicadorController@home');
Route::get('/catalogo/crear{id?}', 'indicadores\CatalogoIndicadorController@crear');
Route::post('/crearcatalogoindicador/guardar', 'indicadores\CatalogoIndicadorController@guardar');

Route::get('/actividades', 'proyectos\ActividadController@inicio');
Route::get('/actividades/crear/{id?}', 'proyectos\ActividadController@crear');
Route::post('/crearactividades/guardar', 'proyectos\ActividadController@guardar');

Route::post('/actividades/obtenerResponsableActividades','proyectos\ActividadController@obtenerResponsablesDeActividad');

Route::post('/actividades/datatableActividad','proyectos\ActividadController@datatableActividad');
Route::post('/actividades/asignarResponsableActividad','proyectos\ActividadController@asignarResponsable');
Route::post('/actividades/ObtenerResponsablesDeActividad','proyectos\ActividadController@obtenerResponsablesDeActividad');
Route::post('/actividades/eliminarResponsableActividad','proyectos\ActividadController@eliminarResponsableActividad');
Route::post('/actividades/eliminarFechaActividad','proyectos\ActividadController@eliminarfechasActividad');
Route::post('/actividades/obtenerFechaActividad','proyectos\ActividadController@obtenerFechaActividad');
Route::post('/ambito/guardara', 'objetivos\ObjetivosController@guardarambito');
Route::post('/alcance/guardaralcance', 'objetivos\ObjetivosController@guardaralcance');


// rutas de catalogo
Route::get('/catalogo', 'objetivos\CatalogoController@home');
//Route::get('/crearobjetivo/crear/{id?}', 'objetivos\CatalogoController@crear')->where('id', '[0-9]+');
Route::get('/crearcatalogo/{id?}', 'objetivos\CatalogoController@crear');
Route::post('/crearcatalogo/guardar', 'objetivos\CatalogoController@guardar');

Route::get('/catalogo/detalleCatalogo/{id}','objetivos\DetalleCatalogoController@home');

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
Route::post('/ProgresoActividad/subirDocumentoRecurso','proyectos\ProgresoActividadController@subirDocumentoRecurso');

Route::get('/ProgresoActividad/descargarDocumentoRecurso/{id}','proyectos\ProgresoActividadController@descargarDocumentoRecurso');
Route::post('/ProgresoActividad/aprobarRecursoActividad','proyectos\ProgresoActividadController@aprobarRecursoActividad');
Route::post('/ProgresoActividad/desaprobarRecursoActividad','proyectos\ProgresoActividadController@desaprobarRecursoActividad');
Route::post('/ProgresoActividad/enviarSolicitudReprogramarFecha','proyectos\ProgresoActividadController@enviarSolicitudReprogramarFecha');

Route::get('test', function() {
    Storage::disk('google')->put('test.txt', 'Hello World');
});
Route::get('obtenerpath', function() {
   
    $iddirectorio = '';
    $filename = "cedula2.pdf";
    $dir = '/1m7usmOVAJlrWdmkhfh-NZ-TpmpOyr5pI/16Zi4oB-p8IlzVSupro9ooRujwiTCcUXZ/1GvRPaT1V1pHtbLfGwhDq2vKaaGGtF1Tu';
    $recursive = false; // Get subdirectories also?
    $contents = collect(Storage::cloud()->listContents($dir, $recursive));
    
    $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
    //return $file; // array with file info
    dd($file);
    /*$rawData = Storage::cloud()->get($file['path']);
    return response($rawData, 200)
    ->header('ContentType', $file['mimetype'])
    ->header('Content-Disposition', "attachment; filename='$filename'");
    //return $file['path'];*/
});
Route::get('list', function() {
    $dir = '/';
    $recursive = false; // Get subdirectories also?
    $contents = collect(Storage::cloud()->listContents($dir, $recursive));
    //return $contents->where('type', '=', 'dir'); // directories
    return $contents->where('type', '=', 'file'); // files
});

Route::get('get', function() {
    $filename = 'cedula2.pdf';
    $dir = '/';
    $recursive = false; // Get subdirectories also?
    $contents = collect(Storage::cloud()->listContents($dir, $recursive));
    $file = $contents
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        ->first(); // there can be duplicate file names!
    //return $file; // array with file info
    $rawData = Storage::cloud()->get($file['path']);
    return response($rawData, 200)
        ->header('ContentType', $file['mimetype'])
        ->header('Content-Disposition', "attachment; filename='$filename'");
});
Route::get('test', function() {
    Storage::disk('google')->put('test.txt', 'Hello World');
});