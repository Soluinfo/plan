<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambitoinfluencia extends Model
{
    protected $table = 'ambitosinfluencias';
    protected $fillable = ['IDAMBITOINFLUENCIA',
                            'IDOBJETIVOESTRATEGICO',
                            'NOMBREAMBITO',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
