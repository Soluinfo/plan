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
                            <div class="form-group">
                                <h4>Agregar nueva Actividad:</h4>
                                <textarea class="form-control push-down-10" id="new_task" rows="4" placeholder="Your task text here..."></textarea>                            
                                <button class="btn btn-primary" id="add_new_task"><span class="fa fa-edit"></span> Add</button>
                            </div>                        
                            <div class="form-group push-up-10">
                                <h4>Buscar Actividad:</h4>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="fa fa-search"></span></div>
                                    <input type="text" class="form-control" placeholder="keyword..."/>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Default</label>
                                    <input id="fileprueba" name="fileprueba" type="file" class="file-loading">
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Grupos de Actividades:</h4>
                                <div class="list-group border-bottom">
                                    <a href="#" class="list-group-item"><span class="fa fa-circle text-primary"></span> Project #1</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-circle text-success"></span> Personal</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-circle text-warning"></span> Project #2</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-circle text-danger"></span> Meetings</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-circle text-info"></span> Work</a>
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Tags:</h4>
                                <ul class="list-tags">
                                    <li><a href="#"><span class="fa fa-tag"></span> amet</a></li>
                                    <li><a href="#"><span class="fa fa-tag"></span> rutrum</a></li>
                                    <li><a href="#"><span class="fa fa-tag"></span> nunc</a></li>
                                    <li><a href="#"><span class="fa fa-tag"></span> tempor</a></li>
                                    <li><a href="#"><span class="fa fa-tag"></span> eros</a></li>
                                    <li><a href="#"><span class="fa fa-tag"></span> suspendisse</a></li>
                                    <li><a href="#"><span class="fa fa-tag"></span> dolor</a></li>
                                </ul>                            
                            </div>
                            
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
                @push('PageScript')
                <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                <script type="text/javascript" src="{{ url('js/plugins/moment.min.js')}}"></script>
                <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-select.js')}}"></script>
                <script type="text/javascript" src="{{ url('js/demo_tasks.js')}}"></script> 
                <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                <link href="{{ url('fileinput/css/fileinput.min.css')}}" media="all" rel="stylesheet" type="text/css" />
                <script src="{{ url('fileinput/js/plugins/sortable.min.js')}}"></script>
                <script src="{{ url('fileinput/js/plugins/purify.min.js')}}"></script>
                <script src="{{ url('fileinput/js/plugins/canvas-to-blob.js')}}"></script>
                <script src="{{ url('fileinput/js/fileinput.min.js')}}"></script>
                <script src="{{ url('fileinput/js/locate/es.js')}}"></script>
                
                <script>
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
                    })
                </script>
                @endpush('PageScript')
@endsection('principal')