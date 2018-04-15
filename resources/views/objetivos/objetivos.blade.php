@extends('master')
@section('title','Objetivos')
@section('principal')
                <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li><a href="{{ url('/')}}">Principal</a></li>                    
                <li class="active">Ingresar objetivos</li>
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
                    <div class="col-lg-4">
                        <a class="btn btn-block btn-primary" href="{{ url('/crearobjetivos') }}"><span class="fa fa-plus"></span> Nuevo Objetivo</a>
                    </div>
                    <div class="col-md-12">
                        <!-- START DEFAULT DATATABLE -->
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <h3 class="panel-title">Lista de Proyectos</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>                                
                            </div>
                            <div class="panel-body">
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
                                                <option value="2">LITERAL</option>
                                                <option value="3">CATALOGO</option>                                                                   
                                            </select>
                                        </div>
                                    </div>                                      
                                    <div class="col-lg-6">
                                        <div id="ctodo" class="form-group">
                                            <label>Seleccione :</label>
                                            <input class="form-control" />  
                                        </div>                                       
                                        <div style="display: none;" id="sliteral" class="form-group">
                                            <label>* Literal :</label>
                                            <select class="selectpicker form-control" data-live-search="true" id="literal" name="literal">
                                                <option value="0">Seleccionar Literal</option>
                                                <?php foreach($objetivosestrategicos as $o){?>
                                                    <option value="<?php echo $o->IDOBJETIVOESTRATEGICO ?>"><?php echo $o->LITERAL ?></option>
                                                <?php }?>
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
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Literal</th>
                                            <th>Descripcion</th>
                                            <th>Catalogo</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($objetivosestrategicos as $p)
                                        <tr>      
                                            <td width="8%">{{ $p->IDOBJETIVOESTRATEGICO }}</td>
                                            <td width="8%">{{ $p->LITERAL }}</td>
                                            <td width="35%">{{ $p->DESCRIPCION }}</td>
                                            <td width="35%">{{ $p->NOMBRE }}</td>
                                            <td width="14%">
                                                <a href="{{ action('objetivos\DetalleObjetivoController@home',$p->IDOBJETIVOESTRATEGICO) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>
                                                <a href="{{ action('objetivos\ObjetivosController@crear',$p->IDOBJETIVOESTRATEGICO) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                                                <a href="{{ action('objetivos\ObjetivosController@eliminarObjetivo',$p->IDOBJETIVOESTRATEGICO) }}" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="eliminar!"><span class="fa fa-trash-o"></span></a>
                                                <!--<button id="eliminarObjetivo"  class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="eliminar!"><span class="fa fa-trash-o"></span></button>-->
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
                    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
                    <script>
        function limpiar_filtroavanzado(){
                $("#literal").val(0).selectpicker("refresh");               
                }

                $(document).ready(function(){
                    $("#tipofiltro").on("change",function(){
                    limpiar_filtroavanzado();
                    var tipofiltro = $("#tipofiltro").val();
                    if(tipofiltro == 1){
                        //CCLASEVEHICULO SE CAMBIO A TIPO DE VEHICULO
                        $("#ctodo").show();
                        $("#sliteral").hide();
                    }else if(tipofiltro == 2){
                        $("#sliteral").show();
                        $("#ctodo").hide();
                    } 
            })
            $("#btn_filtro_avanzado").on("click",function(){
                    table.ajax.reload();
                }); 
        })
               
                </script>      
                @endpush('PageScript')
@endsection('principal')