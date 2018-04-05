<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportesGeneral extends Model
{
    protected $fillable = [
        'IDPROYECTO',
        'NOMBREPROYECTO',
        'FECHAPROYECTO',
        'ESTADOPROYECTO',
        'IDDEPARTAMENTO',
        'FECHAFINAL'
        
    ];
  
   public function mostrar_objetivos(){
       $this->belongsTo('Objetivo::class');
   }
}
    