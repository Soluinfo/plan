@extends('master')
@section('title','Catalogo de Indicadores')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{url('/principal')}}">Principal</a></li>                    
                    <li class="active">Catalogo de indicadores</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Catálogo de indicadores</h2>
                    
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-lg-4">
                            <a class="btn btn-block btn-primary" href="{{ url('/catalogo/crear') }}"><span class="fa fa-plus"></span> Agregar Catalogo de Indicadores</a>
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
                                <table class="table" id="tablacatalogo">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre de Catalogo</th>
                                                <th>Fecha creacion</th>
                                                <th>Estado</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                        </tbody>
                                </table>
                                {{ csrf_field() }}
                                <!-- END DEFAULT DATATABLE -->

                            </div>
                        </div>                    
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
                        function eliminarCatalogoDeIndicadores(IDCATALOINDICADOR){
                            
                                _token = $("input[name=_token]").val();
                                noty({
                                    text: '¿Esta seguro que desea eliminar el catalogo?',
                                    layout: 'topRight',
                                    buttons: [
                                            {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                                $noty.close();
                                                $.post("{{ url('/catalogo/eliminarCatalogoIndicador') }}",{IDCATALOINDICADOR:IDCATALOINDICADOR,_token:_token},function(data){
                                                    $('body').loadingModal('show');
                                                    $('body').loadingModal('text', 'Eliminando Catalogo...');
                                                    if(data == 'eliminado'){
                                                        tableCatalogoIndicadores.ajax.reload();
                                                        noty({text: 'El catalogo ha sido Eliminado', layout: 'topRight', type: 'success'});
                                                        
                                                    }else if(data == 'tieneindicadores'){
                                                        noty({text: 'El Catalogo no se ha eliminado, contiene indicadores asignados', layout: 'topRight', type: 'warning'});
                                                    }else{
                                                        noty({text: 'Lo sentimos, no se elimino el catalogo intenta nuevamente', layout: 'topRight', type: 'error'});
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
                            
                            tableCatalogoIndicadores = $("#tablacatalogo").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [],
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/catalogo/datatableCatalogoIndicadores") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    "columnDefs": [{ targets: [4], "orderable": false}],
                                    "columns": [
                                        {width: '8%',data: 'IDCATALOGOINDICADORES'},
                                        {width: '40%',data: 'NOMBRE'},
                                        {width: '20%',data: 'FECHA'},
                                        {width: '18%',data: 'ESTADO'},
                                        {width: '14%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                        });
                    </script>
                @endpush('PageScript')
@endsection('principal')