@extends('master')
@section('title','Configurar Reportes')
@section('principal')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li class="active">Portafolio de reportes</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Portafolio de Reportes</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
  <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">  
                        <div class="col-md-12">
                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                
                                <div class="panel-body">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Tipo de Reporte</th>
                                                <th>Titulo</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($reporte as $r)
                                            <tr>
                                                <td>{{ $r->idconfiguracionreporte }}</td>
                                                <td>{{ $r->nombretipo }}</td>
                                                <td>{{ $r->encabezado1 }}</td>
                                                <td>
                                                <a href="{{ action('configuracion_reportes\Configurar_ReportesController@crear',$r->idconfiguracionreporte) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>
                                                
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END DEFAULT DATATABLE -->

                        </div>
                    </div>                    
                </div>

                <!-- END PAGE CONTENT WRAPPER --> 
                @push('PageScript')
                    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
                    @endpush('PageScript')
@endsection('principal')