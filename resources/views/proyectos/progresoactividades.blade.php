@extends('master')
@section('title','Crear proyecto')
@section('principal')
                                    
                
                <!-- START BREADCRUMB -->
                    <ul class="breadcrumb push-down-0">
                        <li><a href="{{ url('/')}}">Principal</a></li>
                        
                        <li class="active">Actividades</li>
                    </ul>
                <!-- END BREADCRUMB -->  
                                                             
                            
                    <!-- START CONTENT FRAME -->
                    <div class="content-frame">     
                        <!-- START CONTENT FRAME TOP -->
                        <div class="content-frame-top">                        
                            <div class="page-title">                    
                                <h2><span class="fa fa-arrow-circle-o-left"></span> Actividades de proyecto</h2>
                            </div>                                                
                            <div class="pull-right">
                                <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
                            </div>                                
                            <div class="pull-right" style="width: 150px; margin-right: 5px;">
                                <button id="btnSeleccionarProyecto" type="button" class="btn btn-primary">Seleccione proyecto</button>
                            </div>
                            
                        </div>                    
                        <div class="content-frame-left">
                            {{ csrf_field() }}
                            <input type="hidden" name="idactividad">
                                                    
                            
                            
                            
                        </div>       
                        <!-- END CONTENT FRAME TOP -->
                        
                        <!-- START CONTENT FRAME BODY -->
                        <div class="content-frame-body">
                                                    
                            <div class="row push-up-10">
                                <div class="col-md-3">
                                    
                                    <h3>Abierto</h3>
                                    
                                    <div class="tasks" id="tasks-abierta">

                                       
                                    </div>                            

                                </div>
                                <div class="col-md-3">
                                    
                                    <h3>Retrasadas</h3>
                                    
                                    <div class="tasks" id="tasks-retrasadas">                                     
                                        
                                    </div>                            

                                </div>
                                <div class="col-md-3">
                                    <h3>En Progreso</h3>
                                    <div class="tasks" id="tasks-enejecucion">
                                        
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h3>Completadas</h3>
                                    <div class="tasks" id="tasks-completa">
                                                                       
                                    </div>
                                </div>
                            </div>                        
                                                    
                        </div>
                        <!-- END CONTENT FRAME BODY -->
                        
                    </div>
                    <!-- END CONTENT FRAME -->

                    <!-- MODALS -->  
                        @component('componentes.modal')
                            @slot('idmodal')
                                modalDetalleActividad
                            @endslot
                            @slot('tamanomodal')
                                modal-lg
                            @endslot
                            @slot('titulomodal')
                                Detalle de actividad
                            @endslot
                           
                            <div class="col-lg-6">
                                <div class="panel panel-default">
                                    <div class="panel-body profile bg-info">
                                        <div class="profile-data">
                                            <div class="profile-data-name">Informacion de actividad</div>
                                            
                                        </div>
                                    </div>
                                    <div class="panel-body list-group" id="informacionactividad">
                                        <a class="list-group-item"><strong>codigo : </strong> {{$IDACTIVIDAD or null}}</a>
                                        <a class="list-group-item"><strong>Nombre de actividad : </strong> {{$NOMBREACTIVIDAD or null}}</a>
                                        <a class="list-group-item"><strong>Proyecto : </strong> {{$NOMBREPROYECTO or null}}</a>
                                        <a class="list-group-item"><strong>Objetivo : </strong> {{$OBJETIVO or null}}</a>
                                        <a class="list-group-item"><strong>Indicador : </strong> {{$INDICADOR or null}}</a>
                                    </div>                            
                                </div>                                    
                            </div>
                                       
                            <div class="col-lg-6">
                                <!-- DEFAULT LIST GROUP -->
                                <div class="panel panel-default">
                                    <div class="panel-body profile bg-info">
                                        <div class="profile-data">
                                            <div class="profile-data-name">Informacion de actividad</div>
                                            
                                        </div>
                                    </div>
                                    <div class="panel-body list-group" id="avanceActividad">
                                        
                                        <a class="list-group-item">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0% Complete</div>
                                            </div> 
                                        </a>
                                        <a class="list-group-item"><strong>Fecha de inicio : </strong></a> 
                                        <a class="list-group-item"><strong>Fecha de final : </strong></a>                     
                                    </div>
                                </div>
                                
                                <!-- END DEFAULT LIST GROUP -->
                            </div>
                                                        
                        @endcomponent  
                    
                    <!-- END MODALS -->

                    <!-- MODALS -->  
                    @component('componentes.modal')
                            @slot('idmodal')
                                modalreprogramaractividad
                            @endslot
                            @slot('tamanomodal')
                                modal-lg
                            @endslot
                            @slot('titulomodal')
                                    Panel para programar actividad
                            @endslot
                                      
                                <!-- START RESPONSIVE TABLES -->
                                @component('componentes.dataTable')
                                    @slot('titleComponent')
                                    Programar actividad
                                    <button onclick="reprogramarfechaactividad()" class="btn btn-primary">Solicitar reprogramación</button>
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
                        @endcomponent  
                    
                    <!-- END MODALS -->
                    <!-- MODALS -->  
                        @component('componentes.modal')
                            @slot('idmodal')
                                modalProyecto
                            @endslot
                            @slot('tamanomodal')
                                modal-lg
                            @endslot
                            @slot('titulomodal')
                                Seleccione proyecto
                            @endslot
                            <div>                   
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre proyecto</th>
                                            <th>estado</th>
                                            
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($proyectos as $p)
                                        <tr>
                                            <td>{{ $p->IDPROYECTO }}</td>
                                            <td>{{ $p->NOMBREPROYECTO }}</td>
                                            
                                            @if($p->ESTADOPROYECTO == 1)
                                            <td><span class="label label-info label-form">ABIERTO</span></td>
                                            @elseif($p->ESTADOPROYECTO == 2)
                                            <td><span class="label label-success label-form">EN PROGRESO</span></td>
                                            @elseif($p->ESTADOPROYECTO == 3)
                                            <td><span class="label label-danger label-form">EN RETRASO</span></td>
                                            @else
                                            <td><span class="label label-success label-form">COMPLETADO</span></td>
                                            @endif
                                        
                                            
                                            <td>
                                                <a onclick="cargarActividadesDeProyecto({{ $p->IDPROYECTO }});" type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-check-circle-o"></span></a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>

                        @endcomponent  
                        
                    <!-- END MODALS -->
                     <!-- MODALS -->  
                     @component('componentes.modal')
                            @slot('idmodal')
                                modalResponsableActividad
                            @endslot
                            @slot('tamanomodal')
                                modal-lg
                            @endslot
                            @slot('titulomodal')
                                Responsable actividad
                            @endslot
                           
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
                    @endComponent
                    <!-- MODALS -->  
                    @component('componentes.modal')
                            @slot('idmodal')
                                modalRecursosActividad
                            @endslot
                            @slot('tamanomodal')
                                modal-lg
                            @endslot
                            @slot('titulomodal')
                                Panel recursos de actividad
                            @endslot
                             <!-- START ACCORDION -->        
                             <div class="panel-group accordion" id="acordionRecursosActividad">
                                
                            </div>
                            <!-- END ACCORDION -->   
                    @endComponent
                     <!--END MODALS --> 
                      <!-- MODALS -->  
                    @component('componentes.modal')
                            @slot('idmodal')
                                modalReprogramarFechaActividad
                            @endslot
                            @slot('tamanomodal')
                                modal-md
                            @endslot
                            @slot('titulomodal')
                                Solitar reprogramación de fecha
                            @endslot
                             <!-- START ACCORDION --> 
                             <form class="form-horizontal" id="form_reprogramar" name="form_reprogramar">       
                                <div class="col-lg-12">
                                    <div class="form-group">                                        
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha inicial:</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="dpFechaInicio" id="dpFechaInicio" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHAPROYECTO)){echo $FECHAPROYECTO;} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">                                        
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha final:</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="dpFechaFinal" id="dpFechaFinal" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHAFINAL)){echo $FECHAFINAL;} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Observación :</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            
                                            <textarea type="text" class="form-control" id="txtObsevacionReprogramacion" name="txtObsevacionReprogramacion" placeholder="Ejemplo: Motivo" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <a id="btnReprogramarFecha" class="btn btn-info">Reprogramar fecha</a>
                                </div>
                            </form>
                            <!-- END ACCORDION -->   
                    @endComponent
                     <!--END MODALS --> 
                @push('PageScript')
                <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
                <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                <script type="text/javascript" src="{{ url('js/plugins/moment.min.js')}}"></script>
                <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
                <script type="text/javascript" src="{{ url('js/demo_tasks.js')}}"></script> 
                <script type="text/javascript" src="{{ url('js/plugins/jquery-validation/jquery.validate.js') }}"></script> 
                <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                <script type='text/javascript' src="{{ url('js/plugins/noty/jquery.noty.js') }}"></script>
                <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topCenter.js') }}"></script>
                <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topLeft.js') }}"></script>
                <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topRight.j') }}s"></script>

                        
                
                <script type='text/javascript' src="{{ url('js/plugins/noty/themes/default.js') }}"></script>
                <link href="{{ url('fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
                <script src="{{ url('fileinput/js/plugins/sortable.min.js')}}"></script>
                <script src="{{ url('fileinput/js/plugins/purify.min.js')}}"></script>
                <script src="{{ url('fileinput/js/plugins/canvas-to-blob.js')}}"></script>
                <script src="{{ url('fileinput/js/fileinput.min.js')}}"></script>
                <script src="{{ url('fileinput/js/locate/es.js')}}"></script>
                
                <script>
                    function reprogramarfechaactividad(){
                       idactividad = $("input[name=idactividad]").val();
                       $('#modalReprogramarFechaActividad').modal('show');
                    }
                    function cargarActividadesDeProyecto(IDPROYECTO){
                        _token = $("input[name=_token]").val();
                        estadoabierto = '1';
                        estadoenejecucion = '2';
                        estadoenretrasa = '3';
                        estadocompletada = '4';
                        $.post(" {{ url('/ProgresoActividad/obtenerActividadesDeProyecto') }}",{IDPROYECTO:IDPROYECTO,_token:_token,ESTADO:estadoabierto},function(data){
                            $("#tasks-abierta").html(data);
                        })
                        $.post(" {{ url('/ProgresoActividad/obtenerActividadesDeProyecto') }}",{IDPROYECTO:IDPROYECTO,_token:_token,ESTADO:estadoenejecucion},function(data){
                            $("#tasks-enejecucion").html(data);
                        })
                        $.post(" {{ url('/ProgresoActividad/obtenerActividadesDeProyecto') }}",{IDPROYECTO:IDPROYECTO,_token:_token,ESTADO:estadoenretrasa},function(data){
                            $("#tasks-retrasadas").html(data);
                        })
                        $.post(" {{ url('/ProgresoActividad/obtenerActividadesDeProyecto') }}",{IDPROYECTO:IDPROYECTO,_token:_token,ESTADO:estadocompletada},function(data){
                            $("#tasks-completa").html(data);
                        })
                        $('#modalProyecto').modal('hide');
                    }
                    function programarFechaActividad(IDACTIVIDAD){
                        $("input[name=idactividad]").val(IDACTIVIDAD);
                        tableFechasActividad.ajax.reload();
                        $('#modalreprogramaractividad').modal('show');
                    }
                    function detalleActividad(IDACTIVIDAD){
                        
                        _token = $("input[name=_token]").val();
                        $.post(" {{url('/ProgresoActividad/obtenerDetalleActividadesEnModal') }}",{IDACTIVIDAD:IDACTIVIDAD,_token:_token},function(data){
                            $("#informacionactividad").html(data);
                        })
                        $.post(" {{url('/ProgresoActividad/obtenerAvanceActividadmodal') }}",{IDACTIVIDAD:IDACTIVIDAD,_token:_token},function(data){
                            $("#avanceActividad").html(data);
                           
                        })
                        $('#modalDetalleActividad').modal('show');
                    }

                    function recursoDeActividad(IDACTIVIDAD){
                        $.post(" {{url('/ProgresoActividad/obtenerRecursosActividadesEnModal') }}",{IDACTIVIDAD:IDACTIVIDAD,_token:_token},function(data){
                            $("#acordionRecursosActividad").html(data);
                        })
                        $('#modalRecursosActividad').modal('show');
                    }

                    function responsablesDeActividad(IDACTIVIDAD){
                        $("input[name=idactividad]").val(IDACTIVIDAD);
                        tableResponsableActividad.ajax.reload();
                        $('#modalResponsableActividad').modal('show');
                    }
                    
                    $(document).ready(function(){
                        var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
                            'onclick="alert(\'Call your custom code here.\')">' +
                            '<i class="fa fa-cloud-download"></i>' +
                            '</button>'; 
                        
                        
                        var direccion = "{{ url('fileinput/img/pdf.png') }}";
                        var url1 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
                        url2 = 'http://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg';
                        /*$("#fileprueba").fileinput({
                            language: "es",
                            uploadUrl: "{{ url('/ProgresoActividad/subirDocumentoRecurso')}}", // server upload action
                            uploadAsync: false,
                            minFileCount: 1,
                            maxFileCount: 1,
                            overwriteInitial: false,
                            initialPreviewAsData: true,
                            initialPreviewFileType: 'image',
                            resizeImage: true,
                            uploadExtraData: {
                                idrecurso: 8,
                                _token: $("input[name=_token]").val(),
                            },
                            initialPreview: [
                                direccion
                            ],
                            initialPreviewConfig: [
                              
                                {caption: "Moon.jpg", downloadUrl: url1, size: 930321, width: "120px", key: 1},
                               
                            ],
                            deleteUrl: "/site/file-delete",
                        });*/
                       
                    $("#fileprueba").fileinput({
                        language: "es",
                        initialPreview: [direccion, direccion],
                        initialPreviewDownloadUrl: 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg',
                        initialPreviewAsData: true,
                        initialPreviewConfig: [
                            {caption: "Moon.jpg", downloadUrl: 'http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg', size: 930321, width: "120px", key: 1},
                            {caption: "Earth.jpg", downloadUrl: direccion, size: 1218822, width: "120px", key: 2},
                        ],
                        deleteUrl: "/site/file-delete",
                        overwriteInitial: false,
                        maxFileSize: 100,
                        showUpload: false,
                        initialCaption: "The Moon and the Earth",
                        filename: 'KrajeeSample.mp4'
                    });
                                     
                        $("#btnSeleccionarProyecto").on("click", function(){
                            $('#modalProyecto').modal('show')
                        })
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
                        $("#btnReprogramarFecha").on("click",function(){
                            datos = $("#form_reprogramar").validate({
                                ignore: ":hidden:not(select)",
                                
                                rules: {
                                    dpFechaInicio: {
                                        required: true, 
                                        date:true
                            
                                    },
                                    
                                    dpFechaFinal: {
                                            required: true,    
                                            date: true,
                                    },
                                    txtObsevacionReprogramacion : {
                                        required: true,
                                        maxlength: 500,
                                    }
                                    
                                },
                                messages: {
                                    dpFechaInicio: {
                                        required: "El campo Fecha inicial es requerido",
                                        date: "Debe colocar una fecha valida",                                                      
                                    },
                                    
                                    dpFechaFinal: {
                                            required: "Seleccione un Indicador",
                                            date: "Debe colocar una fecha valida", 
                                        },
                                    txtObsevacionReprogramacion: {
                                        required: "El campo observacion es requerido",
                                        maxLength: ""
                                    },
                                    
                                },
                                success: function ( label, element ) {
                                    
                                    var element2 = label.siblings('div'); 
                                                    
                                    if(element2.hasClass('btn-group')){
                                        element2.attr("class","btn-group bootstrap-select form-control select valid");
                                    }
                                    
                                },
                                errorPlacement: function (error, element) {
                                    console.log('error');
                                    var element2 = element.siblings('div'); 
                                    var element3 = element.siblings('span'); 
                                    
                                    if (element2.hasClass('btn-group')) {
                                        element2.attr("class","btn-group bootstrap-select form-control select error");
                                        error.insertAfter(element2);
                                    } else {
                                        
                                        element3.hide();
                                        error.insertAfter(element);
                                        
                                    }
                                    /*Add other (if...else...) conditions depending on your
                                    * validation styling requirements*/
                                },
                                
                                
                            });
                                                
                        
                            if(datos.form() == true){
                                FECHAINICIO = $('#dpFechaInicio').val();
                                FECHAFINAL = $('#dpFechaFinal').val();
                                OBSERVACION = $('#txtObsevacionReprogramacion').val();
                                IDACTIVIDAD = $("input[name=idactividad]").val();
                                _token = $("input[name=_token]").val();
                                $.post(" {{url('/ProgresoActividad/enviarSolicitudReprogramarFecha') }}",{FECHAINICIO:FECHAINICIO,FECHAFINAL:FECHAFINAL,OBSERVACION:OBSERVACION,_token:_token,IDACTIVIDAD:IDACTIVIDAD},function(data){
                                    if(data == "ok"){
                                        noty({text: 'Solicitud enviada', layout: 'topRight', type: 'success'});
                                    }else{
                                        noty({text: 'Ya existe una solicitud pendiente', layout: 'topRight', type: 'error'});
                                    }
                                });
                            }
                        });
                    })
                </script>
                @endpush('PageScript')
@endsection('principal')