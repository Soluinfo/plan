@extends('master')
@section('title','Detalle proyecto')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    <li><a href="{{ url('/proyectos')}}">Portafolio de proyectos</a></li>
                    <li class="active">Detalle de proyecto</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Detalle de proyecto</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="panel panel-default tabs">                            
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-informacion" role="tab" data-toggle="tab">Información</a></li>
                                    <li><a href="#tab-objetivo" role="tab" data-toggle="tab">Objetivos estrategicos</a></li>
                                    <li><a href="#tab-supervisor" role="tab" data-toggle="tab">Supervisores</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-informacion">
                                        <div class="col-md-4">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Informacion del proyecto</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>codigo : </strong> {{$IDPROYECTO}}</li>
                                                        <li class="list-group-item"><strong>Nombre : </strong> {{$NOMBREPROYECTO}}</li>
                                                        <li class="list-group-item"><strong>Fecha : </strong> {{$FECHAPROYECTO}}</li>
                                                        <li class="list-group-item"><strong>Estado : </strong>
                                                        @if($ESTADOPROYECTO == 1)
                                                        <span class="label label-info">ABIERTO</span>
                                                        @elseif($ESTADOPROYECTO == 2)
                                                        <span class="label label-success">EN PROGRESO</span>
                                                        @elseif($ESTADOPROYECTO == 3)
                                                        <span class="label label-danger">RETRASADO</span>
                                                        @else
                                                        <span class="label label-success">COMPLETADO</span>
                                                        @endif
                                                        </li>
                                                        <li class="list-group-item"><strong>Departamento :</strong>{{$DESCRIPCION_DEP}}</li>
                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                            {{ csrf_field() }}
                                            <input type="hidden" name="idproyecto" value="{{$IDPROYECTO or 0}}">
                                        </div>
                                        <div class="col-md-4">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Avance del proyecto %</h3>
                                                </div>
                                                <div class="panel-body text-center">
                                                    <input id="progreso" class="knob" data-width="200" data-min="0" data-fgColor="
                                                    @if($ESTADOPROYECTO == 1)
                                                    #61C0E6
                                                    @elseif($ESTADOPROYECTO == 2)
                                                    #66CC66
                                                    @elseif($ESTADOPROYECTO == 3)
                                                    #FD421C
                                                    @else
                                                    #66CC66
                                                    @endif
                                                    " data-displayPrevious=true value="{{$progreso or 0}}"/>                            
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->

                                        </div>
                                        <div class="col-lg-4">
                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Usuario y registro</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>Usuario : </strong> dbermudez1349@hotmail.com</li>
                                                        <li class="list-group-item"><strong>Nombre : </strong> Diego</li>
                                                        <li class="list-group-item"><strong>Apellidos : </strong> Bermudez Saenz</li>
                                                       
                                                        <li class="list-group-item"><strong>Fecha de creacion :</strong>{{$created_at}}</li>
                                                        <li class="list-group-item"><strong>Fecha de actualizacion :</strong>{{$updated_at}}</li>
                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-objetivo">
                                    @component('componentes.dataTable')
                                        @slot('titleComponent')
                                        Objetivos estrategicos del proyecto
                                        @endslot
                                        @slot('idcomponent')
                                        datatableObjetivosProyectos
                                        @endslot
                                        <tr>
                                        <th width="50">id</th>
                                        <th>literal</th>
                                        <th>Descripcion</th>
                                        <th width="100">Accion</th>
                                        </tr>

                                    @endcomponent
                                    </div>
                                    <div class="tab-pane" id="tab-supervisor">
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Supervisores del proyecto
                                            @endslot
                                            @slot('idcomponent')
                                            datatable-supervisorProyecto
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
                    <script>
                        
                        function obtenerDetalleObjetivo(IDOBJETIVOESTRATEGICO){
                           _token = $("input[name=_token]").val();
                            $.post("{{ url('/objetivos/detalles') }}",{_token:_token,IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO},function(data){
                                $("#tablaDetalleObjetivo").html(data);
                            })
                            $("#modalDetalleObjetivo").modal('show');
                           
                        }

                        function obtenerDetalleSupervisor(SERIAL_EPL){
                            /*_token = $("input[name=_token]").val();
                            $.post("{{ url('/supervisor/detalles') }}",{_token:_token,SERIAL_EPL:SERIAL_EPL},function(data){
                                $("#tablaDetalleObjetivo").html(data);
                            })*/
                            $("#modalDetalleSupervisor").modal('show');
                        }
                        $(function(){
                            var $input = $("#progreso");
                            

                            var knobEnabled = false;
                            var knobPreviousValue = $input.val();

                            $input.knob({
                                draw: function () { 
                                    if (knobPreviousValue === $input.val()) {
                                    return;
                                    }

                                    if (!knobEnabled) {
                                    $input.val(knobPreviousValue).trigger("change");
                                    return;
                                    }

                                    knobPreviousValue = $input.val();

                                },
                            });

                            //tap para agregar objetivos estrategicos
                                tableObjetivosProyectos = $("#datatableObjetivosProyectos").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [], //Initial no order
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/proyectos/datatableObjetivosProyecto") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idproyecto = $("input[name=idproyecto]").val();
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    "columnDefs": [{ targets: [3], "orderable": false}],
                                    "columns": [
                                        {width: '8%',data: 'IDOBJETIVOESTRATEGICO'},
                                        {width: '8%',data: 'LITERAL'},
                                        {width: '70%',data: 'DESCRIPCION'},
                                        {width: '14%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                            //end tap para agregar objetivos estrategicos
                            //tap para agregar supervisores al proyecto
                                tableSupervisoresProyectos = $("#datatable-supervisorProyecto").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [], //Initial no order
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/proyectos/obtenerSupervisoresProyectos") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idproyecto = $("input[name=idproyecto]").val();
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
                            //end tap para agregar supervisores al proyecto
                        })
                    </script>
                    
                    <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                    
                @endpush('PageScript')
@endsection('principal')