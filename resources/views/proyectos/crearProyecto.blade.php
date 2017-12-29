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
                <button data-toggle="modal" data-target="#modalObjetivo" class="btn btn-default" >ejecutar funcion</button>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <!-- START WIZARD WITH VALIDATION -->
                            <div class="block">
                                <div id="wizarProyecto" class="wizard">
                                    <ul>
                                        <li>
                                            <a href="#step-7">
                                                <span class="stepNumber">1</span>
                                                <span class="stepDesc">Paso 1<br /><small>Informacion</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-8">
                                                <span class="stepNumber">2</span>
                                                <span class="stepDesc">Paso 2<br /><small>Objetivos</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-9">
                                                <span class="stepNumber">3</span>
                                                <span class="stepDesc">Paso 3<br /><small>Miembros</small></span>
                                            </a>
                                        </li>                                  
                                    </ul>

                                    <div id="step-7"> 
                                    {!! Form::open(['url' => 'proyectos/guardar', "name" => "formProyecto", "id" => "formProyecto","class" => "form-horizontal", "role" => "form"]) !!}
                                        
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Nombre de proyecto :</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" class="form-control" name="txtnombreProyecto" placeholder="Ejemplo: Proyecto 2017"/>
                                                    
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha :</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="dpFechaProyecto" class="form-control datepicker" placeholder="aaaa-mm-dd">
                                                </div>
                                            </div>            
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Estado :</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                            
                                                    <select class="form-control select" name="slEstado">
                                                        <option value="">Seleccione estado</option>
                                                        <option value="1">ACTIVO</option>
                                                        <option value="2">INACTIVO</option>
                                                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Departamento</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                
                                                    <select class="form-control select" name="slDepartamento" data-live-search="true">
                                                        <option value="">seleccion departamento</option>
                                                        @foreach($departamento as $d)
                                                            <option value="{{$d->SERIAL_DEP}}">{{$d->DESCRIPCION_DEP}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{ csrf_field() }}
                                            <input type="text" name="idproyecto" value="0">
                                            
                                        </form>
                                    </div>

                                    <div id="step-8">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalObjetivo">Agregar objetivo</button>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- START RESPONSIVE TABLES -->
                                                    <div class="panel panel-default">

                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Responsive tables</h3>
                                                        </div>

                                                        <div class="panel-body panel-body-table">

                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped table-actions">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="50">id</th>
                                                                            <th>name</th>
                                                                            <th width="100">status</th>
                                                                            <th width="100">amount</th>
                                                                            <th width="100">date</th>
                                                                            <th width="100">actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>                                            
                                                                        <tr id="trow_1">
                                                                            <td class="text-center">1</td>
                                                                            <td><strong>John Doe</strong></td>
                                                                            <td><span class="label label-success">New</span></td>
                                                                            <td>$430.20</td>
                                                                            <td>24/09/2014</td>
                                                                            <td>
                                                                                <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                                                                <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr id="trow_2">
                                                                            <td class="text-center">2</td>
                                                                            <td><strong>Dmitry Ivaniuk</strong></td>
                                                                            <td><span class="label label-warning">Pending</span></td>
                                                                            <td>$1,351.00</td>
                                                                            <td>23/09/2014</td>
                                                                            <td>
                                                                                <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                                                                <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_2');"><span class="fa fa-times"></span></button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr id="trow_3">
                                                                            <td class="text-center">3</td>
                                                                            <td><strong>Nadia Ali</strong></td>
                                                                            <td><span class="label label-info">In Queue</span></td>
                                                                            <td>$2,621.00</td>
                                                                            <td>22/09/2014</td>
                                                                            <td>
                                                                                <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                                                                <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_3');"><span class="fa fa-times"></span></button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>                                

                                                        </div>
                                                    </div> 
                                                <!-- END RESPONSIVE TABLES --> 
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div id="step-9">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalSupervisor">Agregar supervisor</button>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- START RESPONSIVE TABLES -->
                                                    <div class="panel panel-default">

                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Lista de asignaciones</h3>
                                                        </div>

                                                        <div class="panel-body panel-body-table">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered table-striped table-actions datatable">
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
                            <!-- END WIZARD WITH VALIDATION -->
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
                    

                    function obtenerSupervisoresDeProyecto(){
                        IDPROYECTO = $("input[name=idproyecto]").val();
                        _token = $("input[name=_token]").val();
                        console.log('entro a funcion');
                        $.post("{{ url('/proyectos/obtenerSupervisoresProyectos') }}",{IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                           $("#tablaasignacion").html(data);
                        });
                    }

                    function asignarSupervisor(IDSUPERVISOR){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            _token = $("input[name=_token]").val();
                            
                            $.post("{{ url('/proyectos/asignarSupervisorProyecto') }}",{IDPROYECTO:IDPROYECTO,IDSUPERVISOR:IDSUPERVISOR,_token:_token},function(data){
                                
                                var data2 = JSON.parse(data);
                                
                                if(data2.respuesta == 'ok'){
                                    noty({text: data2.mensaje, layout: 'topRight', type: 'success'});
                                    obtenerSupervisoresDeProyecto();
                                }else if(data2.respuesta == 'existe'){
                                    noty({text: data2.mensaje , layout: 'topRight', type: 'warning'});
                                }else{
                                    console.log(data2.respuesta);
                                    noty({text: '!Error: Fallo la transaccion', layout: 'topRight', type: 'error'});
                                }
                            });
                    }
               
                    $(document).ready(function(){
                        table = $("#datatableObjetivos").dataTable({

                        });
                       
                        $("#slcatalogo").on("change",function(){
                            $.mpb('show',{value: [0,40],speed: 10,state: 'info'});
                            $("#slcatalogo option:selected").each(function(){
                                idcatalogo = $("#slcatalogo").val();
                                _token = $("input[name=_token]").val();
                                $.post("{{ url('/proyectos/obtenerObjetivos') }}",{idcatalogo:idcatalogo,_token:_token},function(data){
                                    $("#tablaObjetivoSeleccionar").html(data);
                                    table = $("#datatableObjetivos").dataTable({

                                    });
                                })
                            })
                            $.mpb('show',{value: [40,100],speed: 10,state: 'info'});
                        })
                        $("#wizarProyecto").smartWizard({
                            labelNext : lbnext, 
                            labelPrevious:'Anterior', // label for Previous button
                            labelFinish:'Finalizar',  // label for Finish button                   
                            // This part of code can be removed FROM
                            onLeaveStep: leaveAStepCallback,// <-- TO
                        });
                        //variables para el wizard
                            var datos;
                            var lbnext = 'Guardar|siguiente';
                            var lbprevious = 'Anterior';
                            var lbfinal = 'Finalizar'
                        //end variable
                        //Inicio de funcion leaveAStepCallback para obtener el numero de step 
                            function leaveAStepCallback(obj){
                                var step_num= obj.attr('rel');
                                return validateSteps(step_num);
                            }
                        //End de funcion leaveAStepCallback
                       
                        //ajax guardar informacion proyecto
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
                        //end ajax
                        //validacion del paso 1 informacion general
                        
                        function validateStep1(){ 
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
                           
                            return datos.form();
                           
                        }
                        //validacion del paso 2 agregar objetivos
                        function validateStep3(){
                            return false;
                        }
                        //funcion que valida en que paso se encuentra
                        function validateSteps(step){
                            var isStepValid = true;
                            // validate step 1
                            if(step == 1){
                                if(validateStep1() == false ){
                                    isStepValid = false; 
                                    
                                }else{
                                    $("#formProyecto").submit(); 
                                }
                            }
                        
                           
                            
                            return isStepValid;
                        }
                        
                        if($("#idproyecto").val() > 0){
                            var lbnext = 'Actualizar|siguiente';
                        }else{
                            
                        }
                        
                         
                    });
                    
                </script>
                @endpush('PageScript')
@endsection('principal')