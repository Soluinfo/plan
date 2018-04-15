@extends('master')
@section('title','Detalle proyecto')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    
                    <li class="active">Entregables</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Entregables de actividades</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="btn btn-block btn-primary" href="{{ url('/actividades/crear/') }}"><span class="fa fa-plus"></span> Nuevo Entregable</a></br>
                        </div>
                        <div class="col-md-12">
                                <!-- START DEFAULT DATATABLE -->
                                <div class="panel panel-default">
                                    <div class="panel-heading">                                
                                        <h3 class="panel-title">Lista de Entregables de actividades</h3>
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
                                        <div class="table-responsive">
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
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- END DEFAULT DATATABLE -->

                            </div>
                        </div>                        
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER --> 
                
                <!-- MODALS -->        
                
                <!-- END MODALS -->
                @push('PageScript')
                     
                    <script type="text/javascript" src="{{ asset('js/plugins/knob/jquery.knob.min.js')}}"></script>
                    <script type="text/javascript" src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                    
                @endpush('PageScript')
@endsection('principal')