
<html lang"es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="css/estilos.css">
       
    </head>   
        <body>
       
            <div class="container">   
                
                    <table style="font-size:12px">
                    @foreach($datosfinales as $p)
                    <tr>
                        <td><strong>Area de Mejora</strong></td> 
                        <td>FAMILIA Y COMUNIDAD</td>
                        <td><strong>Título del Proyecto</strong></td>
                        <td>{{ $p->NOMBREPROYECTO }}</td>
                    </tr>
                   
                    <tr>
                        <td><strong>Coordinador e integrantes del equipo de mejora</strong></td>
                        <td>{{ $p->NOMBRE_EPL }} {{$p->APELLIDO_EPL }} </td>
                        <td><strong>Objetivo General</strong></td>
                        <td>{{ $p->DESCRIPCION }}</td>
                            
                    </tr> 
                             
                        <!--<tr>
                            <td><strong>RESPONSABLE</strong></th>
                            <td>{{ $p->NOMBRE_EPL }} {{$p->APELLIDO_EPL }} </td>

                            <td><strong>RECURSOS</strong></th>
                            <td colspan="2">{{ $p->FECHAPROYECTO }} </td>

                            <td><strong>PLAZO</strong></th>
                            <td colspan="2">{{ $p->FECHAPROYECTO }} </td>
                        </tr>-->
                        @endforeach 
                    </table>   
            </div>
           
        </body>
</html>

            @push('PageScript')
                                <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
                                <script type="text/php">
   
                                @endpush('PageScript')

