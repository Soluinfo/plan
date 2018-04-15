@extends('master')
@section('title','Proyectos')
@section('principal')
<<<<<<< HEAD
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
        <li><a href="{{ url('/principal')}}">Principal</a></li>                    
        <li class="active">Portafolio de proyectos</li>
    </ul>
    <!-- END BREADCRUMB -->                       
    <!-- PAGE TITLE -->
    <div class="page-title">                    
        <h2><span class="fa fa-arrow-circle-o-left"></span> Portafolio de proyectos</h2>
    </div>
    <!-- END PAGE TITLE --> 
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-lg-4">
                <a class="btn btn-block btn-primary" href="{{ url('/proyectos/crear') }}"><span class="fa fa-plus"></span> Nuevo proyecto</a></br>
            </div>
            <div class="col-md-12">
                <!-- START DEFAULT DATATABLE -->
                <div class="panel panel-default">
                    <div class="panel-heading">                                
                        <h3 class="panel-title">Listas de proyectos</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul> 
                        <div class="panel-body col-md-3 col-xs-12">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info">Seleccione Accion</button>
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>  
                                </button>
                                <ul class="dropdown-menu" role="menu" id="export-menu">
                                    <li><a href="{{ url('/proyectos/reporteexcel') }}"><i class="fa fa-file-excel-o fa-fw"></i>Exportar a Excel</a></li>
                                    <li><a target="_blank" href="{{ url('/proyectos/pdf') }}"><i class="fa fa-file-pdf-o  fa-fw"></i>Exportar a PDF</a></li>
                                    <!--<li><a id="btn_filtrar2" name="btn_filtrar2" href="#"><i class="fa fa-gears fa-fw"></i>Filtro avanzado</a></li>-->
                                    <li><a id="btn_filtrar2" name="btn_filtrar2"  class="btn btn-block fa-fw"><span class="fa fa-plus"></span>Filtro avanzado</a></li>
                                </ul>
                            </div> 
                        </div> 
                        <!--<a href="{{ url('/proyectos/reporteexcel') }}"  class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Reporte en Excel <span class="fa fa-plus fa-right"></span></a>
                        <a href="{{ url('/actividad/pdf') }}"  class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">PDF<span class="fa fa-plus fa-right"></span></a>-->                                   
                    </div>
                    <div class="panel-body">
=======
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    <li class="active">Portafolio de proyectos</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Portafolio de proyectos</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="btn btn-block btn-primary" href="{{ url('/proyectos/crear') }}"><span class="fa fa-plus"></span> Nuevo proyecto</a></br>
                        </div>
                        <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Listas de proyectos</h3>

                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul> 
                                    <div class="panel-body col-md-3 col-xs-12">
                                       <div class="btn-group">
                                            <button type="button" class="btn btn-info">Seleccione Accion</button>
                                            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                
                                            </button>
                                            <ul class="dropdown-menu" role="menu" id="export-menu">
                                                <li id="export-to-excel"><a href="{{ url('/proyectos/reporteexcel') }}">Exportar a Excel</a></li>
                                                
                                                <li><a target="_blank" href="{{ url('/proyectos/pdf') }}">Exportar a PDF</a></li>
                                            </ul>
                                        </div> 
                                    </div> 
                                    <!--<a href="{{ url('/proyectos/reporteexcel') }}"  class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">Reporte en Excel <span class="fa fa-plus fa-right"></span></a>
                                    <a href="{{ url('/actividad/pdf') }}"  class="btn btn-info col-lg-2 col-md-3 col-sm-4 col-xs-12 pull-right">PDF<span class="fa fa-plus fa-right"></span></a>-->

                                    
