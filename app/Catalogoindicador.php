<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogoindicador extends Model
{
    protected $table = 'catalogoindicadores';
    protected $fillable = ['IDCATALOGOINDICADORES',
                            'NOMBRE',
                            'FECHA',
                            'ESTADO',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
