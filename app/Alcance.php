<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alcance extends Model
{
    protected $table = 'Alcances';
    protected $fillable = ['IDALCANCE',
                            'IDOBJETIVOESTRATEGICO',
                            'DESCRIPCIONALCANCE',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
