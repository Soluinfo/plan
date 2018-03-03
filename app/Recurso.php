<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'recursos';
    protected $fillable = ['IDRECURSO','NOMBRERECURSO','IDDIRECTORIORECURSO','ESTADO','IDACTIVIDAD','PORCENTAJERECURSO'];
}
