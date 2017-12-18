<?php

namespace App\Http\Controllers\indicadores;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndicadorController extends Controller
{
    public function home(){
        return view('indicadores.indicadores');
    }
}
