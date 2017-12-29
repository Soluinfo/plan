<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objetivoestrategico extends Model
{
    protected $table = 'objetivosestrategicos';
    protected $fillable = ['IDOBJETIVOESTRATEGICO',
                            'LITERAL',
                            'DESCRIPCION',
                            'ALCANCE',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
