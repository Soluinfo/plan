<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'usuarios';
    protected $fillable = ['id','name','email','password','remember_token','created_at','updated_at'];
}
