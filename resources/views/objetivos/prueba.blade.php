
<html lang"es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="css/estilos.css">
        <style type="text/css">
        </style>  
    </head>   
        <body>
        <header>
        <center><img src="img/colegio.jpg" width="250" height="60" position= "fixed"/></center>

            </header>
            <div class="container">
                <div class="row">
                    <center><h5><strong>PROYECTOS DEL COLEGIO CRISTO REY</strong></h5> </center>
                    <table style="font-size:12px">
                        
                      
                            <tr>
                                <th style="width: 40%;"><strong>Area de Mejora</strong></th>                            
                                <th style="width: 10%;"><strong>Proyecto</strong></th>
                                <th style="width: 20%;"><strong>Fecha</strong></th>
                                <th style="width: 20%;"><strong>Estado</strong></th>
                                <th style="width: 20%;"><strong>Departamento</strong></th>
                            </tr>
                            <tbody>
                                @foreach($proyectos as $p)
                                <tr>
                                <td  style="width: 60%;">Prueba</td>
                                <td style="width: 90%;">{{ $p->NOMBREPROYECTO }}</td>
                                <td style="width: 80%;">{{ $p->FECHAPROYECTO }}</td>
                                @if($p->ESTADOPROYECTO == 1)
                                    <td style="width: 80%;"><span class="label label-info label-form">ABIERTO</span></td>
                                    @elseif($p->ESTADOPROYECTO == 2)
                                    <td style="width: 80%;"><span class="label label-success label-form">EN PROGRESO</span></td>
                                    @elseif($p->ESTADOPROYECTO == 3)
                                    <td style="width: 80%;"><span class="label label-danger label-form">EN RETRASO</span></td>
                                    @else
                                    <td style="width: 80%;"><span class="label label-success label-form">COMPLETADO</span></td>
                                @endif      
                            <td style="width: 80%;">{{ $p->DESCRIPCION_DEP  }}</td>
                            </tr>
                            @endforeach 
                                </tbody> 
                        </table>
                      
                        
                </div>
            </div>
            <div id="footer">Pie de página</div>
        </body>
</html>

            @push('PageScript')
                                <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
                                <script type="text/php">
    if (isset($pdf)) {
        $x = 250;
        $y = 10;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 14;
        $color = array(255,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
                                @endpush('PageScript')

