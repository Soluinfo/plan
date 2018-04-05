<?php

namespace App\Http\Controllers\enviarcorreo;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\emailsupervisor;
use Mail;
use Mailgun;


class MailController extends Controller
{
   
   
    public function sends(){
        return view('principal');
    }
    
    public function send(){
        
        Mail::send(['text'=>'email.mail'],['name', 'Diego'],function($message){
            $message->to('unidadeducativaprivadcristorey@gmail.com','To Diego')->subject('test email');
            
            
        });
          
    }
    public function enviar()
    {
        Mail::send('email.mail', array('key' => 'value'), function($message)
        {
            $message->to('unidadeducativaprivadcristorey@gmail.com', 'John Smith')->subject('envio de correos con la libreria mailgun!');
        });
       
    }
    public function enviarCorreo(Request $request)
    {
    $asunto = $request->asunto;
    $contenido = $request->contenido;
    $adjunto = $request->file('adjunto');
    /**
     * El primer parametro es nuestra vista
     * El segundo parametro son los valores a inyectar en la vista
     * El tercer parametro es la instancia que define los métodos necesarios para el envío del correo
     * use() nos permite introducir valores dentro del closure para ser utilizadas por la instancia
     */
    Mail::send('email.mail', array('key' => 'value'), function($message){
        $message->from('dintriago07@gmail.com', 'Bot de correos');
        $message->to('unidadeducativaprivadcristorey@gmail.com');
       
    });
   
}
public function enviarCorreos(Request $request)
{
  Mailgun::send('email.mail', $data, function ($message) {
    $message
        ->subject('Your Invoice')
        ->to('john.doe@example.com', 'John Doe')
        ->bcc('sales@company.com')
        ->attach(storage_path('invoices/12345.pdf'))
        ->trackClicks(true)
        ->trackOpens(true)
        ->tag(['tag1', 'tag2'])
        ->campaign(2);
});
}  
}
