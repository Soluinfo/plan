@extends('master')
@section('title','Objetivos')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                <li><a href="{{ url('/')}}">Principal</a></li>                    
                <li class="active">Ingresar objetivos</li>
            </ul>
            <!-- END BREADCRUMB -->                      
                 <!-- PAGE TITLE -->
                 <div class="page-title">                    
                 <h2><span class="fa fa-arrow-circle-o-left"></span> Crear Objetivos</h2>
             </div>
             <!-- END PAGE TITLE --> 
             <!-- PAGE CONTENT WRAPPER -->
             <div class="page-content-wrap">
                 <div class="row">
                     <div class="col-lg-4">
                         <a class="btn btn-block btn-primary" href="{{ url('/crearobjetivos') }}"><span class="fa fa-plus"></span> Nuevo Objetivo</a>
                     </div>
                     <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Lista de Proyectos</h3>
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
                                            @foreach($objetivosestrategicos as $p)
                                            <tr>      
                                                <td width="8%">{{ $p->IDOBJETIVOESTRATEGICO }}</td>
                                                <td width="8%">{{ $p->LITERAL }}</td>
                                                <td width="54%">{{ $p->DESCRIPCION }}</td>
                                                <td width="20%">{{ $p->NOMBRE }}</td>
                                                
                                                   
                                                </td>
                                                <td width="10%">
                                                    <a href="{{ action('objetivos\DetalleObjetivoController@home',$p->IDOBJETIVOESTRATEGICO) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                                                    <a href="{{ action('objetivos\ObjetivosController@crear',$p->IDOBJETIVOESTRATEGICO) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
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