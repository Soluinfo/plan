<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiporeporte extends Model
{
    protected $table = 'tiposreportes';
    protected $fillable = ['idtiporeporte','nombretipo','created_at','updated_at'];
}
