<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividadresponsable extends Model
{
    protected $table = 'actividadesresponsables';
    protected $fillable = ['IDACTIVIDADRESPONSABLE',
                            'IDACTIVIDAD',
                            'IDRESPONSABLE',
                            'ESTADOACTIVIDADRESPONSABLE',
                            'FECHAACTIVIDADRESPONSABLE',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
