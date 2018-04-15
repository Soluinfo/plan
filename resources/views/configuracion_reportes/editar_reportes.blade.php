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
                                <li class="active"><a href="#tab-reporte" role="tab" data-toggle="tab">Editar Reporte</a></li>
                                <li><a href="#tab-firmas" role="tab" data-toggle="tab">Agregar Firmas</a></li>
                                
                            </ul>
                            <div class="panel-body tab-content">
                                <div class="tab-pane active" id="tab-reporte">
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

                                <div class="tab-pane" id="tab-firmas">
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
                    <div class="panel-footer"> 
                                                                        
                    </div>
                </div>
            </div>
            <div class="modal" id="modalResponsable" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="defModalHead">Agregar Firmas</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group" data-hover="tooltip" data-placement="left" data-original-title="Campo obligatorio" >
                                        <label for="selectpersonal" class="control-label">* Personal :</label>
                                        <select class="selectpicker form-control" data-live-search="true" id="selectpersonal" name="selectpersonal">
                                            <option value="0">Seleccione personal</option>
                                                @foreach($supervisores as $s)
                                                    
                                                    <option data-content="<span class='label label-danger'><?php echo $s->NOMBRE_EPL.' '.$s->APELLIDO_EPL;?></span>" value="<?php echo $s->SERIAL_EPL?>"></option>
                                                    @endforeach
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="txt_titulo" class="control-label">* Título o Cargo :</label>
                                        <input class="form-control" name="txt_titulo" id="txt_titulo" type="text" placeholder="Ejemplo : COORDINADOR GENERAL" data-hover="tooltip" data-placement="left" data-original-title="Campo obligatorio"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="txt_descripcion" class="control-label">* Descripcion :</label>
                                        <input class="form-control" name="txt_descripcion" id="txt_descripcion" type="text" placeholder="Ejemplo : ENCARGADO DE FINANZAS" data-hover="tooltip" data-placement="left" data-original-title="Campo obligatorio"/><br>
                                    </div>
                                </div>
                                <button id="btnActualizarReporte" class="btn btn-primary pull-right">Agregar<span class="fa fa-floppy-o fa-right"></span></button>

                            </div> 
                              
                        </div>
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
 //tap para agregar responsable a la actividad
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
        $("#btnAgregarResponsable").on("click",function(){
        IDACTIVIDAD = $("input[name=idreporte]").val();
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