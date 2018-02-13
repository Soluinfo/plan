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
                                                        <li class="list-group-item"><strong>codigo : </strong> {{$IDOBJETIVOESTRATEGICO}}</li>
                                                        <li class="list-group-item"><strong>Literal : </strong> {{$LITERAL}}</li>
                                                        <li class="list-group-item"><strong>Nombre objetivo : </strong> {{$DESCRIPCION}}</li>
                                                        <li class="list-group-item"><strong>Catalogo : </strong>{{$NOMBRE}}</li>

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
                <!-- MODALS --> 
                  
                <div class="modal" id="modalDetalleAmbito" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="defModalHead">Agregar Ambito de Influencia</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="block">
                                    <div class="panel panel-default">
                                        <div class="panel-body">

                                         <div id="tablaDetalleAmbito" type="text" class="panel-body panel-body-table">

                                        </div>
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 col-xs-12 control-label">Descripcion</label>
                                                <div class="col-md-6 col-xs-12">                                            
                                                    <input type="text" class="form-control" name="txtDescripcionAmbito" value="<?php if(isset($NOMBREAMBITO)){echo $NOMBREAMBITO;} ?>">
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a id="btnGuardarAmbito" class="btn btn-primary pull-right">Guardar Ambito <span class="fa fa-floppy-o fa-right"></span></a>
                        </div>
                    </div>
                </div>
                    
            </div>


                <!-- END MODALS -->
                <!-- MODALS -->        
                
                
                @push('PageScript')
                    <script>
                        /*function obtenerDetalleObjetivo(IDOBJETIVOESTRATEGICO){
                           _token = $("input[name=_token]").val();
                            $.post("{{ url('/objetivos/detalles') }}",{_token:_token,IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO},function(data){
                                $("#tablaDetalleObjetivo").html(data);
                            })
                            $("#modalDetalleObjetivo").modal('show');
                           
                        }*/
                        function editarDetalleAmbito(IDAMBITOINFLUENCIA){
                           _token = $("input[name=_token]").val();
                            $.post("{{ url('/ambito/editar') }}",{_token:_token,IDAMBITOINFLUENCIA:IDAMBITOINFLUENCIA},function(data){
                                $("#tablaDetalleAmbito").html(data);
                            })
                            $("#modalDetalleAmbito").modal('show');
                            //"columnDefs": [{ targets: [3], "orderable": false}],
                                   
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