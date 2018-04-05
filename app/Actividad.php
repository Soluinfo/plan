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
                            'FECHAINICIALACTIVIDAD',
                            'IDDIRECTORIOACTIVIDAD',
                            'PORCENTAJEACTIVIDAD',
                            'ESTADO',
                            'progreso',
                            'created_at',
                            'updated_at',
                            'idusuario',
                            'FECHAINICIALACTIVIDAD',
                            'FECHAFINALACTIVIDAD',
                        ];
}
