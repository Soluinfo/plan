<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Proyecto;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\PrincipalController;
use Illuminate\Support\Facades\Input;
use Session;
use Redirect;
use Auth;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;
use Charts;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function login(Request $request){
        $this->validate(request(), [
            
            'txtusuario' => 'required|string',
            
            ]);
        
            $credenciales = array(
                $this->username() => $request->txtusuario,
                'password' => md5($request->txtpassword),
                'ESTADO_USR' => 'ACTIVO'
            );

            
            
            if(Auth::attempt($credenciales))
            {
                return 'logueado';
                //return 'Redirect()->route('inicio');'
            }else{
                //Session::flash('message-error', 'Datos incorrectos');
                //return Redirect::to('/');
                return 'no autenticado';
            }
                        
            
        }
        public function username()
        {
            return 'CODIGO_USR';
        }
               
                    
}
