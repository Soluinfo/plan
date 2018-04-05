<?php

    namespace App\Http\Controllers;

    use App\Helpers\ProyectoHelper;
    use App\Proyecto;
    use App\Proyectosupervisor;
    use Auth;
    use Illuminate\Support\Facades\Request;
    use Charts;
    use App\User;

    class PrincipalController extends Controller
    {
        public $restful = true;
        
        //al hacer uso de get le decimos a laravel que queremos crear una ruta, 
        //cargar una vista etc
        public function get_index()
        {
        
        //si se ha iniciado sesión no dejamos volver
        if(Auth::user())
        {
        return Redirect::to('home');
        }
        //mostramos la vista views/login/index.blade.php pasando un título
        return View::make('login.index')->with('title','Login');
        
        }
  
        public function home(){
            $columnas = Charts::database(Proyecto::all(), 'bar', 'highcharts')
            ->elementLabel("Cantidad de Proyectos")
            ->dimensions(800, 400)
            ->responsive(false)
            ->groupBy('IDDEPARTAMENTO')        
            ->Labels(['Bienestar Estudiantil', 'Direccion Pastoral', 'Direccion Academica', 'Administrativa Financiera', 'Desarrollo Institucional']);

            $usuarios = Charts::database(Proyectosupervisor::all(), 'bar', 'highcharts')
            ->elementLabel("Numero de Proyecto Asignados")
            ->dimensions(500, 400)
            ->responsive(false)
            ->groupBy('IDSUPERVISOR')        
            ->Labels(['JUAN PARRAGA ','RAMON PARRAGA ']);
    
            $proyectos = ProyectoHelper::obtenerProyectos(null);
            $total = $proyectos->count();
            $pastel = Charts::database(Proyecto::all(), 'pie', 'highcharts')
            ->elementLabel("Cantidad de Proyectos")
            ->dimensions(450, 400)
            ->responsive(false)
            ->groupBy('ESTADOPROYECTO')
            ->Labels(['Abierto', 'En Progreso']);
          
    
            return view ('home',['proyectos' => $proyectos, 'pastel' => $pastel, 'columnas' => $columnas, 'total' => $total, 'usuarios' => $usuarios]);
        }
        
        public function postlogin()
        {
           $credentials =  $this->validate(request(), [

                'usuario' => 'usuario|required|string',
                'password' => 'required|string'
                ]);
                if(Auth::attempt($credentials))
                {
                    return Redirect::to('home');
                }
               
        }
}