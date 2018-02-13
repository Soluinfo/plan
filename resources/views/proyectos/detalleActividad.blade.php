@extends('master')
@section('title','Detalle proyecto')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    <li><a href="{{ url('/actividades')}}">Actividades</a></li>
                    <li class="active">Detalle de actividades</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Detalle de actividad</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        
                        <div class="col-md-12">
                           
                            <div class="panel panel-default tabs">
                            <!--<div id="crearob" class="wizard">--> 
                                                     
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-actividad" role="tab" data-toggle="tab">Detalle de Actividades</a></li>
                                <li><a href="#tab-reprogramar-actividad" role="tab" data-toggle="tab">Programar Actividad</a></li>
                                <li><a href="#tab-responsable" role="tab" data-toggle="tab">Responsable</a></li>
                                
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-actividad">
                                        <div class="col-md-4">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Informacion del proyecto</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>codigo : </strong> {{$IDACTIVIDAD or null}}</li>
                                                        <li class="list-group-item"><strong>Nombre de actividad : </strong> {{$NOMBREACTIVIDAD or null}}</li>
                                                        <li class="list-group-item"><strong>Proyecto : </strong> {{$NOMBREPROYECTO or null}}</li>
                                                        <li class="list-group-item"><strong>Objetivo : </strong> {{$OBJETIVO or null}}</li>
                                                        <li class="list-group-item"><strong>Indicador : </strong> {{$INDICADOR or null}}</li>
                                                        <li class="list-group-item"><strong>Estado : </strong>
                                                        @if($ESTADO == 1)
                                                        <span class="label label-info">ABIERTO</span>
                                                        @elseif($ESTADO == 2)
                                                        <span class="label label-success">EN PROGRESO</span>
                                                        @elseif($ESTADO == 3)
                                                        <span class="label label-danger">RETRASADO</span>
                                                        @else
                                                        <span class="label label-success">COMPLETADO</span>
                                                        @endif
                                                        </li>
                                                        
                                                        
                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                            {{ csrf_field() }}
                                            <input type="hidden" name="idactividad" value="{{ $IDACTIVIDAD or '0'}}"/>
                                            <input type="hidden" name="idproyecto" value="{{$IDPROYECTO or 0}}">
                                        </div>
                                        <div class="col-md-4">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Avance del proyecto %</h3>
                                                </div>
                                                <div class="panel-body text-center" id="idavancedelproyecto">
                                                    <input id="progreso" class="knob" data-width="200" data-min="0" data-fgColor="
                                                    @if($ESTADO == 1)
                                                    #61C0E6
                                                    @elseif($ESTADO == 2)
                                                    #66CC66
                                                    @elseif($ESTADO == 3)
                                                    #FD421C
                                                    @else
                                                    #66CC66
                                                    @endif
                                                    " data-displayPrevious=true value="{{$progreso or 0}}"/>                            
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->

                                        </div>
                                        
                                </div> 
                                <div class="tab-pane" id="tab-reprogramar-actividad">
                                        <button id="btnProgramarActividad" class="btn btn-block btn-primary"><span class="fa fa-plus"></span>Agregar fechas de actividad</button>
                                        <!-- START RESPONSIVE TABLES -->
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Programar actividad
                                            @endslot
                                            @slot('idcomponent')
                                            datatable-reprogramarActividad
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            
                                            <th width="100" >Fecha de Inicio</th>
                                            <th width="100">Fecha de Entrega</th>
                                            
                                            <th width="100">Estado</th>
                                            <th width="100">Accion</th>
                                            </tr>

                                        @endcomponent
                                        <!-- END RESPONSIVE TABLES --> 
                                       
                                </div>
                                <div class="tab-pane" id="tab-responsable">
                                        <button id="btnAgregarResponsable" class="btn btn-block btn-primary"><span class="fa fa-plus"></span>Agregar responsable</button>
                                        <!-- START RESPONSIVE TABLES -->
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Responsables de la actividad
                                            @endslot
                                            @slot('idcomponent')
                                            datatable-responsableActividad
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            <th width="100" >Cedula</th>
                                            <th width="100">Nombres</th>
                                            <th width="100">Apellidos</th>
                                            <th width="100">Email</th>
                                            <th width="100">Celular</th>
                                            <th width="100">actions</th>
                                            </tr>

                                        @endcomponent
                                        <!-- END RESPONSIVE TABLES --> 
                                       
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER --> 
                <!-- MODALS -->   
                    @component('componentes.modal')
                    @slot('idmodal')
                        modalDetalleObjetivo
                    @endslot
                    @slot('tamanomodal')
                        modal-lg
                    @endslot
                    @slot('titulomodal')
                        Informacion de objetivo2
                    @endslot
                    <div id="tablaDetalleObjetivo" class="panel-body panel-body-table">
                    </div>

                    @endcomponent
                <!-- END MODALS -->
                <!-- MODALS -->        
                <div class="modal" id="modalDetalleSupervisor" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="defModalHead">Informacion de supervisor</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        
                                        <div id="tablaDetalleSupervisor" class="panel-body panel-body-table">



                                        </div>
                                        
                                        
                                    </div>
                                </div>   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODALS -->
                @push('PageScript')
                    <script type='text/javascript' src="{{ url('js/plugins/noty/jquery.noty.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topCenter.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topLeft.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topRight.j') }}s"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/themes/default.js') }}"></script>

                    <script>
                        $(function(){
                            //tap para agregar fechas a la actividad
                            tableFechasActividad = $("#datatable-reprogramarActividad").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
                                "order": [], //Initial no order
                                "processing" : true,
                                "serverSide": true,
                                "ajax": {
                                    "url": '{{ url("/actividades/datatablesfechasactividades") }}',
                                    "type": "post",
                                    "data": function (d){
                                        d.idactividad = $("input[name=idactividad]").val();
                                        d._token = $("input[name=_token]").val();
                                    }
                                },
                                "columns": [
                                    {width: '10%',data: 'IDACTIVIDADFECHAFINAL'},
                                    {width: '25%',data: 'FECHAINICIALACTIVIDAD'},
                                    {width: '25%',data: 'FECHAFINALACTIVIDAD'},
                                    {width: '25%',data: 'ESTADOFECHA'},
                                
                                    {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            })
                        //end tap para agregar responsable a la actividad  
                        //tap para agregar responsable a la actividad
                            tableResponsableActividad = $("#datatable-responsableActividad").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
                                "order": [], //Initial no order
                                "processing" : true,
                                "serverSide": true,
                                "ajax": {
                                    "url": '{{ url("/actividades/ObtenerResponsablesDeActividad") }}',
                                    "type": "post",
                                    "data": function (d){
                                        d.idactividad = $("input[name=idactividad]").val();
                                        d._token = $("input[name=_token]").val();
                                    }
                                },
                                "columns": [
                                    {width: '8%',data: 'SERIAL_EPL'},
                                    {width: '10%',data: 'DOCUMENTOIDENTIDAD_EPL'},
                                    {width: '17%',data: 'NOMBRE_EPL'},
                                    {width: '20%',data: 'APELLIDO_EPL'},
                                    {width: '20%',data: 'EMAIL_EPL'},
                                    {width: '10%',data: 'CELULAR_EPL'},
                                    {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            })
                        //end tap para agregar responsable a la actividad  
                        })
                    </script>
                    
                    <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                    
                @endpush('PageScript')
@endsection('principal')