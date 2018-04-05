<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['IDRECURSO','NOMBRERECURSO','IDDIRECTORIORECURSO','ESTADO','IDACTIVIDAD','PORCENTAJERECURSO','NOMBREARCHIVO','PESODEARCHIVO','IDDIRECTORIOARCHIVO','idusuario','created_at','updated_at'];
}
