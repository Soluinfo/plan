<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleado';
    protected $fillable = ['SERIAL_EPL',
                            'SERIAL_TUR',
                            'SERIAL_IFI',
                            'SERIAL_ESC',
                            'SERIAL_DESC',
                            'SERIAL_TCT'.
                            'SERIAL_TER',
                            'FECHA_EPL',
                            'CODIGO_EPL',
                            'NOMBRE_EPL',
                            'APELLIDO_EPL',
                            'TIPOEMPLEADO_EPL',
                            'FECHANACIMIENTO_EPL',
                            'CIUDAD_EPL',
                            'PARROQUIA_EPL',
                            'DOCUMENTOIDENTIDAD_EPL',
                            'TIPODOCUMENTO_EPL',
                            'SEXO_EPL',
                            'DOCUMENTOMILITAR_EPL',
                            'ESTADOCIVIL_EPL'
                        ];
}
