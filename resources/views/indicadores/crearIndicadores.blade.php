@extends('master')
@section('title','Crear Indicadores')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/indicadores')}}">Indicadores</a></li>
                    <li class="active"> Crear Indicadores</li>
                </ul>
             <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                <h2><span class="fa fa-arrow-circle-o-left"></span>Formulario de indicadores</h2>
            </div>
            <!-- END PAGE TITLE --> 
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default tabs">
                            <!--<div id="crearob" class="wizard">--> 
                                                     
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-catalogo" role="tab" data-toggle="tab">Crear Indicador</a></li>
                                
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-indicador">
                                {!! Form::open(['url' => 'crearindicadores/guardar', "name" => "formIndicador", "id" => "formIndicador","class" => "form-horizontal", "role" => "form"])!!}
                                <p aling="justify">En esta interfaz se podrá crear indicadores.</p>

                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Literal</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">                                                                                                                                                        
                                                <input type="text" class="form-control" name="txtLiteral" placeholder="Ejemplo A" value="<?php if(isset($LITERAL)){echo $LITERAL;} ?>"/>                                                    
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Descripcion</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">                                            
                                                <input type="text" class="form-control" name="txtDescripcion" value="<?php if(isset($DESCRIPCIONINDICADOR)){echo $DESCRIPCIONINDICADOR;} ?>"/>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Seleccione el Catalogo de Indicador</label>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                
                                                <select class="form-control select" name="slidcatalogo" data-live-search="true">
                                                    <option value="">seleccione Catalogo</option>
                                                    @foreach($catalogoindicadores as $d)
                                                        @if(isset($IDCATALOGOINDICADORES))
                                                            @if($IDCATALOGOINDICADORES == $d->IDCATALOGOINDICADORES)
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
                                        {{ csrf_field() }}
                                        <input type="hidden" name="idindicador" value="{{ $IDINDICADORES or '0'}}"/>
                                        
                                    </form>
                                    <a href="{{ url('/crearindicadores') }}" class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Nuevo Indicador<span class="fa fa-plus fa-right"></span></a>
                                    <button id="btnGuardarCatalogo" class="btn btn-primary col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right"><?php if(isset($IDINDICADORES)){echo"Actualizar Indicador";}else{echo "Guardar Indicador";} ?><span class="fa fa-floppy-o fa-right"></span></button>

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
        datos = $("#formIndicador").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtLiteral: {
                    required: true,
                    
                    maxlength:2
        
                },
                txtDescripcion: {
                    required: true,
                },
               
                slidcatalogo : {
                    required: true,
                }
                
            },
            messages: {
                txtLiteral: {
                    required: "El campo literal de indicador es requerido",
                    
                    maxlength: "El campo literal no puede contener mas de 2 caracteres"
                   
                },
                txtDescripcion: {
                    required: "El campo descripcion de indicador es requerido",
                },
               
                slidcatalogo: {
                    required: "Seleccione un catalogo de indicadores",
                    
                    
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
            $("#formIndicador").submit();
        }
    });
    $("#formIndicador").on("submit", function(e) {     
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
                        $("input[name=idindicador]").val(data.codigo);
                        if(data.transaccion == 'guardar'){
                            $("#btnGuardarCatalogo").html("Actualizar Catalogo");
                            noty({text: 'Indicador creado con exito', layout: 'topRight', type: 'success'});
                        }else{
                            noty({text: 'Indicador actualizado con exito', layout: 'topRight', type: 'success'});
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