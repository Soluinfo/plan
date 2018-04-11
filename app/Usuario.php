<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['SERIAL_USR','SERIAL_PFL','CODIGO_USR','CLAVE_USR',
    'NOMBRE_USR','APELLIDO_USR','NOMBRE2_USR','APELLIDO2_USR','TELEFONO_USR',
    'EXTENSION_USR','CELULAR_USR','EMAIL_USR','FECHA_USR','FOTO_USR','ESTADO_USR','CAMBIO_USR','IPACCESO_USR'];
}
