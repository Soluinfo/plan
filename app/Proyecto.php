<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Objetivo;

class Proyecto extends Model
{
    
    protected $fillable = ['IDPROYECTO','NOMBREPROYECTO','FECHAPROYECTO','ESTADOPROYECTO','IDDEPARTAMENTO','FECHAFINAL'];

    public function mostrar_objetivos(){
        return $this->belongsTo('Objetivo::class');
}

}
