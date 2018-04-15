@extends('master')
@section('title','Crear Catalogo')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/catalogoObjetivos')}}">Catalogo de objetivos</a></li>
                    <li class="active">Crear Catalogo de Objetivos</li>
                </ul>
             <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                <h2><span class="fa fa-arrow-circle-o-left"></span> Crear catalogo</h2>
            </div>
            <!-- END PAGE TITLE --> 
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default tabs">
                            <!--<div id="crearob" class="wizard">--> 
                                                     
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-catalogo" role="tab" data-toggle="tab">Crear Catalogo de Objetivos</a></li>
                                
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-catalogo">
                                {!! Form::open(['url' => 'crearcatalogo/guardar', "name" => "formCatalogo", "id" => "formCatalogo","class" => "form-horizontal", "role" => "form"])!!}
                                <p aling="justify">En esta interfaz se podrá crear Catalogos para los objetivos.</p>

                                        <div class="form-group">
                                            <label class="col-sm-3 col-md-3 control-label">Nombre de catálogo</label>
                                            <div class="col-sm-6 col-md-6">
                                                <input type="text" class="form-control" name="txtnombre" placeholder="Catalogo de Objetivos" value="<?php if(isset($NOMBRE)){echo $NOMBRE;} ?>"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha creacion</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="dpFecha" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHA)){echo $FECHA;} ?>"/>
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-lg-3 control-label">Estado</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control select" name="slEstado"/>
                                                <option value="">Seleccione estado</option>
                                                        @if( isset($ESTADO))
                                                            @if($ESTADO == 1)
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
                                        {{ csrf_field() }}
                                        <input type="hidden" name="idcatalogoobjetivo" value="{{ $IDCATALOGOOBJETIVO or '0'}}"/>
                                        
                                    </form>
                                    <a href="{{ url('/crearcatalogo') }}" class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Nuevo Catalogo<span class="fa fa-plus fa-right"></span></a>
                                    <button id="btnGuardarCatalogo" class="btn btn-primary col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right"><?php if(isset($IDCATALOGOOBJETIVO)){ echo "Actualizar Catalogo";}else{ echo "Guardar Catalogo";} ?><span class="fa fa-floppy-o fa-right"></span></button>

                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer"> 
                                                                        
                    </div>
                </div>
            </div>
         
                                        
           
            

                
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

//variables para el wizard
$("#btnGuardarCatalogo").on("click",function(){
        datos = $("#formCatalogo").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtnombre: {
                    required: true,
                    
                    maxlength: 250
                },
                dpFecha: {
                    required: true,
                },
                slEstado : {
                    required: true
                }
            },
            messages: {
                txtnombre: {
                    required: "El campo nombre de Catalogo es requerido",
                   
                    maxlength: "El campo nombre de Catalogo no puede contener mas de 25 caracteres"
                },
                dpFecha : {
                    required: "El campo fecha es requerido"
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
            $("#formCatalogo").submit();
        }
    });
    $("#formCatalogo").on("submit", function(e) {     
            e.preventDefault();
            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: $(this).serialize(),
                dataType : 'json',
                beforeSend : function(){
                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                    $('body').loadingModal('show');
                    $('body').loadingModal('text', 'Guardando Catalogo de objetivos...');
                },
                success : function(data){
                    if(data.respuesta == 'ok'){
                        $("input[name=idcatalogoobjetivo]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Catalogo creado con exito', layout: 'topRight', type: 'success'});
                            $("#btnGuardarCatalogo").html("Actualizar Catalogo");
                        }else{
                            noty({text: 'Catalogo actualizado con exito', layout: 'topRight', type: 'success'});
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
    
    </script>         

@endpush('PageScript')
@endsection('principal')