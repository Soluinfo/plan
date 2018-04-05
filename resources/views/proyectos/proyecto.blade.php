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
                                    <h3 class="panel-title">Listas de proyectos</h3>

                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul> 
                                    <div class="panel-body col-md-3 col-xs-12">
                                       <div class="btn-group">
                                        <button type="button" class="btn btn-info">Seleccione Accion</button>
                                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            
                                        </button>
                                        <ul class="dropdown-menu" role="menu" id="export-menu">
                                            <li id="export-to-excel"><a href="{{ url('/proyectos/reporteexcel') }}">Exportar a Excel</a></li>
                                            
                                            <li><a target="_blank" href="{{ url('/proyectos/pdf') }}">Exportar a PDF</a></li>
                                        </ul>
                                    </div> 
                                    </div> 
                                    <!--<a href="{{ url('/proyectos/reporteexcel') }}"  class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Reporte en Excel <span class="fa fa-plus fa-right"></span></a>
                                    <a href="{{ url('/actividad/pdf') }}"  class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">PDF<span class="fa fa-plus fa-right"></span></a>-->

                                    

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
                                                <td><span class="label label-info label-form">ABIERTO</span></td>
                                                @elseif($p->ESTADOPROYECTO == 2)
                                                <td><span class="label label-success label-form">EN PROGRESO</span></td>
                                                @elseif($p->ESTADOPROYECTO == 3)
                                                <td><span class="label label-danger label-form">EN RETRASO</span></td>
                                                @else
                                                <td><span class="label label-success label-form">COMPLETADO</span></td>
                                                @endif
                                                <td>{{ $p->DESCRIPCION_DEP }}</td>
                                                <td>
                                                    <div class="progress progress-small progress-striped active">
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$p->progreso}}%;">{{$p->progreso}}%</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{ action('proyectos\DetalleProyectoController@home',$p->IDPROYECTO) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                                                    <a href="{{ action('proyectos\ProyectoController@crear',$p->IDPROYECTO) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                                                    <a href="{{ url('eliminarProyecto',$p->IDPROYECTO) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="eliminar!"><span class="fa fa-trash-o"></span></a>

                                                    <!--<a href="{{ action('proyectos\ProyectoController@ExportarExcelId',$p->IDPROYECTO) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Excel!"><span class="fa fa-file-excel-o"></span></a>-->
                                                    <a href="{{ action('proyectos\ProyectoController@Exportarpdf',$p->IDPROYECTO) }}" target="_blank" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Reporte PDF!"><span class="fa fa-file-pdf-o"></span></a>

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
                    <script>
                    function eliminarProyecto(IDPROYECTO){
                            _token = $("input[name=_token]").val();
                            noty({
                                text: 'Esta seguro que desea eliminar el proyecto?',
                                layout: 'topRight',
                                buttons: [
                                        {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                            $noty.close();
                                            $.post("{{ url('/Proyectos/eliminar') }}",{IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                                                if(data == 'eliminado'){
                                                    noty({text: 'El proyecto ha sido Eliminado', layout: 'topRight', type: 'success'});
                                                    
                                                }else{
                                                    noty({text: 'Lo sentimos, no se elimino el proyecto intenta nuevamente', layout: 'topRight', type: 'error'});
                                                }
                                            })
                                            
                                            
                                        }
                                        },
                                        {addClass: 'btn btn-danger btn-clean', text: 'Cancelar', onClick: function($noty) {
                                            $noty.close();
                                            noty({text: 'Eliminacion cancelada', layout: 'topRight', type: 'error'});
                                            }
                                        }
                                    ]
                            })
                            
                        }
                    </script> 
                @endpush('PageScript')
@endsection('principal')