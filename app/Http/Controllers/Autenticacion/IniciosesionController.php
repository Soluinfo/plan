<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class IniciosesionController extends Controller
{
    public function iniciarsesion(Request $r){
        if($r->ajax()){
            $respuesta = array('respuesta' => 'no');
            $usuario = $r->usuario;
            $clave = md5($r->clave);
            $respuesta['respuesta'] = 'ok';
            echo json_encode($respuesta);
        }
    }
}
