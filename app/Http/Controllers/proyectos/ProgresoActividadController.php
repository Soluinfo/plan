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
//use App\Helpers\ProyectoHelper;
//use App\Helpers\ObjetivoHelper;
//use App\Helpers\ActividadHelper;
use App\Helpers\RecursoHelper;
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
            $data = array();
            $idrecurso = $r->idrecurso;
            
            $objetorecurso = RecursoHelper::obtener($idrecurso);
            $arrayRecurso = RecursoHelper::obtenerarrayRecurso($objetorecurso);
            
            $ruta = $arrayRecurso['IDDIRECTORIORECURSO'].'/';
            
            $files = $r->file($r->nombreInput);
            
            $fileName = $files->getClientOriginalName();
            
            //$extension = $r->fileprueba->extension();
            $uploaded = Storage::cloud()->put($ruta.$fileName,file_get_contents($files->getRealPath()));
            if($uploaded){
                
                Recurso::where('IDRECURSO','=',$idrecurso)
                        ->update(['ESTADO' => '2']);
            }else{
                $data['error'] = 'Error: al subir el documento, por favor intente de nuevo';
            }
            
            echo json_encode($data);
        }
    }
}