@extends('master')
@section('title','Indicadores')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{url('/principal')}}">Principal</a></li>                    
                    <li class="active">Indicadores</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Indicadores</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="btn btn-block btn-primary" href="{{ url('/crearindicadores') }}"><span class="fa fa-plus"></span> Nuevo Indicador</a>
                        </div>
                        <div class="col-md-12">

                            <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Default</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>                                
                                </div>
                                <table class="table" id="datatableIndicadores">
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
<<<<<<< HEAD
                                        @foreach($indicadores as $p)
                                        <tr>      
                                            <td width="8%">{{ $p->IDINDICADORES }}</td>
                                            <td width="8%">{{ $p->LITERAL }}</td>
                                            <td width="40%">{{ $p->DESCRIPCIONINDICADOR }}</td>
                                            <td width="30%">{{ $p->NOMBRE }}</td>
                                            
                                            <td width="14%">
                                                <a href="{{ action('indicadores\DetalleIndicadorController@home',$p->IDINDICADORES) }}" type="button" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Detalle!"><span class="fa fa-info-circle"></span></a>

                                                <a href="{{ action('indicadores\IndicadorController@crear',$p->IDINDICADORES) }}" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="editar!"><span class="fa fa-edit"></span></a>

                                            </td>
                                        </tr>
                                        @endforeach
                                        
=======
                                                                                
>>>>>>> origin/test
                                    </tbody>
                                
                                </table>
                                {{ csrf_field() }}
                            </div>
                            <!-- END DEFAULT DATATABLE -->

                        </div>
                    </div>                    
                
                <!-- END PAGE CONTENT WRAPPER --> 
                @push('PageScript')
                    <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/jquery.noty.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topCenter.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topLeft.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topRight.j') }}s"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/themes/default.js') }}"></script>
                <script>
                    function eliminarIndicador(IDINDICADOR){
                            
                            _token = $("input[name=_token]").val();
                            noty({
                                text: 'Esta seguro que desea eliminar el Indicador?',
                                layout: 'topRight',
                                buttons: [
                                        {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                            $noty.close();
                                            $.post("{{ url('/indicadores/eliminarIndicador') }}",{IDINDICADOR:IDINDICADOR,_token:_token},function(data){
                                                $('body').loadingModal('show');
                                                $('body').loadingModal('text', 'Eliminando Indicador...');
                                                if(data == 'eliminado'){
                                                    tableCatalogoIndicadores.ajax.reload();
                                                    noty({text: 'El indicador ha sido Eliminado', layout: 'topRight', type: 'success'});
                                                    
                                                }else if(data == 'estaAsignadoAProyecto'){
                                                    noty({text: 'El indicador no ha sigo eliminado, esta asignado a un proyecto', layout: 'topRight', type: 'success'});
                                                }else{
                                                    noty({text: 'Lo sentimos, no se elimino el indicador intenta nuevamente', layout: 'topRight', type: 'error'});
                                                }
                                                $('body').loadingModal('hide');
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
                    $(function(){
                            //tap para agregar objetivos estrategicos
                            tableCatalogoIndicadores = $("#datatableIndicadores").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
                                "order": [], //Initial no order
                                "processing" : true,
                                "serverSide": true,
                                "ajax": {
                                    "url": '{{ url("/indicadores/datatableIndicadores") }}',
                                    "type": "post",
                                    "data": function (d){
                                        
                                        d._token = $("input[name=_token]").val();
                                    }
                                },
                                //"columnDefs": [{ targets: [3], "orderable": false}],
                                "columns": [
                                    {width: '10%',data: 'IDINDICADORES'},
                                    {width: '10%',data: 'LITERAL'},
                                    {width: '40%',data: 'DESCRIPCION'}, 
                                    {width: '25%',data: 'NOMBRE'}, 
                                    {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            });
                            //end tap para agregar ambitos de objetivos estrategicos
                        
                        
                        
                        
                    })
                </script>  
                @endpush('PageScript')
@endsection('principal')