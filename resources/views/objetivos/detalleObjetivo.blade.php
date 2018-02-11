@extends('master')
@section('title','Detalle Objetivo')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    <li><a href="{{ url('/objetivos')}}">Portafolio de Objetivos</a></li>
                    <li class="active">Detalle de proyecto</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Detalle de Objetivo</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="panel panel-default tabs">                            
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-informacion" role="tab" data-toggle="tab">Información</a></li>
                                    <li><a href="#tab-ambito" role="tab" data-toggle="tab">Ambito de Influencia</a></li>
                                    <li><a href="#tab-alcance" role="tab" data-toggle="tab">Alcance</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-informacion">
                                        <div class="col-md-6">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Informacion del Objetivo</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>codigo : </strong> {{$IDOBJETIVOESTRATEGICO or ''}}</li>
                                                        <li class="list-group-item"><strong>Literal : </strong> {{$LITERAL or ''}}</li>
                                                        <li class="list-group-item"><strong>Nombre objetivo : </strong> {{$DESCRIPCION or ''}}</li>
                                                        <li class="list-group-item"><strong>Catalogo : </strong>{{$NOMBRE or ''}}</li>

                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                            {{ csrf_field() }}
                                        <input type="hidden" name="idobjetivo" value="{{ $IDOBJETIVOESTRATEGICO or '0'}}"> 
                                        </div>
                                        <div class="col-md-4">                                          

                                        </div>
                                       

                                        <div class="col-lg-6">
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
                                    <div class="tab-pane" id="tab-ambito">
                                    
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Ambitos de Influencia del Objetivo
                                            @endslot
                                            @slot('idcomponent')
                                            datatableAmbitosObjetivos
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            <th>Nombre</th>
                                            <th width="100">Accion</th>
                                            </tr>

                                        @endcomponent
                                        
                                    </div>

                                    <div class="tab-pane" id="tab-alcance">
                                        
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Alcance de objetivo estrategico
                                            @endslot
                                            @slot('idcomponent')
                                            datatableAlcanceObjetivos
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            <th>Nombre</th>
                                            <th width="100">Accion</th>
                                            </tr>

                                        @endcomponent
                                    </div>
                                    
                                </div>
                            </div>   
                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER --> 
                
                
                @push('PageScript')
                    <script>
                        /*function obtenerDetalleObjetivo(IDOBJETIVOESTRATEGICO){
                           _token = $("input[name=_token]").val();
                            $.post("{{ url('/objetivos/detalles') }}",{_token:_token,IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO},function(data){
                                $("#tablaDetalleObjetivo").html(data);
                            })
                            $("#modalDetalleObjetivo").modal('show');
                           
                        }*/
                        function obtenerDetalleAmbito(IDOBJETIVOESTRATEGICO){
                           _token = $("input[name=_token]").val();
                            $.post("{{ url('/ambito/detalles') }}",{_token:_token,IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO},function(data){
                                $("#tablaDetalleObjetivo").html(data);
                            })
                            $("#modalDetalleObjetivo").modal('show');
                           
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
                                tableAmbitosObjetivos = $("#datatableAmbitosObjetivos").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [], //Initial no order
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/objetivos/datatableAmbitosObjetivo") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idobjetivo = $("input[name=idobjetivo]").val();
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    //"columnDefs": [{ targets: [3], "orderable": false}],
                                    "columns": [
                                        {width: '15%',data: 'IDAMBITOINFLUENCIA'},
                                        {width: '70%',data: 'NOMBREAMBITO'},
                                        
                                        {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                            //end tap para agregar ambitos de objetivos estrategicos
                            
                            //tap para agregar alcance de objetivos estrategicos
                            tableAlcanceObjetivos = $("#datatableAlcanceObjetivos").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [], //Initial no order
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/objetivos/datatableAlcanceObjetivo") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idobjetivo = $("input[name=idobjetivo]").val();
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    //"columnDefs": [{ targets: [3], "orderable": false}],
                                    "columns": [
                                        {width: '15%',data: 'IDALCANCE'},
                                        {width: '70%',data: 'DESCRIPCIONALCANCE'},
                                        
                                        {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                            //end tap para agregar alcance de objetivos estrategicos
                        })
                    </script>
                    
                    <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                    
                @endpush('PageScript')
@endsection('principal')