@extends('master')
@section('title','Crear Objetivos')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/objetivos')}}">Panel de objetivos</a></li>
                    <li class="active">Crear objetivo</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
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
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Literal</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">                                                                                                                                                        
                                                <input type="text" class="form-control" name="txtLiteral" placeholder="Ejemplo A" value="<?php if(isset($LITERAL)){echo $LITERAL;} ?>"/>                                                    
                                            </div>
                                        </div>

                                       

                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Descripcion</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">                                            
                                                <input type="text" class="form-control" name="txtDescripcion" value="<?php if(isset($DESCRIPCION)){echo $DESCRIPCION;} ?>"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Seleccione el Catalogo</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                
                                                <select class="form-control select" name="slidcatalogo" data-live-search="true">
                                                    <option value="">seleccion catalogo</option>
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
                                        <input type="hidden" name="idobjetivo" value="{{ $IDOBJETIVOESTRATEGICO or '0'}}"/>
                                    </form>
                                    <a href="{{ url('/crearobjetivos') }}" class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Nuevo Objetivo<span class="fa fa-plus fa-right"></span></a>

                                    <button id="btnGuardarObjetivo" class="btn btn-primary col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right"><?php if(isset($IDOBJETIVOESTRATEGICO)){ echo "Actualizar Objetivo";}else{ echo "Guardar Objetivo";} ?><span class="fa fa-floppy-o fa-right"></span></button>

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
                                        <th>Objetivo</th>
                                        <th>Nombre de Ambito</th>
                                        <th width="100">Accion</th>
                                    </tr>

                                    @endcomponent
                                    
                                </div>

                                <div class="tab-pane" id="tab-alcance">
                                        
                                    <button id="btnAgregarAlcance" class="btn btn-block btn-primary col-md-4"><span class="fa fa-plus"></span>Agregar Alcance</button>
                                    @component('componentes.dataTable')
                                        @slot('titleComponent')
                                        Alcance del objetivo estrategicos
                                        @endslot
                                        @slot('idcomponent')
                                        datatableAlcanceObjetivos
                                        @endslot
                                        <tr>
                                        <th width="50">id</th>
                                        <th>Objetivo</th>
                                        <th>Nombre de Alcance</th>
                                        <th width="100">Accion</th>
                                    </tr>

                                    @endcomponent
                                    
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
                                            {!! Form::open(['url' => 'alcance/guardaralcance', "name" => "formAlcance", "id" => "formAlcance","class" => "form-horizontal", "role" => "form"])!!}

                                                <div class="form-group">
                                                    <label class="col lg-3 col-md-3 col sm-3 col xs-12 control-label">Descripcion</label>
                                                    <div class="col lg-6 col-md-6 col sm-6 col xs-12">
                                                        <textarea class="form-control push-down-10" name="txtDescripcionAlcance"  id="txtDescripcionAlcance" rows="4" placeholder="Su texto aquí..."></textarea>                            
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
                                <a id="btnGuardarAlcance" class="btn btn-primary pull-right">Guardar Alcance <span class="fa fa-floppy-o fa-right"></span></a>

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
 
 //Funcion para eliminar el ambito de influencia en la opcion de editar objetivos
            function eliminarAmbito(IDAMBITOINFLUENCIA){
                            _token = $("input[name=_token]").val();
                            noty({
                                text: 'Esta seguro que desea eliminar el ambito de influencia del objetivo?',
                                layout: 'topRight',
                                buttons: [
                                        {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                            $noty.close();
                                            $.post("{{ url('/objetivos/eliminarAmbitoObjetivos') }}",{IDAMBITOINFLUENCIA:IDAMBITOINFLUENCIA,_token:_token},function(data){
                                                if(data == 'eliminado'){
                                                    noty({text: 'El ambito de influencia a sido eliminado del proyecto', layout: 'topRight', type: 'success'});
                                                    tableObjetivosambitos.ajax.reload();
                                                }else{
                                                    noty({text: 'Lo sentimos, no se elimino el ambito de influencia intenta nuevamente', layout: 'topRight', type: 'error'});
                                                }
                                            })
                                            
                                            
                                        }
                                        },
                                        {addClass: 'btn btn-danger btn-clean', text: 'Cancelar', onClick: function($noty) {
                                            $noty.close();
                                            noty({text: 'Eliminacion cancelada', layout: 'topRight', type: 'error'});
                                            }
                                        }
                                    ]
                            })
                            
                        }
                    //Fin de la Funcion para eliminar el ambito de influencia en la opcion de editar objetivos

                     //Funcion para eliminar el alcance de objetivos en la opcion de editar objetivos
                        function eliminarAlcance(IDALCANCE){
                            _token = $("input[name=_token]").val();
                            noty({
                                text: 'Esta seguro que desea eliminar el alcance del objetivo?',
                                layout: 'topRight',
                                buttons: [
                                        {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                            $noty.close();
                                            $.post("{{ url('/objetivos/eliminarAlcanceObjetivos') }}",{IDALCANCE:IDALCANCE,_token:_token},function(data){
                                                if(data == 'eliminado'){
                                                    noty({text: 'El alcance a sido eliminado del proyecto', layout: 'topRight', type: 'success'});
                                                    tableObjetivosalcance.ajax.reload();
                                                }else{
                                                    noty({text: 'Lo sentimos, no se elimino el alcance intenta nuevamente', layout: 'topRight', type: 'error'});
                                                }
                                            })
                                            
                                            
                                        }
                                        },
                                        {addClass: 'btn btn-danger btn-clean', text: 'Cancelar', onClick: function($noty) {
                                            $noty.close();
                                            noty({text: 'Eliminacion cancelada', layout: 'topRight', type: 'error'});
                                            }
                                        }
                                    ]
                            })
                            
                        }
                //Fin de la Funcion para eliminar el alcance de objetivos en la opcion de editar objetivos    

