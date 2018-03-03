<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';
    protected $fillable = ['IDACTIVIDAD',
                            'IDOBJETIVOESTRATEGICO',
                            'IDINDICADORES',
                            'IDPROYECTO',
                            'NOMBREACTIVIDAD',
                            'FECHACREACIONACTIVIDAD',
                            'IDDIRECTORIOACTIVIDAD',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
