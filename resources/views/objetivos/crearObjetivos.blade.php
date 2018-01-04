@extends('master')
@section('title','Crear Objetivos')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/objetivos')}}">Crear objetivos</a></li>
                    <li class="active">Crear objetivo</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Crear Objetivos</h2>
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Crear Objetivos</h2>
                </div>
                <!-- END PAGE TITLE --> 
               <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default tabs">
                            <!--<div id="crearob" class="wizard">--> 
                                                     
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-objetivos" role="tab" data-toggle="tab">Crear Objetivos</a></li>
                                <li><a href="#tab-ambito" role="tab" data-toggle="tab">Ambito de influencia</a></li>
                                <li><a href="#tab-alcance" role="tab" data-toggle="tab">Alcance</a></li>
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-objetivos">
                                    {!! Form::open(['url' => 'objetivos/guardar', "name" => "formObjetivos", "id" => "formObjetivos","class" => "form-horizontal", "role" => "form"])!!}
                                        <p aling="justify">En esta interfaz se podrá ingresar objetivos, alcance que tendrá el mismo y el ámbito al cual van a pertenecer. </p>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Literal</label>
                                            <div class="col-md-6 col-xs-12">                                                                                                                                                        
                                                <input type="text" class="form-control" name="txtLiteral" placeholder="Ejemplo A" value="{{$LITERAL}}"/>                                                    
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Descripcion</label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <input type="text" class="form-control" name="txtDescripcion" value="{{$DESCRIPCION}}"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Seleccione el Proyecto</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                
                                                <select class="form-control select" name="slidcatalogo" data-live-search="true">
                                                    <option value="">seleccion proyecto</option>
                                                    @foreach($catalogoobjetivos as $d)
                                                        @if(isset($IDCATALOGOOBJETIVO))
                                                            @if($IDCATALOGOOBJETIVO == $d->IDCATALOGOOBJETIVO)
                                                            <option selected="selected" value="{{$d->IDCATALOGOOBJETIVO}}">{{$d->NOMBRE}}</option>
                                                            @else 
                                                            <option value="{{$d->IDCATALOGOOBJETIVO}}">{{$d->NOMBRE}}</option>
                                                            @endif
                                                        @else 
                                                        <option value="{{$d->IDCATALOGOOBJETIVO}}">{{$d->NOMBRE}}</option>
                                                        @endif
                                                
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                        <input type="text" name="idobjetivo" value="{{ $IDOBJETIVOESTRATEGICO or '0'}}"/>
                                    </form>
                                    <button id="btnGuardarObjetivo" class="btn btn-primary pull-right">Guardar Objetivo <span class="fa fa-floppy-o fa-right"></span></button>

                                </div> 

                                <div class="tab-pane" id="tab-ambito">
                                       
                                    <button id="btnAgregarAmbito" class="btn btn-block btn-primary col-md-4"><span class="fa fa-plus"></span>Agregar Ambito de Influencia</button>
                                    @component('componentes.dataTable')
                                        @slot('titleComponent')
                                        Ambitos del objetivo estrategicos
                                        @endslot
                                        @slot('idcomponent')
                                        datatableAmbitosObjetivos
                                        @endslot
                                        <tr>
                                        <th width="50">id</th>
                                        <th>Descripcion</th>
                                        <th>Nombre de Ambito</th>
                                        <th width="100">Accion</th>
                                    </tr>

                                    @endcomponent
                                   
                                </div>

                                <div class="tab-pane" id="tab-alcance">
                                        
                                    <button id="btnAgregarAlcance" class="btn btn-block btn-primary col-md-4"><span class="fa fa-plus"></span>Agregar Alcance</button>
                                        
                                    <!-- START RESPONSIVE TABLES -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Alcance del objetivo</h3>
                                        </div>
    
                                        <div class="panel-body panel-body-table">
    
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped table-actions" id="#">
                                                    <thead>
                                                        <tr>
                                                            <th width="50">id</th>
                                                            
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
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer"> 
                                                                        
                    </div>
                </div>
            </div>
         
                                        
            @component('componentes.mensageBox')
                @slot('titleComponent')
                    !Alerta
                @endslot

                Para agregar un ambito y alcance necesita registrar un objetivo

            @endcomponent
             <!-- END PAGE CONTENT WRAPPER -->
                <!-- MODALS -->        
                <div class="modal" id="modalAmbito" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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
                                                {!! Form::open(['url' => 'ambito/guardara', "name" => "formAmbito", "id" => "formAmbito","class" => "form-horizontal", "role" => "form"])!!}

                                                    <div class="form-group">
                                                        <label class="col lg-3 col-md-3 col sm-3 col xs-12 control-label">Descripcion</label>
                                                        <div class="col lg-6 col-md-6 col sm-6 col xs-12">
                                                            <textarea class="form-control push-down-10" name="txtDescripcionAmbito" id="txtDescripcionAmbito" rows="4" placeholder="Su texto aquí..."></textarea>                            

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
                                <a id="btnGuardarAmbito" class="btn btn-primary pull-right">Guardar Ambito <span class="fa fa-floppy-o fa-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODALS -->    

                <!-- MODALS -->        
                <div class="modal" id="modalAlcance" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="defModalHead">Agregar alcance</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="block">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <label class="col lg-3 col-md-3 col sm-3 col xs-12 control-label">Descripcion</label>
                                                    <div class="col lg-6 col-md-6 col sm-6 col xs-12">
                                                        <textarea class="form-control push-down-10" id="txtDescripcionalcance" rows="4" placeholder="Su texto aquí..."></textarea>                            
                                                    </div> 
                                                </div>
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


    /////////////////////////////////////////////////////////////////////////////