>>>>>>> origin/test

                        <div class="table-responsive">
                            <div class="panel-body">
                                <button><a id="btn_filtrar2" name="btn_filtrar2"  class="btn btn-block"><span class="fa fa-plus"></span>Filtro avanzado</a></button>
                                <div class="col-lg-12" style="text-align: center">
                                    <h4 class="">Lista de Proyectos</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Seleccione filtro</label>
                                            <select id="tipofiltro" class="selectpicker form-control">
                                                <option value="1">TODO</option>
                                                <option value="2">DEPARTAMENTO</option>
                                                <option value="3">ESTADO</option>
                                                <option value="4">FECHAS</option>                                                              
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div id="ctodo" class="form-group">
                                            <label>Seleccione :</label>
                                            <input class="form-control" disabled value="TODO"/>  
                                        </div>                                       
                                        <div style="display: none;" id="ddepartamento" class="form-group">
                                            <label>* Departamento :</label>
                                            <select class="selectpicker form-control" data-live-search="true" id="departamento" name="departamento">
                                                <option value="0">Seleccionar Departamento</option>
                                                <?php foreach($proyectos as $c){?>
                                                    <option value="<?php echo $c->SERIAL_DEP ?>"><?php echo $c->DESCRIPCION_DEP ?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    
                                        <div style="display: none;" id="eestado" class="form-group">
                                            <label>* Estado :</label>
                                            <select class="selectpicker form-control" data-live-search="true" id="estado" name="estado">
                                                <option value="0">Seleccionar Estado</option>
                                                <option>ABIERTO</option>
                                                <option>EN PROGRESO</option>
                                                <option>RETRSASADO</option> 
                                                <option>COMPLETADO</option> 
                                            </select>
                                        </div>
                                        <div style="display: none;" id="dfecha" class="form-group">
                                            <div style="display: none;" class="form-group input-daterange input-group" id="fechasso" data-provide="datepicker">
                                                <div class="input-daterange input-group" id="datepicker" data-provide="datepicker">
                                                    <input type="text" class="input form-control" name="txt_fechainicial_co" id="txt_fechainicial_co" placeholder="Inicial"/>
                                                    <span class="input-group-addon">hasta</span>
                                                    <input type="text" class="input form-control" name="txt_fechafinal_co" id="txt_fechafinal_co" placeholder="Final" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-6"><br>
                                    <button id="btn_filtro_avanzado" class="btn btn-info btn-block">Filtrar</button>
                                   
                                    </div>
                                </div>
                                
                                <table class="table table-striped table-bordered" id="tablaproyecto" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre proyecto</th>
                                            <th>Informacion %</th>
                                            <th>Fecha creacion</th>
                                            <th>estado</th>
                                            <th>Departamento</th>
                                            <th>Progreso</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($proyectos as $p)
                                        <tr>
                                            <td>{{ $p->IDPROYECTO }}</td> 
                                            <td>{{ $p->NOMBREPROYECTO }}</td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-<?php if($p->PROGRESODECREACION == 100){ echo 'success';}else if($p->PROGRESODECREACION == 75){ echo 'info';}else if($p->PROGRESODECREACION == 50){echo 'warning';}else{echo 'danger';}?>" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$p->PROGRESODECREACION}}%;">{{$p->PROGRESODECREACION}}%</div>
                                                </div>
                                            </td>
                                            <td>{{ $p->FECHAPROYECTO }}</td>
                                            @if($p->ESTADOPROYECTO == 1)
                                            <td><span class="label label-info label-form">ABIERTO</span></td>
                                            @elseif($p->ESTADOPROYECTO == 2)
                                            <td><span class="label label-success label-form">EN PROGRESO</span></td>
                                            @elseif($p->ESTADOPROYECTO == 3)
                                            <td><span class="label label-danger label-form">EN RETRASO</span></td>
                                            @else
                                            <td><span class="label label-success label-form">COMPLETADO</span></td>
                                            @endif
                                            <td>{{ $p->DESCRIPCION_DEP }}</td>
                                            <td>
                                                <div class="progress progress-small progress-striped active">
                                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: {{$p->progreso}}%;">{{$p->progreso}}%</div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="{{ action('proyectos\DetalleProyectoController@home',$p->IDPROYECTO) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                                                <a href="{{ action('proyectos\ProyectoController@crear',$p->IDPROYECTO) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                                                <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="eliminar!"><span class="fa fa-trash-o"></span></a>
                                                <a href="{{ action('proyectos\ProyectoController@Exportarpdf',$p->IDPROYECTO) }}" target="_blank" type="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Reporte PDF!"><span class="fa fa-file-pdf-o"></span></a>
                                            </td>
                                        </tr>
                                        @endforeach     
                                    </tbody>
                                </table>
                            </div>
                        </div>  
                    </div>
                </div>
                <!-- END DEFAULT DATATABLE -->
            </div>
        </div>                    
    </div>
    <!-- END PAGE CONTENT WRAPPER --> 
    @push('PageScript')
    <script type="text/javascript" src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script>
        function limpiar_filtroavanzado(){
                $("#departamento").val(0).selectpicker("refresh");
                $("#estado").val(0).selectpicker("refresh");
                $("#fechasso").val(0).selectpicker("refresh");
                
                }
            $(document).ready(function(){
                tableProyectos = $("#tablaproyecto").DataTable({
                    "language" : {
                        "url": baseUrl+"/js/plugins/datatables/spanish.json"
                    },
                    "lengthMenu": [ 8, 10],
                    "columns": [
                        {width: '8%'},
                        {width: '17%'},
                        {width: '10%'},
                        {width: '10%'},
                        {width: '10%'},
                        {width: '20%'},
                        {width: '10%'},
                        {width: '15%',name: 'action', orderable: false, searchable: false},
                    
                    ],
                });
                
                
                $("#tipofiltro").on("change",function(){
                    limpiar_filtroavanzado();
                    var tipofiltro = $("#tipofiltro").val();
                    if(tipofiltro == 1){
                        //CCLASEVEHICULO SE CAMBIO A TIPO DE VEHICULO
                        $("#ddepartamento").show();
                        $("#eestado").hide();
                        $("#dfecha").hide();
                        $("#ctodo").hide();
                    }else if(tipofiltro == 2){
                        $("#ddepartamento").hide();
                        $("#ctodo").hide();
                        $("#dfecha").hide();
                        $("#eestado").show();
                    }else if(tipofiltro == 3){
                        $("#ddepartamento").hide();
                        $("#eestado").hide();
                        $("#dfecha").show();
                        $("#ctodo").hide();
                    }
                    else{
                        $("#ddepartamento").hide();
                        $("#eestado").hide();
                        $("#fechasso").hide();
                        $("#ctodo").show();
                    }
                });
                $("#btn_filtro_avanzado").on("click",function(){
                    table.ajax.reload();
                    alert("!reportelo al centro de computo");
                }); 

                /*$("#btn_filtrar2").on("click",function(){
                limpiar_filtroavanzado();
                if($("#panelfilter2").is(":visible")){
                    $("#panelfilter2").hide();
                }else{
                    $("#panelfilter2").show();
                }
                });*/

                
            })
            function eliminarProyecto(IDPROYECTO){
                _token = $("input[name=_token]").val();
                noty({
                    text: 'Esta seguro que desea eliminar el proyecto?',
                    layout: 'topRight',
                    buttons: [
                            {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                $noty.close();
                                $.post("{{ url('/Proyectos/eliminar') }}",{IDPROYECTO:IDPROYECTO,_token:_token},function(data){
                                    if(data == 'eliminado'){
                                        noty({text: 'El proyecto ha sido Eliminado', layout: 'topRight', type: 'success'});
                                        
                                    }else{
                                        noty({text: 'Lo sentimos, no se elimino el proyecto intenta nuevamente', layout: 'topRight', type: 'error'});
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
        </script> 
    @endpush('PageScript')
@endsection('principal')