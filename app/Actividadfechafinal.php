<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividadfechafinal extends Model
{
    protected $table = 'actividadesfechasfinales';
    protected $fillable = ['IDACTIVIDADFECHAFINAL','IDACTIVIDAD','FECHAINICIALACTIVIDAD','FECHAFINALACTIVIDAD','ESTADOACTIVIDADFECHA'];
}
