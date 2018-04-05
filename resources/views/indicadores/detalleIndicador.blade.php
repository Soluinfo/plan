
@extends('master')
@section('title','Detalle indicador')
@section('principal')
                <!-- START BREADCRUMB -->
            <ul class="breadcrumb">
                <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                <li><a href="{{ url('/indicadores')}}">Portafolio de Indicadores</a></li>
                <li class="active">Detalle de indicadores</li>
            </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Detalle de indicador</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default tabs">                            
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="active"><a href="#tab-informacion" role="tab" data-toggle="tab">Información</a></li>
                                    <li><a href="#tab-actividades" role="tab" data-toggle="tab">Actividades</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-informacion"> 
                                        <div class="col-md-6">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Informacion del Objetivo</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>codigo : </strong> {{$IDINDICADORES}}</li>
                                                        <li class="list-group-item"><strong>Literal : </strong> {{$LITERAL}}</li>
                                                        
                                                        <li class="list-group-item"><strong>Catalogo : </strong> {{$NOMBRE}}</li>

                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                            {{ csrf_field() }}
                                        <input type="hidden" name="idindicador" value="{{ $IDINDICADORES or '0'}}"> 
                                        </div>

                                        <div class="col-lg-4">
                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Usuario y registro</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>Usuario : </strong> dbermudez1349@hotmail.com</li>
                                                        <li class="list-group-item"><strong>Nombre : </strong> Diego</li>
                                                        <li class="list-group-item"><strong>Apellidos : </strong> Bermudez Saenz</li>
                                                       
                                                        <li class="list-group-item"><strong>Fecha de creacion :</strong>{{$created_at}}</li>
                                                        <li class="list-group-item"><strong>Fecha de actualizacion :</strong>{{$updated_at}}</li>
                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-actividades">
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                                Actividades del indicador
                                                @endslot
                                                @slot('idcomponent')
                                                datatableActividadesIndicadores
                                            @endslot
                                            <tr>
                                                <th width="50">id</th>
                                                
                                                <th>Nombre Actividad</th>
                                                <th width="100">Accion</th>
                                            </tr>
                                        @endcomponent                                    
                                    </div>  
                                </div>
                            </div>   
                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER --> 
                <!-- MODALS -->   
                  
               
                @push('PageScript')
                <script type='text/javascript' src="{{ url('js/plugins/noty/jquery.noty.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topCenter.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topLeft.js') }}"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/layouts/topRight.j') }}s"></script>
                    <script type='text/javascript' src="{{ url('js/plugins/noty/themes/default.js') }}"></script>
                    <script>
                      function eliminaractividadesindicador(IDACTIVIDAD){
                            _token = $("input[name=_token]").val();
                            noty({
                                text: 'Esta seguro que desea la actividad del indicador?',
                                layout: 'topRight',
                                buttons: [
                                        {addClass: 'btn btn-success btn-clean', text: 'Aceptar', onClick: function($noty) {
                                            $noty.close();
                                            $.post("{{ url('/indicadores/eliminarActividad') }}",{IDACTIVIDAD:IDACTIVIDAD,_token:_token},function(data){
                                                if(data == 'eliminado'){
                                                    noty({text: 'La actividad no se a podido eliminar del indicador', layout: 'topRight', type: 'success'});
                                                    tableActividadesIndicador.ajax.reload();
                                                }else{
                                                    noty({text: 'Lo sentimos, no se elimino la actividad del indicador, intenta nuevamente', layout: 'topRight', type: 'error'});
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
                        $(function(){
                           

                            //tap para agregar objetivos estrategicos
                                tableActividadesIndicador = $("#datatableActividadesIndicadores").DataTable({
                                    "lengthMenu": [ 5, 10],
                                    "language" : {
                                        "url": '{{ url("/js/plugins/datatables/spanish.json") }}',
                                    },
                                    "autoWidth": false,
                                    "order": [], //Initial no order
                                    "processing" : true,
                                    "serverSide": true,
                                    "ajax": {
                                        "url": '{{ url("/indicadores/datatableActividadIndicador") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idindicador = $("input[name=idindicador]").val();
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                   // "columnDefs": [{ targets: [3], "orderable": false}],
                                    "columns": [
                                        {width: '10%',data: 'IDACTIVIDAD'}, 
                                                                           
                                        {width: '75%',data: 'NOMBREACTIVIDAD'}, 
                                        {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                            //end tap para agregar objetivos estrategicos
                            
                        })
                        
                    </script>
                    
                    <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                    
                @endpush('PageScript')
@endsection('principal')