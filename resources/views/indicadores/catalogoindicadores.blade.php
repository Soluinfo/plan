@extends('master')
@section('title','Catalogo de Indicadores')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Principal</a></li>                    
                    <li class="active">Catalogo de indicadores</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Catálogo de indicadores</h2>
                    
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="btn btn-block btn-primary" href="{{ url('/catalogo/crear') }}"><span class="fa fa-plus"></span> Agregar Catalogo de Indicadores</a>
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
                                <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre de Catalogo</th>
                                                <th>Fecha creacion</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($catalogoindicadores as $p)
                                            <tr>
                                                <td>{{ $p->IDCATALOGOINDICADORES }}</td>
                                                <td>{{ $p->NOMBRE }}</td>
                                                <td>{{ $p->FECHA }}</td>
                                                @if($p->ESTADO == 1)
                                                
                                                <td><span class="label label-success label-form">Estado 1</span></td>
                                                @elseif($p->ESTADO == 2)
                                                <td><span class="label label-danger label-form">Estado 2</span></td>
                                                @endif                                            
                                                <td>
                                                    <a href="{{ action('indicadores\DetalleCatalogoIndicadorController@home',$p->IDCATALOGOINDICADORES) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                                                    <a href="{{ action('indicadores\CatalogoIndicadorController@crear',$p->IDCATALOGOINDICADORES) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                                                    <a class="btn btn-danger btn-xs" href="/eliminar/{{ $p->IDCATALOGOOBJETIVO}}" onclick="return confirm('Quiere borrar el registro?')" role="button"><i class="fa fa-trash-o"></i></a> 
                                                                                                    
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                </table>
                           
                                <!-- END DEFAULT DATATABLE -->

                            </div>
                        </div>                    
                    </div>
                </div>
                <!-- END PAGE CONTENT WRAPPER --> 
                @push('PageScript')
                    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
                @endpush('PageScript')
@endsection('principal')