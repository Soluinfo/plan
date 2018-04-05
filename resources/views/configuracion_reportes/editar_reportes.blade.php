@extends('master')
@section('title','Editar Reporte')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/configurar/reportes')}}">Reporte</a></li>
                    <li class="active">Editar Reporte</li>
                </ul>
             <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                <h2><span class="fa fa-arrow-circle-o-left"></span> Editar Reporte</h2>
            </div>
            <!-- END PAGE TITLE --> 
            <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default tabs">
                            <!--<div id="crearob" class="wizard">--> 
                                                     
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-catalogo" role="tab" data-toggle="tab">Editar Reporte</a></li>
                                
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-indicador">
                                {!! Form::open(['url' => 'actualizar/reportes', "name" => "formReporte", "id" => "formReporte","class" => "form-horizontal", "role" => "form"])!!}
                                <p aling="justify">En esta interfaz se podrá crear Catalogos para los objetivos.</p>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Titulo Reporte</label>
                                            <div class="col-md-6 col-xs-12">                                            
                                                <input type="text" class="form-control" name="txtDescripcion" value="<?php if(isset($encabezado1)){echo $encabezado1;} ?>"/>
                                            </div>
                                        </div> 

                                      
                                        {{ csrf_field() }}
                                        <input type="hidden" name="idreporte" value="{{ $idconfiguracionreporte or '0'}}"/>
                                        
                                    </form>
                                    <button id="btnActualizarReporte" class="btn btn-primary pull-right">Actualizar Reporte<span class="fa fa-floppy-o fa-right"></span></button>

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
$("#btnActualizarReporte").on("click",function(){
        datos = $("#formReporte").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
               
                txtDescripcion: {
                    required: true,
                }
               
               
                
            },
            messages: {
                
                txtDescripcion: {
                    required: "El campo descripcion de indicador es requerido",
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
            $("#formReporte").submit();
        }
    });
    $("#formReporte").on("submit", function(e) {     
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
                        $("input[name=idreporte]").val(data.codigo);
                        if(data.transaccion == 'actualizar'){
                            noty({text: 'Reporte actualizado con exito', layout: 'topRight', type: 'success'});
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