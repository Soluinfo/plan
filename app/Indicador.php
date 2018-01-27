<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';
    protected $fillable = ['IDINDICADORES',
                            'LITERAL', 
                            'DESCRIPCION', 
                            'IDCATALOGOINDICADORES',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
