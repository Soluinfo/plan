@extends('master')
@section('title','Indicadores')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Principal</a></li>                    
                    <li class="active">Crear Indicadores</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Crear indicadores</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="btn btn-block btn-primary" href="{{ url('/crearindicadores') }}"><span class="fa fa-plus"></span> Nuevo Indicador</a>
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
                                            <th>Literal</th>
                                            <th>Descripcion</th>
                                            <th>Catalogo</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($indicadores as $p)
                                        <tr>      
                                            <td width="8%">{{ $p->IDINDICADORES }}</td>
                                            <td width="8%">{{ $p->LITERAL }}</td>
                                            <td width="40%">{{ $p->DESCRIPCION }}</td>
                                            <td width="30%">{{ $p->NOMBRE }}</td>
                                            
                                            <td width="14%">
                                                <a href="{{ action('indicadores\DetalleIndicadorController@home',$p->IDINDICADORES) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>

                                                <a href="{{ action('indicadores\IndicadorController@crear',$p->IDINDICADORES) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                                                <a href="{{ action('objetivos\ObjetivosController@destroy',$p->IDOBJETIVOESTRATEGICO) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="eliminar!"><span class="fa fa-trash-o"></span></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                
                                </table>
                            </div>
                            <!-- END DEFAULT DATATABLE -->

                        </div>
                    </div>                    
                
                <!-- END PAGE CONTENT WRAPPER --> 
                @push('PageScript')
                    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
                @endpush('PageScript')
@endsection('principal')