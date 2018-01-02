@extends('master')
@section('title','Crear proyecto')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/proyectos')}}">Portafolio de proyectos</a></li>
                    <li class="active">Crear proyecto</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Crear proyecto</h2>
                </div>
                
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default tabs">                            
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-informacion" role="tab" data-toggle="tab">Información</a></li>
                                    <li><a href="#tab-objetivo" role="tab" data-toggle="tab">Objetivos estrategicos</a></li>
                                    <li><a href="#tab-supervisor" role="tab" data-toggle="tab">Supervisores</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-informacion">
                                        {!! Form::open(['url' => 'proyectos/guardar', "name" => "formProyecto", "id" => "formProyecto","class" => "form-horizontal", "role" => "form"]) !!}
                                            
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Nombre de proyecto :</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="txtnombreProyecto" placeholder="Ejemplo: Proyecto 2017" value="<?php if(isset($NOMBREPROYECTO)){echo $NOMBREPROYECTO;} ?>"/>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha :</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="dpFechaProyecto" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHAPROYECTO)){echo $FECHAPROYECTO;} ?>">
                                                </div>
                                            </div>            
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Estado :</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                            
                                                    <select class="form-control select" name="slEstado">
                                                        <option value="">Seleccione estado</option>
                                                        @if( isset($ESTADOPROYECTO))
                                                            @if($ESTADOPROYECTO == 1)
                                                            <option selected="selected" value="1">ACTIVO</option>
                                                            <option value="2">INACTIVO</option>
                                                            @else
                                                            <option value="1">ACTIVO</option>
                                                            <option selected="selected" value="2">INACTIVO</option>
                                                            @endif
                                                        @else
                                                        <option value="1">ACTIVO</option>
                                                        <option value="2">INACTIVO</option>
                                                        @endif
                                                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Departamento</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                
                                                    <select class="form-control select" name="slDepartamento" data-live-search="true">
                                                        <option value="">seleccion departamento</option>
                                                        @foreach($departamento as $d)
                                                            @if( isset($SERIAL_DEP))
                                                                @if($d->SERIAL_DEP == $SERIAL_DEP)
                                                                <option selected="selected" value="{{$d->SERIAL_DEP}}">{{$d->DESCRIPCION_DEP}}</option>
                                                                @else
                                                                <option value="{{$d->SERIAL_DEP}}">{{$d->DESCRIPCION_DEP}}</option>
                                                                @endif
                                                            @else
                                                            <option value="{{$d->SERIAL_DEP}}">{{$d->DESCRIPCION_DEP}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{ csrf_field() }}
                                            <input type="text" name="idproyecto" value="{{ $IDPROYECTO or '0'}}">
                                            
                                        </form>
                                        <button id="btnGuardarProyecto" class="btn btn-primary pull-right">Guardar proyecto <span class="fa fa-floppy-o fa-right"></span></button>
                                    </div>
                                    <div class="tab-pane" id="tab-objetivo">

                                        <button class="btn btn-block btn-primary col-md-4" data-toggle="modal" data-target="#modalObjetivo"><span class="fa fa-plus"></span>Agregar objetivo</button>
                                        
                                        <!-- START RESPONSIVE TABLES -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Objetivos estrategicos del proyecto</h3>
                                            </div>

                                            <div class="panel-body panel-body-table">

                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-striped table-actions" id="datatableObjetivosProyectos">
                                                        <thead>
                                                            <tr>
                                                            <th width="50">id</th>
                                                            <th>literal</th>
                                                            <th>Descripcion</th>
                                                            <th width="100">Accion</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>                                            
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>                                

                                            </div>
                                            </div> 
                                            <!-- END RESPONSIVE TABLES --> 
                                        
                                    </div>
                                    <div class="tab-pane" id="tab-supervisor">
                                        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalSupervisor"><span class="fa fa-plus"></span>Agregar supervisor</button>
                                        <!-- START RESPONSIVE TABLES -->
                                            <div class="panel panel-default">

                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Supervisores del proyecto</h3>
                                                </div>

                                                <div class="panel-body panel-body-table">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped table-actions datatable" id="datatable-supervisorProyecto">
                                                                    <thead>
                                                                        <tr>
                                                                        <th width="50">id</th>
                                                                        <th width="100" >Cedula</th>
                                                                        <th width="100">Nombres</th>
                                                                        <th width="100">Apellidos</th>
                                                                        <th width="100">Email</th>
                                                                        <th width="100">Celular</th>
                                                                        <th width="100">actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="tablaasignacion">                                            
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                            
                                                    </div>
                                                                                    

                                                </div>
                                            </div> 
                                        <!-- END RESPONSIVE TABLES --> 
                                       
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->
                <!-- MODALS -->        
                    <div class="modal" id="modalObjetivo" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="defModalHead">Agregar objetivos</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                            <div class="block">
                                                <div class="panel panel-default">
                                                    <div class="panel-body">
                                                        <div class=".form-group">
                                                            <label class="col-lg-2 col-md-2 col-sm-3 col-xs-12 control-label">Catalogo objetivos :</label>
                                                            <div class="col-lg-10 col-md-10 col-sm-9 col-xs-12">                                                                                       
                                                                <select class="form-control select" name="slcatalogo" id="slcatalogo" data-live-search="true">
                                                                    <option value="">Seleccione catalogo</option>
                                                                    @foreach($catalogo as $c)
                                                                        <option value="{{ $c->IDCATALOGOOBJETIVO }}">{{ $c->NOMBRE }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-actions" id="datatableObjetivos">
                                                    <thead>
                                                        <tr>
                                                            <th width="50">id</th>
                                                            <th>literal</th>
                                                            <th>Descripcion</th>
                                                            <th width="100">seleccionar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tablaObjetivoSeleccionar">
                                                                                                        
                                                    </tbody>
                                                </table>
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
                <!-- MODALS -->        
                    <div class="modal" id="modalSupervisor" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="defModalHead">Agregar supervisor</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                           
                                                <div class="panel-body panel-body-table">

                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped table-actions datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="50">id</th>
                                                                    <th>Cedula</th>
                                                                    <th>Nombres</th>
                                                                    <th width="100">Apellidos</th>
                                                                    <th width="100">Email</th>
                                                                    <th width="100">Celular</th>
                                                                    <th width="100">seleccionar</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($supervisores as $s)                                          
                                                                    <tr id="trow_{{$s->SERIAL_EPL}}">
                                                                        <td class="text-center">{{$s->SERIAL_EPL}}</td>
                                                                        <td>{{$s->DOCUMENTOIDENTIDAD_EPL}}</td>
                                                                        <td>{{$s->NOMBRE_EPL}}</td>
                                                                        <td>{{$s->APELLIDO_EPL}}</td>
                                                                        <td>{{$s->EMAIL_EPL}}</td>
                                                                        <td>{{$s->CELULAR_EPL}}</td>
                                                                        <td>
                                                                            <button class="btn btn-default btn-sm" onclick="asignarSupervisor({{$s->SERIAL_EPL}});" ><span class="fa fa-check"></span></button>
    
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                               
                                                            </tbody>
                                                        </table>
                                                    </div>                                

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
        
                <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
                <script type="text/javascript" src="{{ url('js/plugins/bootstrap/locales/bootstrap-datepicker.es.js') }}"></script>                
               
                <script type="text/javascript" src="{{ url('js/plugins/bootstrap/bootstrap-select.js') }}"></script>
                <script type="text/javascript" src="{{ url('js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
                
                <script type='text/javascript' src="{{ url('js/plugins/noty/jquery.noty.js') }}"></script>
                <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topCenter.js') }}"></script>
                <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topLeft.js') }}"></script>
                <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topRight.j') }}s"></script>

                        
                
                <script type='text/javascript' src="{{ url('js/plugins/noty/themes/default.js') }}"></script>

                <script type="text/javascript" src="{{ url('js/plugins/smartwizard/jquery.smartWizard-2.0.min.js') }}"></script>        
                <script type="text/javascript" src="{{ url('js/plugins/jquery-validation/jquery.validate.js') }}"></script> 

                <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
                <script>
                    
                    function asignarSupervisor(IDSUPERVISOR){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            _token = $("input[name=_token]").val();
                            
                            $.post("{{ url('/proyectos/asignarSupervisorProyecto') }}",{IDPROYECTO:IDPROYECTO,IDSUPERVISOR:IDSUPERVISOR,_token:_token},function(data){
                                
                                var data2 = JSON.parse(data);
                                
                                if(data2.respuesta == 'ok'){
                                    noty({text: data2.mensaje, layout: 'topRight', type: 'success'});
                                    tableSupervisoresProyectos.ajax.reload();
                                }else if(data2.respuesta == 'existe'){
                                    noty({text: data2.mensaje , layout: 'topRight', type: 'warning'});
                                }else{
                                    console.log(data2.respuesta);
                                    noty({text: '!Error: Fallo la transaccion', layout: 'topRight', type: 'error'});
                                }
                            });
                    }

                    function agregarObjetivos(IDOBJETIVOESTRATEGICO){
                        IDPROYECTO = $("input[name=idproyecto]").val();
                        _token = $("input[name=_token]").val();
                        $.post("{{ url('/proyectos/asignarObjetivoProyecto') }}",{IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO,IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                            var data2 = JSON.parse(data);
                            if(data2.respuesta == 'ok'){
                                noty({text: data2.mensaje, layout: 'topRight', type: 'success'});
                                tableObjetivosProyectos.ajax.reload();
                            }else{
                                console.log(data2.respuesta);
                                noty({text: '!Error: Fallo la transaccion', layout: 'topRight', type: 'error'});
                            }
                        })
                    }
               
                    $(document).ready(function(){
                        //tap para Guardar informacion proyecto
                            $("#btnGuardarProyecto").on("click",function(){
                                datos = $("#formProyecto").validate({
                                    ignore: ":hidden:not(select)",
                                    
                                    rules: {
                                        txtnombreProyecto: {
                                            required: true,
                                            minlength: 2,
                                            maxlength: 250
                                        },
                                        dpFechaProyecto: {
                                            required: true,
                                        },
                                        slDepartamento: {
                                            required: true,
                                            
                                        },
                                        slEstado : {
                                            required: true
                                        }
                                    },
                                    messages: {
                                        txtnombreProyecto: {
                                            required: "El campo nombre de proyecto es requerido",
                                            minlength: "El campo nombre de proyecto no puede contener menos de dos caracteres",
                                            maxlength: "El campo nombre de proyecto no puede contener mas de 250 caracteres"
                                        },
                                        dpFechaProyecto : {
                                            required: "El campo fecha es requerido"
                                        },
                                        slDepartamento: {
                                            required: "El campo direccion es requierido",
                                            
                                        },
                                        slEstado: {
                                            required: "El campo estado es requerido"
                                        }
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
                                    }
                                    
                                });
                                $('select.select').on('change', function () {
                                    datos.element($(this));
                                    element = $(this);
                                    var element2 = element.siblings('div'); 
                                    if(element.val() > 0){
                                        console.log('mayor a cero');
                                    }else{
                                        if (element2.hasClass('btn-group')) {
                                            element2.attr("class","btn-group bootstrap-select form-control select error");
                                            error.insertAfter(element2);
                                        }
                                    }
                                    
                                })
                            
                                if(datos.form() == true){
                                    $("#formProyecto").submit();
                                }
                            });
                            
                            $("#formProyecto").on("submit", function(e) {     
                                e.preventDefault();
                                $.ajax({
                                    url: $(this).attr("action"),
                                    type: $(this).attr("method"),
                                    data: $(this).serialize(),
                                    dataType : 'json',
                                    beforeSend : function(){
                                        $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                                    },
                                    success : function(data){
                                        if(data.respuesta == 'ok'){
                                            $("input[name=idproyecto]").val(data.codigo);
                                            if(data.transaccion == 'guardar'){
                                                noty({text: 'Proyecto creado con exito', layout: 'topRight', type: 'success'});
                                            }else{
                                                noty({text: 'Proyecto actualizado con exito', layout: 'topRight', type: 'success'});
                                            }
                                            //se cargan los supervisores del proyecto
                                            obtenerSupervisoresDeProyecto();
                                        }
                                        $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                                        $.mpb('destroy');
                                    },
                                    error : function(xhr,estado){
                                        $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                                        $.mpb('destroy');
                                        alert("!Error "+xhr.status+", reportelo al centro de computo");
                                        
                                    }
                                })
                            })
                        //end tap Guardar informacion proyecto
                        //tap para agregar objetivos estrategicos
                            table = $("#datatableObjetivos").DataTable({
                                "lengthMenu": [ 5, 10],
                                "url": baseUrl+"js/plugins/datatables/spanish.json",
                                
                                "order": [], //Initial no order
                                "processing" : true,
                                "serverSide": true,
                                "ajax": {
                                    "url": '{{url("/proyectos/objetivos")}}',
                                    "type": "post",
                                    "data": function (d){
                                        d.idcatalogo = $("#slcatalogo").val();
                                        d._token = $("input[name=_token]").val();
                                    }
                                },
                                "columnDefs": [{ targets: [3], "orderable": false}],
                                "columns": [
                                    {data: 'IDOBJETIVOESTRATEGICO'},
                                    {data: 'LITERAL'},
                                    {data: 'DESCRIPCION'},
                                    {data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            });
                            tableObjetivosProyectos = $("#datatableObjetivosProyectos").DataTable({
                                "lengthMenu": [ 5, 10],
                                "url": baseUrl+"js/plugins/datatables/spanish.json",
                                
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
                                    {data: 'IDOBJETIVOESTRATEGICO'},
                                    {data: 'LITERAL'},
                                    {data: 'DESCRIPCION'},
                                    {data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            });
                            $("#slcatalogo").on("change",function(){
                                $.mpb('show',{value: [0,40],speed: 10,state: 'info'});
                                $("#slcatalogo option:selected").each(function(){
                                    table.ajax.reload();
                                })
                                $.mpb('show',{value: [40,100],speed: 10,state: 'info'});
                            })
                        //end tab agregar objetivos estrategicos
                        //tap para agregar supervisores al proyecto
                            tableSupervisoresProyectos = $("#datatable-supervisorProyecto").DataTable({
                                "lengthMenu": [ 5, 10],
                                "url": baseUrl+"js/plugins/datatables/spanish.json",
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
                                    {data: 'SERIAL_EPL'},
                                    {data: 'DOCUMENTOIDENTIDAD_EPL'},
                                    {data: 'NOMBRE_EPL'},
                                    {data: 'APELLIDO_EPL'},
                                    {data: 'EMAIL_EPL'},
                                    {data: 'CELULAR_EPL'},
                                    {data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            })
                        //end tap para agregar supervisores al proyecto
                    });
                    
                </script>
                @endpush('PageScript')
@endsection('principal')