
<html lang"es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="css/estilos.css">
        <style type="text/css">
        </style>  
    </head>   
        <body>
       
            <div class="container">
                <div class="row">
                <div align=center> <img src="img/colegio.jpg" width="300" height="70"/>
                    </div>
                    <h5 style="text-align:center"><strong><u>MATRIZ DE PLANIFICACIÓN PROYECTO DE MEJORA</u></strong></h5>
                    <table style="font-size:12px">
                        
                      
                            <tr>
                                <th style="width: 20%;"><strong>Area de Mejora</strong></th>                            
                                <th style="width: 30%;"><strong>Proyecto</strong></th>
                                <th style="width: 20%;"><strong>Fecha</strong></th>
                                <th style="width: 15%;"><strong>Estado</strong></th>
                                <th style="width: 15%;"><strong>Departamento</strong></th>
                            </tr>
                            <tbody>
                                @foreach($proyectos as $p)
                                <tr>
                                <td>Prueba</td>
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
                            <td>{{ $p->DESCRIPCION_DEP  }}</td>
                            </tr>
                            @endforeach 
                                </tbody> 
                                
                            
                        </table>
                      
                        
                </div>
            </div>
           
        </body>
</html>

            @push('PageScript')
                                <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
                                <script type="text/php">
   
                                @endpush('PageScript')

