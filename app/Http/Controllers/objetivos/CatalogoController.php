<?php

namespace App\Http\Controllers\objetivos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatalogoController extends Controller
{
    public function home(){
        return view('objetivos.objetivos');
    }

    public function crear(){
        return view('objetivos.crearcatalogo');
    }
}
