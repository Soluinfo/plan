@extends('master')
@section('title','Principal')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>                    
                    <li class="active">Dashboard</li>
                    
                </ul>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">
                        <div class="col-md-3">

                            <!-- START WIDGET SLIDER -->
                            <div class="widget widget-default widget-carousel">
                                <div class="owl-carousel" id="owl-example">
                                    <div>                                    
                                        <div class="widget-title">Total Proyectos</div>                                                                        
                                        <div class="widget-int"><h3><?php if(isset($total)){echo $total;} ?></h3></div>
                                        
                                    </div>
                                    <div>                                    
                                    <div class="widget-title">Total Proyectos</div>                                                                       
                                    <div class="widget-int"><h3><?php if(isset($total)){echo $total;} ?></h3></div>
                                    </div>
                                </div>                            
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                             
                            </div>         
                            <!-- END WIDGET SLIDER -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET MESSAGES -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-messages.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-envelope"></span>
                                </div>                             
                                <div class="widget-data">
                                <div class="widget-int"><h3><?php if(isset($num)){echo $num;} ?></h3></div>
                                    <div class="widget-title">New messages</div>
                                    <div class="widget-subtitle">In your mailbox</div>
                                </div>      
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>
                            </div>                            
                            <!-- END WIDGET MESSAGES -->
                            
                        </div>
                        
                        <div class="col-md-3">
                            
                            <!-- START WIDGET REGISTRED -->
                            <div class="widget widget-default widget-item-icon" onclick="location.href='pages-address-book.html';">
                                <div class="widget-item-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="widget-data">
                                    <div class="widget-int num-count">375</div>
                                    <div class="widget-title">Registred users</div>
                                    <div class="widget-subtitle">On your website</div>
                                </div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                            </div>                            
                            <!-- END WIDGET REGISTRED -->
                            
                        </div>
                        <div class="col-md-3">
                            
                            <!-- START WIDGET CLOCK -->
                            <div class="widget widget-info widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-controls">                                
                                    <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
                                </div>                            
                                <div class="widget-buttons widget-c3">
                                    <div class="col">
                                        <a href="#"><span class="fa fa-clock-o"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-bell"></span></a>
                                    </div>
                                    <div class="col">
                                        <a href="#"><span class="fa fa-calendar"></span></a>
                                    </div>
                                </div>                            
                            </div>                        
                            <!-- END WIDGET CLOCK -->
                            
                        </div>
                    </div>
                    <!-- END WIDGETS -->                    
                    
                    <!-- <div class="page-content-wrap">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE 
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                   
                                  
                                </div>
                                <div class="panel-body">
                                <center><h3 class="panel-title">Listas de proyectos</h3></center>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre proyecto</th>
                                                <th>Fecha creacion</th>
                                                <th>estado</th>
                                                <th>Departamento</th>
                                                <th>Actividad</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($proyectos as $p)
                                            <tr>
                                           
                                                <td>{{ $p->IDPROYECTO }}</td>
                                                <td>{{ $p->NOMBREPROYECTO }}</td>
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
                                               
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE 

                        </div>
                    </div>                   
                </div> -->
    <div class "row">
           <div class="col-lg-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <i class="fa fa-bar-chart-o fa-fw"></i> Gráfico de Cantidad de Proyectos por Usuario
                    
                    <ul class="panel-controls" style="margin-top: 2px;">
                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                            <ul class="dropdown-menu">
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                            </ul>                                        
                        </li>                                        
                    </ul>
                    </div>  
                    <h3><center>Numero de Proyectos por Usuario</center></h3>
                        <span><center>Colegio Nacional Cristo Rey</center></span>
                    <div class="app">
                        <center>
                        {!! $usuarios->html() !!}
                        </center>
                    </div>
                    <!-- End Of Main Application -->
                    {!! Charts::scripts() !!}
                    {!! $usuarios->script() !!}
                </div>
            </div>
        </div>
                <!-- END PAGE CONTENT WRAPPER -->
        <div class="col-lg-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Gráfico Estados de Proyectos    
                        
                        <ul class="panel-controls" style="margin-top: 2px;">
                            <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                            <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                <ul class="dropdown-menu">
                                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                </ul>                                        
                            </li>                                        
                        </ul> 
                </div>
                        <h3><center>Proyectos por Departamento</center></h3>
                            <span><center>Colegio Nacional Cristo Rey</center></span>
                    <div class="app">
                        <center>
                        {!! $pastel->html() !!}
                        </center>
                    </div>
                    <!-- End Of Main Application -->
                    {!! Charts::scripts() !!}
                    {!! $pastel->script() !!}
                </div>   
            </div>
        </div> 
        <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Gráfico de Proyectos por Departamento 
                
                <ul class="panel-controls" style="margin-top: 2px;">
                    <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                    <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                        <ul class="dropdown-menu">
                            <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                        </ul>                                        
                    </li>                                        
                </ul>
                </div>  
                <h3><center>Estado Actual de Proyectos</center></h3>
                    <span><center>Colegio Nacional Cristo Rey</center></span>
                <div class="app">
                    <center>
                    {!! $columnas->html() !!}
                    </center>
                </div>
                <!-- End Of Main Application -->
                {!! Charts::scripts() !!}
                {!! $columnas->script() !!}
            </div>
        </div>
    </div>
    </div> 
        
                <!-- END PAGE CONTENT WRAPPER --> 
    @push('PageScript')
   
                    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
            <script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
            <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
            <script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>

            <script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>  
            <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>                
            <script type="text/javascript" src="js/plugins/moment.min.js"></script>
            <script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>

            <script type="text/javascript" src="js/graficas.js"></script>
            <script type="text/javascript" src="js/highcharts.js"></script>

            <script>
            </script>
    @endPush('PageScript')
    
@endsection('principal')
