<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fechaproyecto extends Model
{
    protected $table = 'proyectofechasfinales';
    protected $fillable = ['IDPROYECTOFECHAFINAL',
                            'IDPROYECTO', 
                            'FECHAINICIAL', 
                            'FECHAFINAL',
                            'ESTADOFECHAP',
                            'OBSEVACIONP',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
