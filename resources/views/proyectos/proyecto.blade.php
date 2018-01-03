@extends('master')
@section('title','Proyectos')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li class="active">Portafolio de proyectos</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Portafolio de proyectos</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="btn btn-block btn-primary" href="{{ url('/proyectos/crear') }}"><span class="fa fa-plus"></span> Nuevo proyecto</a>
                        </div>
                        <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Default</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre proyecto</th>
                                                <th>Fecha creacion</th>
                                                <th>estado</th>
                                                <th>Departamento</th>
                                                <th>Actividad</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($proyectos as $p)
                                            <tr>
                                                <td>{{ $p->IDPROYECTO }}</td>
                                                <td>{{ $p->NOMBREPROYECTO }}</td>
                                                <td>{{ $p->FECHAPROYECTO }}</td>
                                                @if($p->ESTADOPROYECTO == 1)
                                                <td><span class="label label-success label-form">Estado 1</span></td>
                                                @elseif($p->ESTADOPROYECTO == 2)
                                                <td><span class="label label-danger label-form">Estado 2</span></td>
                                                @endif
                                                <td>{{ $p->DESCRIPCION_DEP }}</td>
                                                <td>
                                                    <div class="progress progress-small progress-striped active">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$p->progreso}}%;">{{$p->progreso}}%</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                                                    <a href="{{ action('proyectos\ProyectoController@crear',$p->IDPROYECTO) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
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