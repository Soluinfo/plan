<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    protected $table = 'indicadores';
    protected $fillable = ['IDINDICADORES',
                            'LITERAL', 
                            'DESCRIPCIONINDICADOR', 
                            'IDCATALOGOINDICADORES',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
