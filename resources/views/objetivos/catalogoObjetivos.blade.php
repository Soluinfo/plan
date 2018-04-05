@extends('master')
@section('title','Catalogo de Objetivos')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                <li><a href="{{ url('/')}}">Principal</a></li>                    
                <li class="active">Catalogo de objetivos</li>
            </ul>
            <!-- END BREADCRUMB -->                      
                 <!-- PAGE TITLE -->
                 <div class="page-title">                    
                 <h2><span class="fa fa-arrow-circle-o-left"></span> Catálogo de objetivos</h2>
             </div>
             <!-- END PAGE TITLE --> 
             <!-- PAGE CONTENT WRAPPER -->
             <div class="page-content-wrap">
                 <div class="row">
                     <div class="col-lg-4">
                         <a class="btn btn-block btn-primary" href="{{ url('/crearcatalogo') }}"><span class="fa fa-plus"></span> Nuevo Catalogo</a>
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
                                @if(session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div> 
                                @endif 
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
                                            @foreach($catalogo as $p)
                                            <tr>
                                                <td>{{ $p->IDCATALOGOOBJETIVO }}</td>
                                                <td>{{ $p->NOMBRE }}</td>
                                                <td>{{ $p->FECHA }}</td>
                                                @if($p->ESTADO == 1)
                                                
                                                <td><span class="label label-success label-form">Estado 1</span></td>
                                                @elseif($p->ESTADO == 2)
                                                <td><span class="label label-danger label-form">Estado 2</span></td>
                                                @endif
                                                
                                                <td>
                                                
                                                <a href="{{ action('objetivos\DetalleCatalogoObjetivosController@home',$p->IDCATALOGOOBJETIVO) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>

                                                    <a href="{{ action('objetivos\CatalogoObjetivosController@crear',$p->IDCATALOGOOBJETIVO) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>

                                                     <a class="btn btn-danger btn-xs" href="/eliminar/{{ $p->IDCATALOGOOBJETIVO}}" onclick="return confirm('Quiere borrar el registro?')" role="button"><i class="fa fa-trash-o"></i></a> 
                                                  
                                                                                                    
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