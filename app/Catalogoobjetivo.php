<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogoobjetivo extends Model
{
    protected $table = 'catalogoobjetivos';
    protected $fillable = ['IDCATALOGOOBJETIVO',
                            'NOMBRE',
                            'FECHA',
                            'ESTADO',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
