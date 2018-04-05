<?php

namespace App\Http\Controllers\enviarcorreo;

use Mail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CorreoSupervisorController extends Controller
{
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function enviarCorreo(Request $request, $id)
    {
        $supervisor = Proyectosupervisor::findOrFail($id);

        Mail::send('emails.reminder', ['supervisor' => $supervisor], function ($m) use ($supervisor) {
            $m->from('hello@app.com', 'Your Application');
            $m->to($empleado->EMAIL_EPL)->subject('Your Reminder!');
        });
    }
}