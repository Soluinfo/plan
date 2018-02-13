@extends('master')
@section('title','Crear Actividades')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/actividades')}}">Actividades</a></li>
                    <li class="active">Crear Actividades</li>
                </ul>
             <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                <h2><span class="fa fa-arrow-circle-o-left"></span> Crear Actividades</h2>
            </div>
            <!-- END PAGE TITLE --> 
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default tabs">
                            <!--<div id="crearob" class="wizard">--> 
                                                     
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-actividad" role="tab" data-toggle="tab">Crear Actividades</a></li>
                                <li><a href="#tab-reprogramar-actividad" role="tab" data-toggle="tab">Reprogramar Actividad</a></li>
                                <li><a href="#tab-responsable" role="tab" data-toggle="tab">Responsable</a></li>
                                
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-actividad">
                                {!! Form::open(['url' => 'crearactividades/guardar', "name" => "formActividad", "id" => "formActividad","class" => "form-horizontal", "role" => "form"])!!}
                                <p aling="justify">En esta interfaz se podrá crear Actividades para los objetivos.</p>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Nombre</label>
                                            <div class="col-md-6 col-xs-12">                                                                                                                                                        
                                                <input type="text" class="form-control" name="txtNombre" placeholder="Ejemplo A" value="<?php if(isset($NOMBREACTIVIDAD)){echo $NOMBREACTIVIDAD;} ?>"/>                                                    
                                            </div>
                                        </div>

                                        <div class="form-group">                                        
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha:</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="dpFechaActividad" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHACREACIONACTIVIDAD)){echo $FECHACREACIONACTIVIDAD;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Catalogo de Indicadores</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                
                                                <select class="form-control select" name="slIndicador" data-live-search="true">
                                                    <option value="">seleccione catalogo de Indicadores</option>
                                                    @foreach($catalogoindicadores as $d)
                                                        @if( isset($IDCATALOGOINDICADORES))
                                                            @if($d->IDCATALOGOINDICADORES == $IDCATALOGOINDICADORES)
                                                            <option selected="selected" value="{{$d->IDCATALOGOINDICADORES}}">{{$d->NOMBRE}}</option>
                                                            @else
                                                            <option value="{{$d->IDCATALOGOINDICADORES}}">{{$d->NOMBRE}}</option>
                                                            @endif
                                                            @else
                                                        <option value="{{$d->IDCATALOGOINDICADORES}}">{{$d->NOMBRE}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Objetivo</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                
                                                <select class="form-control select" name="slObjetivo" data-live-search="true">
                                                    <option value="">seleccione Objetivo</option>
                                                    @foreach($objetivosestrategicos as $d)
                                                        @if( isset($IDOBJETIVOESTRATEGICO))
                                                            @if($d->IDOBJETIVOESTRATEGICO == $IDOBJETIVOESTRATEGICO)
                                                            <option selected="selected" value="{{$d->IDOBJETIVOESTRATEGICO}}">{{$d->DESCRIPCION}}</option>
                                                            @else
                                                            <option value="{{$d->IDOBJETIVOESTRATEGICO}}">{{$d->DESCRIPCION}}</option>
                                                            @endif
                                                        @else
                                                        <option value="{{$d->IDOBJETIVOESTRATEGICO}}">{{$d->DESCRIPCION}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                           

                                       
                                        {{ csrf_field() }}
                                        <input type="text" name="idactividad" value="{{ $IDACTIVIDAD or '0'}}"/>
                                        
                                    </form>
                                    <button id="btnGuardarActividad" class="btn btn-primary pull-right">Guardar Actividad<span class="fa fa-floppy-o fa-right"></span></button>

                                </div> 
                                <div class="tab-pane" id="tab-reprogramar-actividad">
                                        <button id="btnProgramarActividad" class="btn btn-block btn-primary"><span class="fa fa-plus"></span>Agregar fechas de actividad</button>
                                        <!-- START RESPONSIVE TABLES -->
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Reprogramar actividad
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
            <div class="modal" id="modalResponsable" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="defModalHead">Agregar responsable</h4>
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
                                                                <a class="btn btn-primary btn-xs" onclick="asignarResponsable({{$s->IDACTIVIDAD}});" ><i class="fa fa-plus"></i>Agregar</a>

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
                    </div>
                </div>   
            </div>
            <div class="modal" id="modalReprogramarActividad" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="defModalHead">Programar Actividad</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="block">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                        {!! Form::open(['url' => 'actividad/reprogramar', "name" => "formReprogramacion", "id" => "formReprogramacion","class" => "form-horizontal", "role" => "form"])!!}

                                            <div class="form-group">                                        
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha de inicio:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="dpFechaInicialActividad" id="dpFechaInicialActividad" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHAINICIALACTIVIDAD)){echo $FECHAINICIALACTIVIDAD;} ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">                                        
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha final:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="dpFechaFinalActividad" id="dpFechaFinalActividad" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHAFINALACTIVIDAD)){echo $FECHAFINALACTIVIDAD;} ?>">
                                                </div>
                                            </div>

                                                <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Estado Actividad:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                            
                                                    <select class="form-control select" name="slEstado" id="slEstado" value="<?php if(isset($ESTADOACTIVIDADFECHA)){echo $ESTADOACTIVIDADFECHA;}?>">
                                                        <option value="">Seleccione estado</option>
                                                        @if( isset($ESTADOACTIVIDADFECHA))
                                                            @if($ESTADOACTIVIDADFECHA == 1)
                                                            <option selected="selected" value="1">RETRASADO</option>
                                                            <option value="2">EN PROGRESO</option>
                                                            @else
                                                            <option value="1">RETRASADO</option>
                                                            <option selected="selected" value="2">EN PROGRESO</option>
                                                            @endif
                                                        @else
                                                        <option value="1">RETRASADO</option>
                                                        <option value="2">EN PROGRESO</option>
                                                        @endif
                                                        
                                                    </select>
                                                    
                                                </div>
                                            

                                            </div>
                                           
                                       
                                        </form>
                                        </div>
                                    </div>
                                </div> 
                            </div>   
                        </div>
                        <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button id="btnGuardarReprogramacionActividad" class="btn btn-primary pull-right">Guardar Actividad<span class="fa fa-floppy-o fa-right"></span></button>
                                            </div>
                    </div>
                </div>   
            </div>
                        @component('componentes.mensageBox')
                        @slot('titleComponent')
                            !Alerta
                        @endslot
    
                        Para agregar un responsable necesita registrar una actividad
    
                        @endcomponent          

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
     /////////////////////////////////////////////////////////////////////////////
