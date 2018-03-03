<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyectoindicador extends Model
{
    protected $table = 'proyectosindicadores';
    protected $fillable = ['idproyectoindicador',
                            'IDPROYECTO',
                            'IDINDICADOR',
                            'updated_at',
                            'created_at',
                            'idusuario'
                        ];
}
