<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectosupervisor extends Model
{
    protected $table = 'proyectosupervisor';
    protected $fillable = ['IDPROYECTOSUPERVISOR','IDPROYECTO','IDSUPERVISOR','ESTADO','FECHAPROYECTOSUPERVISOR'];
}
