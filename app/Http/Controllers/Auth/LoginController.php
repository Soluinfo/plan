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
    
    public function principal(LoginRequest $request){
        $this->validate(request(), [
            
                    'email' => 'email|required|string',
                    'password' => 'required|string'
                    ]);
                    
                      
                    /*if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
                    {
                        return Redirect()->route('inicio');
                    }else{
                        Session::flash('message-error', 'Datos incorrectos');
                        return Redirect::to('inicio');
                    }*/
                    $userdata = array(
                        'email' =>$request->get('email'),
                        'password'=>$request->get('password')
                        //'email' => $request->email, 
                        //'password' => $request->password,
                    );
                    if(Auth::attempt($userdata))
                    {
                        return Redirect()->route('inicio');
                    }else{
                       
                        return Redirect::to('inicio');
                    }
                }
                    
                    
                 
                  //Session::flash('message-error', 'Datos incorrectos');
                  //return Redirect::to('/');              
    
    
    
    //public function inicio(){
      //  return view ('welcome');
    //}

    public function login(){
        return view('auth.login');
    }
}
