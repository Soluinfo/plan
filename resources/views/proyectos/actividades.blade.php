@extends('master')
@section('title','Actividades')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                <li><a href="{{ url('/')}}">Principal</a></li>                    
                <li class="active">Panel de Actividades</li>
            </ul>
            <!-- END BREADCRUMB -->                      
                 <!-- PAGE TITLE -->
                 <div class="page-title">                    
                 <h2><span class="fa fa-arrow-circle-o-left"></span> Panel de Actividades</h2>
             </div>
             <!-- END PAGE TITLE --> 
             <!-- PAGE CONTENT WRAPPER -->
             <div class="page-content-wrap">
                 <div class="row">
                     <div class="col-lg-4">
                         <a class="btn btn-block btn-primary" href="{{ url('/crearactividad') }}"><span class="fa fa-plus"></span> Nueva Actividad</a>
                     </div>
                     <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Lista de Actividades</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                @if(session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div> 
                                @endif 
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre de Actividad</th>
                                                <th>Avance</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($actividades as $p)
                                            <tr>
                                                <td>{{ $p->IDACTIVIDAD }}</td>
                                                <td>{{ $p->NOMBREACTIVIDAD }}</td>
                                                <td>
                                                    <div class="progress progress-small progress-striped active">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$p->progreso}}%;">{{$p->progreso}}%</div>
                                                    </div></td>
                                                <td>
                                                    @if($p->ESTADO == 1)
                                                    <span class="label label-info label-form">ABIERTO</span>
                                                    @elseif($p->ESTADO == 2)
                                                    <span class="label label-success label-form">EN PROGRESO</span>
                                                    @elseif($p->ESTADO == 3)
                                                    <span class="label label-danger label-form">EN RETRASO</span>
                                                    @else
                                                    <span class="label label-success label-form">COMPLETADO</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ action('proyectos\ActividadController@detalleactividades',$p->IDACTIVIDAD) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                                                    <a href="{{ action('proyectos\ActividadController@crear',$p->IDACTIVIDAD) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                                                    <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="eliminar!"><span class="fa fa-trash-o"></span></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->

                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER --> 
                @push('PageScript')
                    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
                   
                       
                @endpush('PageScript')
@endsection('principal')