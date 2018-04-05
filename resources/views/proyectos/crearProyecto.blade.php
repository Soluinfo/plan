@extends('master')
@section('title','Crear proyecto')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    <li><a href="{{ url('/proyectos')}}">Portafolio de proyectos</a></li>
                    <li class="active">Crear proyecto</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Crear proyecto</h2>
                   
                </div>
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="progress">
                                <div id="progresoinformacion" class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="{{$PROGRESODECREACION or 0}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$PROGRESODECREACION or 0}}%">Informacion de proyecto {{$PROGRESODECREACION or 0}}%</div>
                            </div>
                        </div>
                                                
                    </div>
                </div>
               
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default tabs">                            
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-informacion" role="tab" data-toggle="tab">Información</a></li>
                                    <li><a href="#tab-fecha" role="tab" data-toggle="tab">Fechas</a></li>
                                    <li><a href="#tab-objetivo" role="tab" data-toggle="tab">Objetivos estrategicos</a></li>
                                    <li><a href="#tab-indicador" role="tab" data-toggle="tab">Indicadores</a></li>
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
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha inicial:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="dpFechaProyecto" id="dpFechaProyecto" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHAPROYECTO)){echo $FECHAPROYECTO;} ?>" <?php if(isset($IDPROYECTO)){echo 'disabled';} ?>>
                                                </div>
                                            </div>
                                            <div class="form-group">                                        
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha final:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="dpFechaFinalProyecto" id="dpFechaFinalProyecto" class="form-control datepicker" placeholder="aaaa-mm-dd" value="<?php if(isset($FECHAFINAL)){echo $FECHAFINAL;} ?>" <?php if(isset($IDPROYECTO)){echo 'disabled';} ?>>
                                                </div>
                                            </div>            
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Estado :</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">                                                                                            
                                                    <select class="form-control select" name="slEstado">
                                                        <option value="">Seleccione estado</option>
                                                        @if( isset($ESTADOPROYECTO))
                                                            @if($ESTADOPROYECTO == 1)
                                                            <option selected="selected" value="1">ABIERTO</option>
                                                            <option value="2">EN PROGRESO</option>
                                                            @else
                                                            <option value="1">ABIERTO</option>
                                                            <option selected="selected" value="2">EN PROGRESO</option>
                                                            @endif
                                                        @else
                                                        <option value="1">ABIERTO</option>
                                                        <option value="2">EN PROGRESO</option>
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
                                            <input type="hidden" name="inputprogresoInformacion" value="{{ $PROGRESODECREACION or '0'}}">
                                            
                                        </form>
                                        <a href="{{ url('/proyectos/crear') }}" class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Nuevo proyecto <span class="fa fa-plus fa-right"></span></a>
                                        <button id="btnGuardarProyecto" class="btn btn-primary col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right"><?php if(isset($IDPROYECTO)){echo 'Actualizar Proyecto';}else{ echo 'Guardar Proyecto';} ?> <span class="fa fa-floppy-o fa-right"></span></button>
                                    </div>
                                    <div class="tab-pane" id="tab-fecha">
                                        <button id="btnAgregarFecha" class="btn btn-block btn-primary col-md-4"><span class="fa fa-plus"></span>Reprogramar</button>
                                            
                                            <!-- START RESPONSIVE TABLES -->
                                            @component('componentes.dataTable')
                                                @slot('titleComponent')
                                                Fechas del proyecto
                                                @endslot
                                                @slot('idcomponent')
                                                datatableFechasProyectos
                                                @endslot
                                                <tr>
                                                    <th width="50">id</th>
                                                    <th>Fecha inicial</th>
                                                    <th>Fecha final</th>
                                                    <th>Estado</th>
                                                    <th>Observacion</th>
                                                    <th width="100">Accion</th>
                                                </tr>

                                            @endcomponent
                                            <!-- END RESPONSIVE TABLES --> 
                                    </div>
                                    <div class="tab-pane" id="tab-objetivo">

                                        <button id="btnAgregarObjetivo" class="btn btn-block btn-primary col-md-4"><span class="fa fa-plus"></span>Agregar objetivo</button>
                                        
                                        <!-- START RESPONSIVE TABLES -->
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Objetivos estrategicos del proyecto
                                            @endslot
                                            @slot('idcomponent')
                                            datatableObjetivosProyectos
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            <th>literal</th>
                                            <th>Descripcion</th>
                                            <th width="100">Accion</th>
                                            </tr>

                                        @endcomponent
                                        <!-- END RESPONSIVE TABLES --> 
                                        
                                    </div>
                                    <div class="tab-pane" id="tab-indicador">
                                        
                                        <button id="btnAgregarIndicador" class="btn btn-block btn-primary"><span class="fa fa-plus"></span>Agregar indicador</button>
                                        
                                       
                                        <!-- START RESPONSIVE TABLES -->
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Indicadores del proyecto
                                            @endslot
                                            @slot('idcomponent')
                                            datatable-indicadorProyecto
                                            @endslot
                                            <tr>
                                                <th width="50">id</th>
                                                <th width="100" >Indicador</th>
                                                <th width="100">actions</th>
                                            </tr>

                                        @endcomponent
                                        <!-- END RESPONSIVE TABLES --> 
                                    </div>
                                    <div class="tab-pane" id="tab-supervisor">
                                        <button id="btnAgregarSupervisor" class="btn btn-block btn-primary"><span class="fa fa-plus"></span>Agregar supervisor</button>
                                        <!-- START RESPONSIVE TABLES -->
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Supervisores del proyecto
                                            @endslot
                                            @slot('idcomponent')
                                            datatable-supervisorProyecto
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
                @component('componentes.mensageBox')
                    @slot('titleComponent')
                        !Alerta
                    @endslot

                    Para agregar un objetivo y un supervisor necesita registrar un proyecto

                @endcomponent
                <!-- END PAGE CONTENT WRAPPER -->
                
                <!-- MODALS -->   
                @component('componentes.modal')
                        @slot('idmodal')
                            modalprogramarProyecto
                        @endslot
                        @slot('tamanomodal')
                            modal-lg
                        @endslot
                        @slot('titulomodal')
                            Programar Proyecto
                        @endslot
                        {!! Form::open(['url' => '/proyectos/guardarFechas', "name" => "formFechas", "id" => "formFechas","class" => "form-horizontal", "role" => "form"])!!}
                            
                                        
                                <div class="form-group">                                        
                                    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha de inicio:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dpFechaInicial" id="dpFechaInicial" class="form-control datepicker" placeholder="aaaa-mm-dd" value="">
                                    </div>
                                </div>

                                <div class="form-group">                                        
                                    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Fecha final:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dpFechaFinal" id="dpFechaFinal" class="form-control datepicker" placeholder="aaaa-mm-dd" value="">
                                    </div>

                                </div>
                                <div class="form-group">                                        
                                    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Observación:</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="taobservacion" id="taobservacion" class="form-control" rows="3"></textarea>
                                    </div>

                                </div>
                                <a id="btnGuardarFechas" class="btn btn-primary pull-right">Programar fecha <span class="fa fa-floppy-o fa-right"></span></a>

                          
                        </form>
                    @endcomponent
                <!-- END MODALS -->  
                <!-- MODALS -->  
                    @component('componentes.modal')
                    @slot('idmodal')
                        modalObjetivo
                    @endslot
                    @slot('tamanomodal')
                        modal-lg
                    @endslot
                    @slot('titulomodal')
                        Agregar objetivos
                    @endslot
                                        
                    <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Seleccion catalogo :</label>
                    <select class="form-control select" name="slcatalogo" id="slcatalogo" data-live-search="true">
                        <option value="">Seleccione catalogo</option>
                        @foreach($catalogo as $c)
                            <option value="{{ $c->IDCATALOGOOBJETIVO }}">{{ $c->NOMBRE }}</option>
                        @endforeach
                    </select>
                    <div style="height:20px"></div>
                    
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
                            <tbody id="">
                                                                                
                            </tbody>
                        </table>
                    </div>   
                    

                    @endcomponent  
                    
                <!-- END MODALS --> 
                <!-- MODALS -->  
                    @component('componentes.modal')
                        @slot('idmodal')
                            modalSupervisor
                        @endslot
                        @slot('tamanomodal')
                            modal-lg
                        @endslot
                        @slot('titulomodal')
                            Agregar supervisor
                        @endslot
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
                                                        <a class="btn btn-primary btn-xs" onclick="asignarSupervisor({{$s->SERIAL_EPL}});" ><i class="fa fa-plus"></i>Agregar</a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>                                

                            </div>
                        </div>
                    @endcomponent      
                    
                <!-- END MODALS -->
                <!-- MODALS -->   
                    @component('componentes.modal')
                        @slot('idmodal')
                            modalDetalleObjetivo
                        @endslot
                        @slot('tamanomodal')
                            modal-lg
                        @endslot
                        @slot('titulomodal')
                            Informacion de objetivo2
                        @endslot
                        <div id="tablaDetalleObjetivo" class="panel-body panel-body-table">
                        </div>

                    @endcomponent
                <!-- END MODALS -->
                <!-- MODALS -->  
                    @component('componentes.modal')
                        @slot('idmodal')
                            modalIndicador
                        @endslot
                        @slot('tamanomodal')
                            modal-lg
                        @endslot
                        @slot('titulomodal')
                            Agregar indicador
                        @endslot
                                            
                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-12 control-label">Seleccion catalogo :</label>
                        <select class="form-control select" name="slcatalogoindicador" id="slcatalogoindicador" data-live-search="true">
                            <option value="">Seleccione catalogo</option>
                            @foreach($catalogoindicador as $c)
                                <option value="{{ $c->IDCATALOGOINDICADORES }}">{{ $c->NOMBRE }}</option>
                            @endforeach
                        </select>
                        <div style="height:20px"></div>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-actions" id="datatableIndicador">
                                <thead>
                                    <tr>
                                        <th width="50">id</th>
                                      
                                        <th>Descripcion</th>
                                        <th width="100">seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                                                                    
                                </tbody>
                            </table>
                        </div>   
                    

                    @endcomponent  
                    
                <!-- END MODALS -->

                @push('PageScript')
        
                <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-datepicker.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/locales/bootstrap-datepicker.es.js') }}"></script>                
               
                <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-select.js') }}"></script>
                <script type="text/javascript" src="{{ asset('js/plugins/tagsinput/jquery.tagsinput.min.js') }}"></script>
                
                <script type='text/javascript' src="{{ asset('js/plugins/noty/jquery.noty.js') }}"></script>
                <script type='text/javascript' src="{{ asset('js/plugins/noty/layouts/topCenter.js') }}"></script>
                <script type='text/javascript' src="{{ asset('js/plugins/noty/layouts/topLeft.js') }}"></script>
                <script type='text/javascript' src="{{ asset('js/plugins/noty/layouts/topRight.j') }}s"></script>

                <script type='text/javascript' src="{{ asset('js/plugins/noty/themes/default.js') }}"></script>

                <script type="text/javascript" src="{{ asset('js/plugins/smartwizard/jquery.smartWizard-2.0.min.js') }}"></script>        
                <script type="text/javascript" src="{{ asset('js/plugins/jquery-validation/jquery.validate.js') }}"></script> 

                <script type="text/javascript" src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
                <script>

                    function progresoInformacionProyecto(){
                        _token = $("input[name=_token]").val();
                        IDPROYECTO = $("input[name=idproyecto]").val();
                        PROGRESOINICIAL = $("input[name=inputprogresoInformacion]").val();
                        $.post("{{ url('/proyectos/obtenerProgresoInformacion') }}",{IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                            $("#progresoinformacion").html("Informacion de proyecto "+data+"%");
                            progresobar(PROGRESOINICIAL,data);
                            $("input[name=inputprogresoInformacion]").val(data);
                        });
                    }

                    function progresobar(PROGRESOINICIAL,data){
                        x = PROGRESOINICIAL;
                            final = data;
                            var timer;
                    
                            if(x<final){
                                x++;
                                document.getElementById('progresoinformacion').style.width=x+'%';            
                                timer=setTimeout('progresobar('+x+','+final+')',50);
                            }else{
                                clearTimeout(timer);
                                
                            }
                    }

                    function obtenerDetalleObjetivo(IDOBJETIVOESTRATEGICO){
                        _token = $("input[name=_token]").val();
                        $.post("{{ url('/objetivos/detalles') }}",{_token:_token,IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO},function(data){
                            $("#tablaDetalleObjetivo").html(data);
                        })
                        $("#modalDetalleObjetivo").modal('show');
                        
                    }
                    function asignarSupervisor(IDSUPERVISOR){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            _token = $("input[name=_token]").val();
                            
                            $.post("{{ url('/proyectos/asignarSupervisorProyecto') }}",{IDPROYECTO:IDPROYECTO,IDSUPERVISOR:IDSUPERVISOR,_token:_token},function(data){
                                
                                var data2 = JSON.parse(data);
                                
                                if(data2.respuesta == 'ok'){
                                    noty({text: data2.mensaje, layout: 'topRight', type: 'success'});
                                    tableSupervisoresProyectos.ajax.reload();
                                    progresoInformacionProyecto();
                                }else if(data2.respuesta == 'existe'){
                                    noty({text: data2.mensaje , layout: 'topRight', type: 'warning'});
                                }else{
                                    console.log(data2.respuesta);
                                    noty({text: '!Error: Fallo la transaccion', layout: 'topRight', type: 'error'});
                                }
                            });
                    }

                    function asignarIndicador(IDINDICADOR){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            _token = $("input[name=_token]").val();
                            
                            $.post("{{ url('/proyectos/asignarIndicadorProyectos') }}",{IDPROYECTO:IDPROYECTO,IDINDICADOR:IDINDICADOR,_token:_token},function(data){
                                
                                var data2 = JSON.parse(data);
                                
                                if(data2.respuesta == 'ok'){
                                    noty({text: data2.mensaje, layout: 'topRight', type: 'success'});
                                    tableIndicadorProyectos.ajax.reload();
                                    progresoInformacionProyecto();
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
                                progresoInformacionProyecto();
                            }else if(data2.respuesta == 'existe'){
                                noty({text: data2.mensaje, layout: 'topRight', type: 'warning'});
                            }else{
                                console.log(data2.respuesta);
                                noty({text: '!Error: Fallo la transaccion', layout: 'topRight', type: 'error'});
                            }
                        })
                    }

                    function eliminarObjetivoProyecto(IDOBJETIVOESTRATEGICO,IDPROYECTO){
                        _token = $("input[name=_token]").val();
                        noty({
                            text: 'Esta seguro que desea eliminar el objetivo estrategico del proyecto?',
                            layout: 'topRight',
                            buttons: [
                                    {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                        $noty.close();
                                        $.post("{{ url('/proyectos/eliminarProyectoObjetivos') }}",{IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO,IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                                            if(data == 'eliminado'){
                                                noty({text: 'El objetivo a sido eliminado del proyecto', layout: 'topRight', type: 'success'});
                                                tableObjetivosProyectos.ajax.reload();
                                            }else if(data == 'existe'){
                                                noty({text: 'El objetivo no a sido eliminado del proyecto, esta asignado a una actividad', layout: 'topRight', type: 'warning'});
                                            }else{
                                                noty({text: 'Lo sentimos, no se elimino el objetivo intenta nuevamente', layout: 'topRight', type: 'error'});
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

                    function eliminarSupervisorProyecto(IDSUPERVISOR,IDPROYECTO){
                        _token = $("input[name=_token]").val();
                        noty({
                            text: 'Esta seguro que desea eliminar el supervisor del proyecto?',
                            layout: 'topRight',
                            buttons: [
                                    {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                        $noty.close();
                                        $.post("{{ url('/proyectos/eliminarProyectoSupervisor') }}",{IDSUPERVISOR:IDSUPERVISOR,IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                                            if(data == 'eliminado'){
                                                noty({text: 'El supervisor a sido eliminado del proyecto', layout: 'topRight', type: 'success'});
                                                tableSupervisoresProyectos.ajax.reload();
                                            }else{
                                                noty({text: 'Lo sentimos, no se elimino el objetivo intenta nuevamente', layout: 'topRight', type: 'error'});
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
                    function eliminarIndicadorProyecto(IDINDICADOR,IDPROYECTO){
                        _token = $("input[name=_token]").val();
                        noty({
                            text: 'Esta seguro que desea eliminar el indicador del proyecto?',
                            layout: 'topRight',
                            buttons: [
                                    {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                        $noty.close();
                                        $.post("{{ url('/index.php/proyectos/eliminarIndicadorProyecto') }}",{IDINDICADOR:IDINDICADOR,IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                                            if(data == 'eliminado'){
                                                noty({text: 'El indicador a sido eliminado del proyecto', layout: 'topRight', type: 'success'});
                                                tableIndicadorProyectos.ajax.reload();
                                            }else if(data == 'existe'){
                                                noty({text: 'El Indicador no a sido eliminado del proyecto, tiene una actividad asignada', layout: 'topRight', type: 'warning'});
                                            }else{
                                                noty({text: 'Lo sentimos, no se elimino el objetivo intenta nuevamente', layout: 'topRight', type: 'error'});
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
                    function obtenerFechasProyecto(IDPROYECTO){
                        _token = $("input[name=_token]").val();
                        $.post("{{ url('/proyectos/obtenerFechasActivasDeProyecto') }}",{IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                            data2 = JSON.parse(data);
                            $("#dpFechaProyecto").val(data2.FECHAINICIAL);
                            $("#dpFechaFinalProyecto").val(data2.FECHAFINAL);
                        })
                    }
               
                    $(function (){
                       
                        $("#btnAgregarFecha").on("click",function(){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            if(IDPROYECTO > 0){
                                $('#modalprogramarProyecto').modal('show')
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
                        table = $("#datatableObjetivos").DataTable({
                            "lengthMenu": [ 5, 10],
                            "language" : {
                                "url": '{{ asset("/js/plugins/datatables/spanish.json") }}',
                            },
                            "autoWidth": false,
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
                            
                            "columns": [
                                {width: '8%',data: 'IDOBJETIVOESTRATEGICO'},
                                {width: '8%',data: 'LITERAL'},
                                {width: '70%',data: 'DESCRIPCION'},
                                {width: '14%',data: 'action', name: 'action', orderable: false, searchable: false},
                            
                            ]
                        });
                        tableindicador = $("#datatableIndicador").DataTable({
                            "lengthMenu": [ 5, 10],
                            "language" : {
                                "url": '{{ asset("/js/plugins/datatables/spanish.json") }}',
                            },
                            "autoWidth": false,
                            "order": [], //Initial no order
                            "processing" : true,
                            "serverSide": true,
                            "ajax": {
                                "url": '{{url("/proyectos/indicador")}}',
                                "type": "post",
                                "data": function (d){
                                    d.idcatalogo = $("#slcatalogoindicador").val();
                                    d._token = $("input[name=_token]").val();
                                }
                            },
                            
                            "columns": [
                                {width: '10%',data: 'IDINDICADORES'},
                               
                                {width: '70%',data: 'DESCRIPCION'},
                                {width: '20%',data: 'action', name: 'action', orderable: false, searchable: false},
                            
                            ]
                        });
                        $("#slcatalogoindicador").on("change",function(){
                            $("#slcatalogoindicador option:selected").each(function(){
                                tableindicador.ajax.reload();
                            })
                        })
                        $("#btnAgregarObjetivo").on("click",function(){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            if(IDPROYECTO > 0){
                                $('#modalObjetivo').modal('show')
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
                        $("#btnAgregarIndicador").on("click", function(){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            if(IDPROYECTO > 0){
                                $('#modalIndicador').modal('show')
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
                        $("#btnAgregarSupervisor").on("click",function(){
                            IDPROYECTO = $("input[name=idproyecto]").val();
                            if(IDPROYECTO > 0){
                                $('#modalSupervisor').modal('show')
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
                        //tap para Guardar informacion proyecto
                            $.validator.addMethod("validarProyectoExiste",function(value,element){
                                _token = $("input[name=_token]").val();
                                
                                $.post("{{ url('/proyectos/validacion/proyectoExiste') }}",{value: value,_token:_token},function(data){
                                    data2 = JSON.parse(data);
                                    if(data2.respuesta == 'no'){
                                        return true;
                                    }else{
                                        return false;
                                    }
                                })
                                
                            },"!El nombre de proyecto ingresado ya existe");
                            $.validator.addMethod("validarFechaFinal", function(value, element, param) {
                             
                                return this.optional(element) || value > $(param).val();
                                
                            }, "El campo [Fecha final] no puede ser menor al campo [Fecha inicial]");
                                                   
                            $("#btnGuardarProyecto").on("click",function(){
                                datos = $("#formProyecto").validate({
                                    ignore: ":hidden:not(select)",
                                    
                                    rules: {
                                        txtnombreProyecto: {
                                            required: true,
                                            minlength: 2,
                                            maxlength: 250,
                                            /*remote: {
                                                url: "{{ url('/proyectos/validacion/proyectoExiste') }}",
                                                type: "post",
                                                dataType: "json",
                                                data: {
                                                    txtnombreProyecto : function(){
                                                        return $("input[name=txtnombreProyecto]").val();
                                                    },
                                                    _token : function(){
                                                        return $("input[name=_token]").val();
                                                    },
                                                    IDPROYECTO : function(){
                                                        return $("input[name=idproyecto]").val();
                                                    }
                                                  
                                                },
                                            },*/
                                        },
                                        dpFechaProyecto: {
                                            required: true,
                                        },
                                        dpFechaFinalProyecto: {
                                            required: true,
                                            validarFechaFinal: '#dpFechaProyecto',
                                            
                                        },
                                        slDepartamento: {
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
                                        txtnombreProyecto: {
                                            required: "El campo [Nombre de proyecto] es requerido",
                                            minlength: "El campo [Nombre de proyecto] no puede contener menos de dos caracteres",
                                            maxlength: "El campo [Nombre de proyecto] no puede contener mas de 250 caracteres",
                                            remote : "El [Nombre de proyecto] ingresado ya existe",
                                        },
                                        dpFechaProyecto : {
                                            required: "El campo [Fecha inicial] es requerido"
                                        },
                                        dpFechaFinalProyecto : {
                                            required: "El campo [Fecha final] es requerido"
                                        },
                                        slDepartamento: {
                                            required: "El campo [Direccion] es requierido",
                                            
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
                                        //console.log('error');
                                        var element2 = element.siblings('div'); 
                                        var element3 = element.siblings('span'); 
                                        
                                        if (element2.hasClass('btn-group')) {
                                            element2.attr("class","btn-group bootstrap-select form-control select error");
                                            error.insertAfter(element2);
                                        } else {
                                            
                                            element3.remove();
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
                                        $.mpb('show',{value: [0,80],speed: 40,state: 'success'});
                                    },
                                    success : function(data){
                                        if(data.respuesta == 'ok'){
                                            $("input[name=idproyecto]").val(data.codigo);
                                            if(data.transaccion == 'guardar'){
                                                $("#btnGuardarProyecto").html('Actualizar proyecto');
                                                progresoInformacionProyecto();
                                                tableFechasProyectos.ajax.reload();
                                                noty({text: 'Proyecto creado con exito', layout: 'topRight', type: 'success'});
                                                $.mpb('show',{value: [80,100],speed: 80,state: 'success'});
                                                $.mpb('destroy');
                                            }else{
                                                noty({text: 'Proyecto actualizado con exito', layout: 'topRight', type: 'success'});
                                                $.mpb('show',{value: [80,100],speed: 80,state: 'success'});
                                                $.mpb('destroy');
                                            }
                                            //se cargan los supervisores del proyecto
                                           
                                        }else if(data.respuesta == 'validacion'){
                                            
                                            if(data.validate.txtnombreProyecto){
                                                noty({text: data.validate.txtnombreProyecto[0], layout: 'topRight', type: 'warning'});
                                            }
                                            
                                            $.mpb('show',{value: [80,100],speed: 80,state: 'success'});
                                            $.mpb('destroy');
                                        }else if(data.respuesta == 'no'){
                                            noty({text: 'Lo sentimos!, hubo un error intenta nuevamente', layout: 'topRight', type: 'error'});
                                            $.mpb('show',{value: [80,100],speed: 80,state: 'success'});
                                            $.mpb('destroy');
                                        }
                                        
                                    },
                                    error : function(xhr,data){
                                        $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                                        $.mpb('destroy');
                                        
                                        //alert("!Error "+xhr.status+", reportelo al centro de computo");
                                        if(xhr.status == 422){
                                            
                                            if(xhr.responseJSON.txtnombreProyecto){
                                                noty({text: xhr.responseJSON.txtnombreProyecto[0], layout: 'topRight', type: 'warning'});
                                            }
                                            
                                        }
                                        console.log("!Error "+xhr.status+", reportelo al centro de computo");
                                        
                                    }
                                })
                            })
                        //end tap Guardar informacion proyecto
                          //ALCANCE 
                        $("#btnGuardarFechas").on("click",function(){
                            datos2 = $("#formFechas").validate({
                                rules: {
                                    dpFechaInicial: {
                                        required: true,
                                    },
                                    dpFechaFinal: {
                                        required: true,
                                    }, 
                                    taobservacion: {
                                        required: true,
                                    }           
                                },
                                messages: {
                                    dpFechaInicial: {
                                        required: "El campo Fecha inicial es requerido",
                                    },
                                    dpFechaFinal: {
                                        required: "El campo Fecha final es requerido",
                                    },
                                    taobservacion: {
                                        required: "El campo Observacion es requerido",
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
                                
                                },
                                
                                
                                
                            })
                            if(datos2.form() == true){
                                $("#formFechas").submit();
                            }
                            
                        })
                        $("#formFechas").on("submit", function(e) {
                            dpFechaInicial = $("#dpFechaInicial").val();
                            dpFechaFinal = $("#dpFechaFinal").val();
                            taobservacion = $("#taobservacion").val();
                            _token = $("input[name=_token]").val();
                            idproyecto = $("input[name=idproyecto]").val();
                            
                            e.preventDefault();
                            $.ajax({
                                url: $(this).attr("action"),
                                type: $(this).attr("method"),
                                data: { dpFechaInicial:dpFechaInicial,dpFechaFinal:dpFechaFinal,idproyecto:idproyecto,taobservacion:taobservacion,_token:_token},
                                dataType : 'json',
                                beforeSend : function(){
                                    $.mpb('show',{value: [0,40],speed: 10,state: 'success'});
                                    
                                    $('body').loadingModal('show');
                                    $('body').loadingModal('text', 'Reprogramando fechas...');
                                },
                                success : function(data){
                                    if(data.respuesta == 'ok'){
                                        tableFechasProyectos.ajax.reload();
                                    
                                        if(data.transaccion == 'programar'){
                                            noty({text: 'Fechas programadas con exito', layout: 'topRight', type: 'success'});
                                        }else{
                                            noty({text: 'Fechas reprogramadas con exito', layout: 'topRight', type: 'success'});
                                        }
                                        idproyecto = $("input[name=idproyecto]").val();
                                        obtenerFechasProyecto(idproyecto);
                                    }
                                    $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                                    $.mpb('destroy');
                                    $('body').loadingModal('hide');
                                },
                                error : function(xhr,estado){
                                    $.mpb('show',{value: [40,100],speed: 10,state: 'success'});
                                    $.mpb('destroy');
                                    $('body').loadingModal('hide');
                                    alert("!Error "+xhr.status+", reportelo al centro de computo");
                                    
                                }
                            })
                        })
                        tableFechasProyectos = $("#datatableFechasProyectos").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ asset("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
                                "order": [], //Initial no order
                                "processing" : true,
                                "serverSide": true,
                                "ajax": {
                                    "url": '{{ url("/proyectos/datatableFechasProyecto") }}',
                                    "type": "post",
                                    "data": function (d){
                                        d.idproyecto = $("input[name=idproyecto]").val();
                                        d._token = $("input[name=_token]").val();
                                    }
                                },
                                "columnDefs": [{ targets: [3], "orderable": false}],
                                "columns": [
                                    {width: '8%',data: 'IDPROYECTOFECHAFINAL'},
                                    {width: '20%',data: 'FECHAINICIAL'},
                                    {width: '20%',data: 'FECHAFINAL'},
                                    {width: '10%',data: 'ESTADOFECHAP'},
                                    {width: '30%',data: 'OBSEVACIONP'},
                                    {width: '12%',data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            });
                        //tap para agregar objetivos estrategicos
                            
                            tableObjetivosProyectos = $("#datatableObjetivosProyectos").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ asset("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
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
                                    {width: '8%',data: 'IDOBJETIVOESTRATEGICO'},
                                    {width: '8%',data: 'LITERAL'},
                                    {width: '70%',data: 'DESCRIPCION'},
                                    {width: '14%',data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            });
                            $("#slcatalogo").on("change",function(){
                                $("#slcatalogo option:selected").each(function(){
                                    table.ajax.reload();
                                })
                            })
                            
                        //end tab agregar objetivos estrategicos
                        //tap para agregar supervisores al proyecto
                            tableSupervisoresProyectos = $("#datatable-supervisorProyecto").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ asset("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
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
                        //tap para agregar supervisores al proyecto
                        tableIndicadorProyectos = $("#datatable-indicadorProyecto").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ asset("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
                                "order": [], //Initial no order
                                "processing" : true,
                                "serverSide": true,
                                "ajax": {
                                    "url": '{{ url("/proyectos/obtenerIndicadorProyectos") }}',
                                    "type": "post",
                                    "data": function (d){
                                        d.idproyecto = $("input[name=idproyecto]").val();
                                        d._token = $("input[name=_token]").val();
                                    }
                                },
                                "columns": [
                                    {width: '10%',data: 'IDINDICADORES'},
                                    {width: '70%',data: 'DESCRIPCION'},
                                    {width: '20%',data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            })
                        //end tap para agregar supervisores al proyecto
                    });
                    
                </script>
                @endpush('PageScript')
@endsection('principal')