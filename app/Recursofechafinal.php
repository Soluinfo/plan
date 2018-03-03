<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recursofechafinal extends Model
{
    protected $table = 'recursofechasfinales';
    protected $fillable = ['IDRECURSOFECHASFINALES','FECHAINICIALRECURSO','FECHAFINALRECURSO',
                            'ESTADOFECHASFINALES','IDRECURSO','created_at','updated_at','idusuario'];
}
