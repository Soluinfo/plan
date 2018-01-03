<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectosobjetivos extends Model
{
    protected $table = 'proyectosobjetivos';
    protected $fillable = ['IDPROYECTOOBJETIVO',
                            'IDPROYECTO',
                            'IDOBJETIVOESTRATEGICO',
                            'updated_at',
                            'created_at',
                            'idusuario'
                        ];
}
