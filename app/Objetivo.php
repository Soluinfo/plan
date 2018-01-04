<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivo extends Model
{
    protected $table = 'objetivosestrategicos';
    protected $fillable = ['IDOBJETIVOESTRATEGICO',
                            'LITERAL',
                            'DESCRIPCION',
                            'IDCATALOGOOBJETIVO',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