//inicio de la funcion para validar el formulario de crear catalogo de objetivos///
//////////////////////////////////////////////////////////////////////////////
$("#btnAgregarResponsable").on("click",function(){
        IDACTIVIDAD = $("input[name=idactividad]").val();
        if(IDACTIVIDAD > 0){
            $('#modalResponsable').modal('show')
        }else{
            /* MESSAGE BOX */
            var box = $("#message-box-sound-1");
                if(box.length > 0){
                    box.toggleClass("open");
                    
                    var sound = box.data("sound");
                    
                    if(sound === 'alert')
                        playAudio('alert');
                    
                    if(sound === 'fail')
                        playAudio('fail');
                    
                }        
               
            /* END MESSAGE BOX */
        }
        
    })
//tap para reprogramar actividades
tableResprogramarActividades = $("#datatable-reprogramarActividad").DataTable({
        "lengthMenu": [ 5, 10],
        "language" : {
            "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
        },
        "autoWidth": false,
        "order": [], //Initial no order
        "processing" : true,
        "serverSide": true,
        "ajax": {
            "url": '{{ url("/actividad/reprogramar") }}',
            "type": "post",
            "data": function (d){
                d.idactividad = $("input[name=idactividad]").val();
                d._token = $("input[name=_token]").val();
            }
        },
        //"columnDefs": [{ targets: [5], "orderable": false}],
        "columns": [
            {width: '10%',data: 'IDACTIVIDADFECHAFINAL'},
            {width: '25%',data: 'FECHAINICIALACTIVIDAD'},
            {width: '25%',data: 'FECHAFINALACTIVIDAD'},
            {width: '25%',data: 'ESTADOACTIVIDADFECHA'},
            {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
        
        ]
    });
//end tap para agregar objetivos estrategicos

$("#btnProgramarActividad").on("click",function(){
        IDACTIVIDAD = $("input[name=idactividad]").val();
        if(IDACTIVIDAD > 0){
            $('#modalReprogramarActividad').modal('show')
        }else{
            /* MESSAGE BOX */
            var box = $("#message-box-sound-1");
                if(box.length > 0){
                    box.toggleClass("open");
                    
                    var sound = box.data("sound");
                    
                    if(sound === 'alert')
                        playAudio('alert');
                    
                    if(sound === 'fail')
                        playAudio('fail');
                    
                }        
               
            /* END MESSAGE BOX */
        }
        
    })
     //tap para agregar supervisores al proyecto
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
                        //end tap para agregar supervisores al proyecto 
                        
                        function asignarResponsable(IDRESPONSABLE){
                            IDACTIVIDAD = $("input[name=idactividad]").val();
                            _token = $("input[name=_token]").val();
                            
                            $.post("{{ url('/actividades/asignarResponsableActividad') }}",{IDACTIVIDAD:IDACTIVIDAD,IDRESPONSABLE:IDRESPONSABLE,_token:_token},function(data){
                                
                                var data2 = JSON.parse(data);
                                
                                if(data2.respuesta == 'ok'){
                                    noty({text: data2.mensaje, layout: 'topRight', type: 'success'});
                                    tableResponsableActividad.ajax.reload();
                                }else if(data2.respuesta == 'existe'){
                                    noty({text: data2.mensaje , layout: 'topRight', type: 'warning'});
                                }else{
                                    console.log(data2.respuesta);
                                    noty({text: '!Error: Fallo la transaccion', layout: 'topRight', type: 'error'});
                                }
                            });
                    }      

   

           
                   
   //variables para el wizard
   $("#btnGuardarActividad").on("click",function(){
    datos = $("#formActividad").validate({
        ignore: ":hidden:not(select)",
        
        rules: {
            txtNombre: {
                required: true,
                
                maxlength:500
    
            },
            dpFechaActividad : {
                required: true,
            },
            slIndicador: {
                    required: true,    
                    
            },
            slObjetivo: {
                    required: true,    
                    
            }
            
        },
        messages: {
            txtNombre: {
                required: "El campo Nombre de Actividad es requerido",                  
                maxlength: "El campo Nombre no puede contener mas de 50 caracteres"
               
            },
            dpFechaActividad: {
                required: "Seleccione la fecha de creacion de la actividad",   
                
            },
            slIndicador: {
                    required: "Seleccione un Indicador",
                    
                    
                },
                slObjetivo: {
                    required: "Seleccione un Objetivo",
                    
                    
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
        $("#formActividad").submit();
    }
});
$("#formActividad").on("submit", function(e) {     
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
                    $("input[name=idactividad]").val(data.codigo);
                    if(data.transaccion == 'guardar'){
                        noty({text: 'Actividad creada con exito', layout: 'topRight', type: 'success'});
                    }else{
                        noty({text: 'Actividad actualizada con exito', layout: 'topRight', type: 'success'});
                    }
                    
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

   //variables para el wizard
$("#btnGuardarReprogramacionActividad").on("click",function(){
       datos = $("#formReprogramacion").validate({
           ignore: ":hidden:not(select)",
           
           rules: {
               
            dpFechaInicialActividad: {
                   required: true,                
           },
           dpFechaFinalActividad: {
                   required: true,                
           },
           slEstado : {
            required: true
            }
           },
           highlight: function (element) {
                                        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                                        
                                
                                    },
                                    unhighlight: function (element) {
                                        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                                        

                                    },
           messages: {
              
            dpFechaInicialActividad: {
                   required: "El campo Fecha inicial es requerido",
               },
               dpFechaFinalActividad: {
                   required: "El campo Fecha final es requerido",
               },
               slEstado: {
                required: "El campo [Estado] es requerido"
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
           $("#formReprogramacion").submit(); 
       }
       
   })
   
  
   //ajax guardar informacion proyecto
       $("#formReprogramacion").on("submit", function(e) {
           var idactividad = $("input[name=idactividad]").val();
           var dpFechaInicialActividad =   $("#dpFechaInicialActividad").val();
           var dpFechaFinalActividad =   $("#dpFechaFinalActividad").val();
           var slEstado =   $("#slEstado").val();
           var _token = $("input[name=_token]").val();
           e.preventDefault();
           $.ajax({
               url: $(this).attr("action"),
               type: $(this).attr("method"),
               data: {idactividad:idactividad, dpFechaInicialActividad:dpFechaInicialActividad, dpFechaFinalActividad:dpFechaFinalActividad, slEstado:slEstado, _token:_token },
               dataType : 'json',
               beforeSend : function(){
                   $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
               },
               success : function(data){
                   if(data.respuesta == 'ok'){
                       $("input[name=idactividadfechafinal]").val(data.codigo);
                       if(data.transaccion == 'guardar'){
                           noty({text: 'Fechas de Actividad creadas con exito', layout: 'topRight', type: 'success'});
                       }else{
                           noty({text: 'Fechas de Actividad actualizadas con exito', layout: 'topRight', type: 'success'});
                       }
                       tableResprogramarActividades.ajax.reload();
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
       });

       //ALCANCE 

   
//end ajax

 


</script>   


@endpush('PageScript')
@endsection('principal')