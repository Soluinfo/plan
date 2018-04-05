<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Objetivo;

class Proyecto extends Model
{
    protected $table = 'proyectos';
    protected $fillable = ['IDPROYECTO','NOMBREPROYECTO','FECHAPROYECTO','ESTADOPROYECTO','IDDEPARTAMENTO','FECHAFINAL','IDDIRECTORIO','progreso','idusuario','PROGRESODECREACION'];
    

    public function mostrar_objetivos(){
        return $this->belongsTo('Objetivo::class');
    }

}
