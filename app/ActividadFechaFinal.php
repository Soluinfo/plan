<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadFechaFinal extends Model
{
    protected $table = 'actividadesfechasfinales';
    protected $fillable = ['IDACTIVIDADFECHAFINAL',
                            'IDACTIVIDAD',
                            'FECHAINICIALACTIVIDAD',
                            'FECHAFINALACTIVIDAD',
                            'ESTADOACTIVIDADFECHA',
                            'created_at',
                            'updated_at',
                            'idusuario'
                        ];
}
