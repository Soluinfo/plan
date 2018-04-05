<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;

class LoginRequest extends Request
{
    public function authorize()
    {
        return true;
    }
}