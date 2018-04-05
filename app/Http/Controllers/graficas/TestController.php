<?php

namespace App\Http\Controllers\graficas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;
use App\Proyecto;
use Charts;

class TestController extends Controller
{
    public function grafica_columnas(){
        $chart = Charts::database(Proyecto::all(), 'bar', 'highcharts')
        ->elementLabel("Cantidad de Proyectos")
        ->dimensions(1000, 500)
        ->responsive(false)
        ->groupBy('IDDEPARTAMENTO')        
        ->Labels(['Bienestar Estudiantil', 'Direccion Pastoral', 'Direccion Academica', 'Administrativa Financiera', 'Desarrollo Institucional']);
        return view('grafico', ['chart' => $chart]);
            }

public function grafica_pastel(){
    $pastel = Charts::database(Proyecto::all(), 'pie', 'highcharts')
    ->elementLabel("Cantidad de Proyectos")
    ->dimensions(1000, 500)
    ->responsive(false)
    ->groupBy('ESTADOPROYECTO')
    ->Labels(['Abierto', 'En Progreso']);
    
    return view('graficopastel', ['pastel' => $pastel]);
}
  
}
