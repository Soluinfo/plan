@extends('master')
@section('title','Crear Catalogo Indicadores')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/catalogoindicadores')}}">Catalogo de Indicadores</a></li>
                    <li class="active">Crear objetivo</li>
                </ul>
             <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                <h2><span class="fa fa-arrow-circle-o-left"></span>Crear catalogo de Indicadores</h2>
            </div>
            <!-- END PAGE TITLE --> 
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default tabs">
                            <!--<div id="crearob" class="wizard">--> 
                                                     
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-catalogo" role="tab" data-toggle="tab">Crear Catalogo de Indicadores</a></li>
                                
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-catalogo">
                                {!! Form::open(['url' => 'crearcatalogoindicador/guardar', "name" => "formCatalogoIndicador", "id" => "formCatalogoIndicador","class" => "form-horizontal", "role" => "form"])!!}
                                <p aling="justify">En esta interfaz se podrá crear Catalogos para los objetivos.</p>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nombre de catálogo de indicadores</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="txtnombreIndicador" placeholder="Catalogo de Indicadores"value="<?php if(isset($NOMBRE)){echo $NOMBRE;} ?>"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha creacion</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="dpFechaIndicador" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHA)){echo $FECHA;} ?>"/>
                                            </div>
                                        </div>  

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Estado</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control select" name="slEstadoIndicador">
                                                    <option value="">Seleccione un estado</option>
                                                    @if( isset($ESTADO))
                                                    @if($ESTADO == 1)
                                                    <option selected="selected" value="1">PENDIENTE</option>
                                                    <option value="2">APROBADO</option>
                                                    @else
                                                    <option value="1">PENDIENTE</option>
                                                    <option selected="selected" value="2">APROBADO</option>
                                                    @endif
                                                    @else
                                                    <option value="1">PENDIENTE</option>
                                                    <option value="2">APROBADO</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        {{ csrf_field() }}
                                        <input type="hidden" name="idcatalogoindicadores" value="{{ $IDCATALOGOINDICADORES or '0'}}"/>
                                        
                                    </form>
                                    <a href="{{ url('/catalogo/crear') }}" class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Nuevo Catalogo<span class="fa fa-plus fa-right"></span></a>
                                    <button id="btnGuardarIndicador" class="btn btn-primary pull-right">Guardar Catalogo<span class="fa fa-floppy-o fa-right"></span></button>

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
$("#btnGuardarIndicador").on("click",function(){
        datos = $("#formCatalogoIndicador").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtnombreIndicador: {
                    required: true,
                    
                    maxlength: 55
                },
                dpFechaIndicador: {
                    required: true,
                },
                slEstadoIndicador : {
                    required: true
                }
            },
            messages: {
                txtnombreIndicador: {
                    required: "El campo nombre de Catalogo es requerido",
                   
                    maxlength: "El campo nombre de Catalogo no puede contener mas de 55 caracteres"
                },
                dpFechaIndicador : {
                    required: "El campo fecha es requerido"
                },
                slEstadoIndicador: {
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
            $("#formCatalogoIndicador").submit();
        }
    });
    $("#formCatalogoIndicador").on("submit", function(e) {     
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
                        $("input[name=idcatalogoindicadores]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            noty({text: 'Catalogo creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Catalogo actualizado con exito', layout: 'topRight', type: 'success'});
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
    
    </script>         

@endpush('PageScript')
@endsection('principal')