@extends('master')
@section('title','Catalogo de Objetivos')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li class="active">Catalogo de objetivos</li>
                </ul>
            <!-- END BREADCRUMB -->                      
                 <!-- PAGE TITLE -->
                 <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Catálogo de objetivos</h2>
                </div>
             <!-- END PAGE TITLE --> 
             <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                     <div class="col-lg-4">
                         <a class="btn btn-block btn-primary" href="{{ url('/crearcatalogo') }}"><span class="fa fa-plus"></span> Nuevo Catalogo</a>
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
                                <div class="panel-body">
                                @if(session('status'))
                                <div class="alert alert-success">
                                {{ session('status') }}
                                </div> 
                                @endif 
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
                                </div>
                            </div>
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
                        function eliminarCatalogoDeObjetivos(IDCATALOGOOBJETIVO){
                            
                                _token = $("input[name=_token]").val();
                                noty({
                                    text: 'Esta seguro que desea eliminar el catalogo?',
                                    layout: 'topRight',
                                    buttons: [
                                            {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                                $noty.close();
                                                $.post("{{ url('/catalogo/eliminarCatalogoObjetivos') }}",{IDCATALOGOOBJETIVO:IDCATALOGOOBJETIVO,_token:_token},function(data){
                                                    $('body').loadingModal('show');
                                                    $('body').loadingModal('text', 'Eliminado Catalogo...');
                                                    if(data == 'eliminado'){
                                                        tableCatalogoObjetivo.ajax.reload();
                                                        noty({text: 'El catalogo ha sido Eliminado', layout: 'topRight', type: 'success'});
                                                        
                                                    }else if(data == 'TieneObjetivosAsignados'){
                                                        noty({text: 'El catalogo no ha sido eliminado, tiene objetivos asignados', layout: 'topRight', type: 'warning'});
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
                            
                            tableCatalogoObjetivo = $("#tablacatalogo").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [],
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/catalogo/datatableCataloObjetivos") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    "columnDefs": [{ targets: [4], "orderable": false}],
                                    "columns": [
                                        {width: '8%',data: 'IDCATALOGOOBJETIVO'},
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