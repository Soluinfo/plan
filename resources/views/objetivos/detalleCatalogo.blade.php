@extends('master')
@section('title','Detalle Catalogo')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/principal')}}">Principal</a></li>                    
                    <li><a href="{{ url('/catalogo')}}">Portafolio de Catalogos</a></li>
                    <li class="active">Detalle de catalogo</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Detalle de Catalogo</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="panel panel-default tabs">                            
                                <ul class="nav nav-tabs" role="tablist">
                                <li class="active"><a href="#tab-informacion" role="tab" data-toggle="tab">Información de Catalogo</a></li>
                                    <li><a href="#tab-informacion-objetivo" role="tab" data-toggle="tab">Objetivos del Catalogo</a></li>

                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="tab-informacion">
                                        <div class="col-md-6">

                                            <!-- DEFAULT LIST GROUP -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Informacion del Catalogo</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <ul class="list-group border-bottom">
                                                        <li class="list-group-item"><strong>codigo : </strong> {{$IDCATALOGOOBJETIVO}}</li>
                                                        <li class="list-group-item"><strong>Nombre de Catalogo : </strong> {{$NOMBRE}}</li>
                                                        <li class="list-group-item"><strong>Fecha : </strong> {{$FECHA}}</li>


                                                        <li class="list-group-item"><strong>Estado : </strong>
                                                        @if($ESTADO == 1)
                                                        <span class="label label-info">PENDIENTE</span>
                                                        @elseif($ESTADO == 2)
                                                        <span class="label label-success">APROBADO</span>
                                                        @endif
                                                        </li>
                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                            {{ csrf_field() }}
                                            <input type="hidden" name="idcatalogoobjetivo" value="{{$IDCATALOGOOBJETIVO or 0}}">
                                        </div>
                                        <div class="col-md-6">                                          

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
                                                       
                                                        <li class="list-group-item"><strong>Fecha de creacion : </strong>{{$created_at}}</li>
                                                        <li class="list-group-item"><strong>Fecha de actualizacion : </strong>{{$updated_at}}</li>
                                                    </ul>                                
                                                </div>
                                            </div>
                                            <!-- END DEFAULT LIST GROUP -->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-informacion-objetivo">
                                    
                                        @component('componentes.dataTable')
                                            @slot('titleComponent')
                                            Objetivos del Catalogo
                                            @endslot
                                            @slot('idcomponent')
                                            datatableObjetivosCatalogo
                                            @endslot
                                            <tr>
                                            <th width="50">id</th>
                                            <th>Objetivo</th>
                                            <th>Literal</th>
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
                
                
                @push('PageScript')
                    <script>
                        /*function obtenerDetalleObjetivo(IDOBJETIVOESTRATEGICO){
                           _token = $("input[name=_token]").val();
                            $.post("{{ url('/objetivos/detalles') }}",{_token:_token,IDOBJETIVOESTRATEGICO:IDOBJETIVOESTRATEGICO},function(data){
                                $("#tablaDetalleObjetivo").html(data);
                            })
                            $("#modalDetalleObjetivo").modal('show');
                           
                        }*/
                        
                        
                        $(function(){
                            
//tap para agregar objetivos estrategicos
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
                                        "url": '{{ url("/catalogo/datatableCataloObjetivos") }}',
                                        "type": "post",
                                        "data": function (d){
                                            d.idcatalogoobjetivo = $("input[name=idcatalogoobjetivo]").val();
                                            d._token = $("input[name=_token]").val();
                                        }
                                    },
                                    //"columnDefs": [{ targets: [3], "orderable": false}],
                                    "columns": [
                                        {width: '15%',data: 'IDOBJETIVOESTRATEGICO'},
                                        {width: '50%',data: 'DESCRIPCION'},
                                        {width: '20%',data: 'LITERAL'}, 
                                        {width: '15%',data: 'action', name: 'action', orderable: false, searchable: false},
                                    
                                    ]
                                });
                            //end tap para agregar ambitos de objetivos estrategicos
                            
                           
                            
                            
                        })
                    </script>
                    
                    <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                    <script type="text/javascript" src="{{ url('js/plugins/datatables/jquery.dataTables.min.js')}}"></script> 
                    
                @endpush('PageScript')
@endsection('principal')