//inicio de la funcion para validar el formulario de crear  objetivos///
//////////////////////////////////////////////////////////////////////////////
$(document).ready(function(){
    //tap para agregar objetivos estrategicos
    tableObjetivosambitos = $("#datatableAmbitosObjetivos").DataTable({
            "lengthMenu": [ 5, 10],
            "language" : {
                "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
            },
            "autoWidth": false,
            "order": [], //Initial no order
            "processing" : true,
            "serverSide": true,
            "ajax": {
                "url": '{{ url("/proyectos/datatableAmbitoObjetivo") }}',
                "type": "post",
                "data": function (d){
                    d.idobjetivo = $("input[name=idobjetivo]").val();
                    d._token = $("input[name=_token]").val();
                }
            },
            "columnDefs": [{ targets: [3], "orderable": false}],
            "columns": [
                {width: '8%',data: 'IDAMBITOINFLUENCIA'},
                {width: '8%',data: 'DESCRIPCION'},
                {width: '70%',data: 'NOMBREAMBITO'},
                {width: '14%',data: 'action', name: 'action', orderable: false, searchable: false},
            
            ]
        });
    //end tap para agregar objetivos estrategicos
                        $("#btnAgregarAmbito").on("click",function(){
                            IDAMBITOINFLUENCIA = $("input[name=idobjetivo]").val();
                            if(IDAMBITOINFLUENCIA > 0){
                                $('#modalAmbito').modal('show')
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
                        $("#btnAgregarAlcance").on("click",function(){
                            IDPROYECTO = $("input[name=idobjetivo]").val();
                            if(IDPROYECTO > 0){
                                $('#modalAlcance').modal('show')
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


    //variables para el wizard
    $("#btnGuardarObjetivo").on("click",function(){
        datos = $("#formObjetivos").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtLiteral: {
                    required: true,
                    
                    maxlength:2
        
                },
                txtDescripcion: {
                    required: true,
                },
                txtAlcance: {
                    required: true,
                    
                },
                slidcatalogo : {
                    required: true,
                }
                
            },
            messages: {
                txtLiteral: {
                    required: "El campo literal de objetivo es requerido",
                    
                    maxlength: "El campo literal no puede contener mas de 2 caracteres"
                   
                },
                txtDescripcion: {
                    required: "El campo descripcion de objetivo es requerido",
                },
                txtAlcance: {
                    required: "El campo alcance es requerido",
                    
                },
                slidcatalogo: {
                    required: "Seleccione un proyecto",
                    
                    
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
            $("#formObjetivos").submit();
        }
    });
    
   
    //ajax guardar informacion proyecto
        $("#formObjetivos").on("submit", function(e) {     
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
                        $("input[name=idobjetivo]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Objetivo creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Objetivo actualizado con exito', layout: 'topRight', type: 'success'});
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
    //end ajax


//////////////////////////////////////////////////////
//FUNCION PARA AGREGAR Y VALIDAR AMBITO DE OBJETIVOS//
/////////////////////////////////////////////////////
 //variables para el wizard
 $("#btnGuardarAmbito").on("click",function(){
        datos = $("#formAmbito").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                
                txtDescripcionAmbito: {
                    required: true,                
            }
            },
            messages: {
               
                txtDescripcionAmbito: {
                    required: "El campo descripcion de Ambito es requerido",
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
            $("#formAmbito").submit(); 
        }
        
    })
    
   
    //ajax guardar informacion proyecto
        $("#formAmbito").on("submit", function(e) {
            var idobjetivo = $("input[name=idobjetivo]").val();
            var txtDescripcionAmbito =   $("#txtDescripcionAmbito").val();
            var _token = $("input[name=_token]").val();
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: {idobjetivo:idobjetivo, txtDescripcionAmbito:txtDescripcionAmbito, _token:_token },
                dataType : 'json',
                beforeSend : function(){
                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                },
                success : function(data){
                    if(data.respuesta == 'ok'){
                        $("input[name=idambitoinfluencia]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Ambito creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Ambito actualizado con exito', layout: 'topRight', type: 'success'});
                        }
                        tableObjetivosambitos.ajax.reload();
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
    //end ajax

});
////////////////////////////////
//FUNCION PARA AGREGAR ALCANCE//
///////////////////////////////

$(document).ready(function(){
    //variables para el wizard
    $("#btnGuardrAlcance").on("click",function(){
        datos = $("#formAlcance").validate({
            ignore: ":hidden:not(select)",
            rules: {
                txtDescripcionalcance: {
                    required: true,
                    maxlength:15                   
                },
                slLiteral:{
                    required:true,
                }
                
            },
            messages: {
                txtDescripcionalcance: {
                    required: "El campo descripcion es requerido",
                    maxlength: "El campo descripcion no puede contener mas de 15 caracteres"
                   
                },
               
                slLiteral: {
                    required: "El campo Literal es requerido", 
                    
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
            $("#formAlcance").submit();
        }
    });
    
   
    //ajax guardar informacion proyecto
        $("#formAlcance").on("submit", function(e) {     
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
                        $("input[name=idalcance]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Alcance creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Alcance actualizado con exito', layout: 'topRight', type: 'success'});
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
    //end ajax
});




</script>         

@endpush('PageScript')
@endsection('principal')