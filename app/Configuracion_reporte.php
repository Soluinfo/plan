<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion_reporte extends Model
{
    protected $table = 'configuracion_reportes';
    protected $fillable = ['idconfiguracionreporte','encabezado1','idtipodocumento','created_at','updated_at'];
}