//inicio de la funcion para validar el formulario de crear  objetivos///

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
            "url": '{{ url("/objetivos/datatableAmbitosObjetivo") }}',
            "type": "post",
            "data": function (d){
                d.idobjetivo = $("input[name=idobjetivo]").val();
                d._token = $("input[name=_token]").val();
            }
        },
        "columnDefs": [{ targets: [3], "orderable": false}],
        "columns": [
            {width: '8%',data: 'IDAMBITOINFLUENCIA'},
            {width: '40%',data: 'DESCRIPCION'},
            {width: '38%',data: 'NOMBREAMBITO'},
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
                    //tap para agregar objetivos estrategicos
                    tableObjetivosalcance = $("#datatableAlcanceObjetivos").DataTable({
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
                            "columnDefs": [{ targets: [3], "orderable": false}],
                            "columns": [
                                {width: '8%',data: 'IDALCANCE'},
                                {width: '40%',data: 'DESCRIPCION'},
                                {width: '38%',data: 'DESCRIPCIONALCANCE'},
                                {width: '14%',data: 'action', name: 'action', orderable: false, searchable: false},
                            
                            ]
                        });
                    //end tap para agregar objetivos estrategicos
                        $("#btnAgregarAlcance").on("click",function(){
                            IDALCANCE = $("input[name=idobjetivo]").val();
                            if(IDALCANCE > 0){
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
    
   
    //ajax guardar informacion objetivo
        $("#formObjetivos").on("submit", function(e) {     
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                dataType : 'json',
                beforeSend : function(){
                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                    $('body').loadingModal('show');
                    $('body').loadingModal('text', 'Guardando Objetivo...');
                },
                success : function(data){
                    if(data.respuesta == 'ok'){
                        $("input[name=idobjetivo]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            $("#btnGuardarObjetivo").html('Actualizar Objetivo');
                            noty({text: 'Objetivo creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Objetivo actualizado con exito', layout: 'topRight', type: 'success'});
                        }
                       
                        
                    }
                    $('body').loadingModal('hide');
                    $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                    $.mpb('destroy');
                },
                error : function(xhr,estado){
                    $('body').loadingModal('hide');
                    if(xhr.status == 500){
                        noty({text: 'Error: falló conexión, intente de nuevo', layout: 'topRight', type: 'error'});
                    }
                    console.log("!Error "+xhr.status+", reportelo al centro de computo");
                    $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                    $.mpb('destroy');
                    
                    
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

        //ALCANCE 

    
//end ajax

//variables para el wizard
$("#btnGuardarAlcance").on("click",function(){
       datos = $("#formAlcance").validate({
           ignore: ":hidden:not(select)",
           
           rules: {
               
               txtDescripcionAlcance: {
                   required: true,                
           }
           },
           messages: {
              
               txtDescripcionAlcance: {
                   required: "El campo descripcion de Alcance es requerido",
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
           $("#formAlcance").submit(); 
       }
       
   })
   
  
   //ajax guardar informacion proyecto
       $("#formAlcance").on("submit", function(e) {
           var idobjetivo = $("input[name=idobjetivo]").val();
           var txtDescripcionAlcance =   $("#txtDescripcionAlcance").val();
           var _token = $("input[name=_token]").val();
           e.preventDefault();
           $.ajax({
               url: $(this).attr("action"),
               type: $(this).attr("method"),
               data: {idobjetivo:idobjetivo, txtDescripcionAlcance:txtDescripcionAlcance, _token:_token },
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
                       tableObjetivosalcance.ajax.reload();
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

       //ALCANCE 

   
//end ajax

});
    








    </script>         

@endpush('PageScript')
@endsection('principal')