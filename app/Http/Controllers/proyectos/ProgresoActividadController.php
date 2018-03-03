<?php

namespace App\Http\Controllers\proyectos;
use Validator;
use SplFileInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Actividad;
use App\Actividadresponsable;
use App\Empleado;
use App\Helpers\ProyectoHelper;
use App\Helpers\ObjetivoHelper;
use App\Helpers\ActividadHelper;
use App\Catalogoindicador;
use App\Objetivo;
use App\Indicador;
use App\Actividadfechafinal;
use App\Recurso;
use App\Providers\GoogleDriveServiceProvider;
use App\Recursofechafinal;

class ProgresoActividadController extends Controller
{
    public function subirDocumentoRecurso(Request $r){
        if($r->ajax()){
            $data = array('existe' => false);
            $files = $r->file('fileprueba');
            $fileName = $files->getClientOriginalName();
            
            $ruta = '1m7usmOVAJlrWdmkhfh-NZ-TpmpOyr5pI/16Zi4oB-p8IlzVSupro9ooRujwiTCcUXZ/1GvRPaT1V1pHtbLfGwhDq2vKaaGGtF1Tu/';
           // $data['nombre'] = $r->fileprueba->filename();
          
            $extension = $r->fileprueba->extension();
            Storage::cloud()->put($ruta.$fileName,file_get_contents($files->getRealPath()));
            if ($r->hasFile('fileprueba')) {
                $data['existe'] = true;
            }else{
                $data['existe'] = false;
            }
            echo json_encode($data);      
            /*//dd($files);
            //$path = Storage::cloud()->putFile($files->fileName,$r->file('file-prueba'));*/
            
        }
    }
}