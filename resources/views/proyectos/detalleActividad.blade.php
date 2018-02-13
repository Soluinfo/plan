
@extends('master')
@section('title','Detalle Actividades')
@section('principal')
                <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                <li><a href="{{ url('/actividades')}}">Portafolio de Actividades</a></li>
                <li class="active">Detalle de indicadores</li>
            </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Detalle de Actividad</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default tabs">                            
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-informacion" role="tab" data-toggle="tab">Información</a></li>
                                    <!--<li><a href="#tab-actividades" role="tab" data-toggle="tab">Indicadores</a></li>-->
                                    <li><a href="#tab-actividades-reprogramadas" role="tab" data-toggle="tab">Reprogramacion de Actividades</a></li>
                                    <li><a href="#tab-responsables" role="tab" data-toggle="tab">Responsables</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-informacion"> 
                                        <div class="col-md-6">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Informacion de la Actividad</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>codigo : </strong> {{$IDACTIVIDAD}}</li>
                                                        <li class="list-group-item"><strong>Actividad: </strong> {{$NOMBREACTIVIDAD}}</li>
                                                        <li class="list-group-item"><strong>Objetivo : </strong> {{$IDOBJETIVOESTRATEGICO}}</li>
                                                        <li class="list-group-item"><strong>Fecha Creacion : </strong> {{$FECHACREACIONACTIVIDAD}}</li>

                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                            {{ csrf_field() }}
                                        <input type="hidden" name="idactividad" value="{{ $IDACTIVIDAD or '0'}}"> 
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
                                    <div class="tab-pane" id="tab-actividades">
                                        
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Indicadores de Actividad
                                            @endslot
                                            @slot('idcomponent')
                                            datatableIndicadorActividad
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            <th>Nombre</th>
                                            <th>Literal</th>
                                            <th width="100">Accion</th>
                                            </tr>

                                        @endcomponent
                                    </div>
                                    <div class="tab-pane" id="tab-actividades-reprogramadas">
                                        
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            ACtividades Reprogramadas
                                            @endslot
                                            @slot('idcomponent')
                                            datatableResprogramacionActividad
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            <th>Fecha Inicial</th>
                                            <th>Fecha Final</th>
                                            <th>Estado</th>
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
                  
               
                @push('PageScript')
                    <script>
                      
                        $(function(){
                           

                            //tap para agregar objetivos estrategicos
                                tableIndicadorActividad = $("#datatableIndicadorActividad").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [], //Initial no order
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/indicadores/datatableIndicadorActividad") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idactividad = $("input[name=idactividad]").val();
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    //"columnDefs": [{ targets: [3], "orderable": false}],
                                    "columns": [
                                        {width: '15%',data: 'IDINDICADORES'},                                      
                                        {width: '35%',data: 'DESCRIPCION'},
                                        {width: '35%',data: 'LITERAL'},  
                                        {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                            //end tap para agregar objetivos estrategicos
                            
                            //tap para reprogramacion de actividades
                            tableReproActividades = $("#datatableResprogramacionActividad").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [], //Initial no order
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/indicadores/reproActividades") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idactividad = $("input[name=idactividad]").val();
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    //"columnDefs": [{ targets: [3], "orderable": false}],
                                    "columns": [
                                        {width: '10%',data: 'IDACTIVIDADFECHAFINAL'},                                      
                                        {width: '25%',data: 'FECHAINICIALACTIVIDAD'},
                                        {width: '25%',data: 'FECHAFINALACTIVIDAD'},
                                        {width: '25%',data: 'ESTADOACTIVIDADFECHA'},   
                                        {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                            //end tap para reprogramacion de actividades
                        })
                        
                    </script>
                    
                    <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                    
                @endpush('PageScript')
@endsection('principal')