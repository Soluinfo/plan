
<html lang"es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="stylesheet" href="css/estilos.css">
        
    </head>   
        <body>
            <div class="container">
                <div class="row">
                   <div align=center> <img  src="img/colegio.jpg" width="350" height="50"/>
                    </div>
                    <h5 style="text-align:center"><strong><u>MATRIZ DE PLANIFICACIÓN PROYECTO DE MEJORA</u></strong></h5>
                    <table style="font-size:12px">
                    @foreach($datosf as $p)
                        <tr>
                            <th style="width: 40%;"><strong>Area de Mejora</strong></th> 
                            <td style="width: 60%;" >FAMILIA Y COMUNIDAD</td>
                        </tr> 
                        <tr>                      
                            <th><strong>Título del Proyecto</strong></th>
                            <td>{{ $p->NOMBREPROYECTO }}</td>
                            </tr>
                            <tr>
                            <th><strong>Coordinador e integrantes del equipo de mejora</strong></th>
                            <td>Diego Intriago</td>
                            </tr>
                            <tr>
                            <th><strong>Objetivo General</strong></th>
                            <td>{{ $p->DESCRIPCION }}</td>
                            </tr>
                            
                            <tr>
                            <th><strong>Departamento</strong></th>
                            <td>{{ $p->DESCRIPCION_DEP  }}</td>
                        </tr>
                        
                            @endforeach 
                        
                         
                    </table> 
                     
                </div>
                
            </div>
            
        </body>
        
</html>

            @push('PageScript')
                                <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                                <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
                            @endpush('PageScript')

