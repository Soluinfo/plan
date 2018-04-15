@extends('master')
@section('title','Objetivos')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    <li class="active">Panel de objetivos</li>
                </ul>
            <!-- END BREADCRUMB -->                      
                 <!-- PAGE TITLE -->
                 <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Panel de objetivos</h2>
                </div>
             <!-- END PAGE TITLE --> 
             <!-- PAGE CONTENT WRAPPER -->
            <div class="page-content-wrap">
                <div class="row">
                     <div class="col-lg-4">
                         <a class="btn btn-block btn-primary" href="{{ url('/crearobjetivos') }}"><span class="fa fa-plus"></span> Nuevo Objetivo</a><br>
                     </div>
                    <div class="col-md-12">
                        @component('componentes.dataTable')
                            @slot('titleComponent')
                            Objetivos estrategicos
                            @endslot
                            @slot('idcomponent')
                            datatableObjetivosCatalogo
                            @endslot
                            <tr>
                            <th width="50">id</th>
                            <th>Objetivo</th>
                            <th>Literal</th>
                            <th>Catalogo</th>
                            <th width="100">Accion</th>
                            </tr>

                        @endcomponent
                        {{ csrf_field() }}
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
                        function eliminarObjetivo(IDOBJETIVO){
                            
                            _token = $("input[name=_token]").val();
                            noty({
                                text: '¿Esta seguro que desea eliminar el objetivo?',
                                layout: 'topRight',
                                buttons: [
                                        {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                            $noty.close();
                                            $.post("{{ url('/objetivos/eliminarObjetivos') }}",{IDOBJETIVO:IDOBJETIVO,_token:_token},function(data){
                                                $('body').loadingModal('show');
                                                $('body').loadingModal('text', 'Eliminado Objetivo...');
                                                if(data == 'eliminado'){
                                                    tableCatalogoObjetivos.ajax.reload();
                                                    noty({text: 'El Objetivo ha sido Eliminado', layout: 'topRight', type: 'success'});
                                                    
                                                }else{
                                                    noty({text: 'Lo sentimos, no se elimino el objetivo intenta nuevamente', layout: 'topRight', type: 'error'});
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
                            //tabla para mostrar objetivos estrategicos
                            tableCatalogoObjetivos = $("#datatableObjetivosCatalogo").DataTable({
                                "lengthMenu": [ 5, 10],
                                "language" : {
                                    "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                },
                                "autoWidth": false,
                                "order": [], //Initial no order
                                "processing" : true,
                                "serverSide": true,
                                "ajax": {
                                    "url": '{{ url("/objetivos/datatableObjetivosDeCatalogos") }}',
                                    "type": "post",
                                    "data": function (d){
                                        d.idcatalogoobjetivo = $("input[name=idcatalogoobjetivo]").val();
                                        d._token = $("input[name=_token]").val();
                                    }
                                },
                                //"columnDefs": [{ targets: [3], "orderable": false}],
                                "columns": [
                                    {width: '8%',data: 'IDOBJETIVOESTRATEGICO'},
                                    {width: '40%',data: 'descripcionobjetivo'},
                                    {width: '12%',data: 'LITERAL'}, 
                                    {width: '25%',data: 'descripcioncatalogoobjetivo'},
                                    {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                
                                ]
                            });
                            //end tap para agregar ambitos de objetivos estrategicos
                        })
                    </script>
                       
                @endpush('PageScript')
@endsection('principal')