
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
                    @foreach($datosf as $r)
                    <h5 style="text-align:center"><strong><u>{{ $r->encabezado1 }}</u></strong></h5>
                    @endforeach
                    <table style="font-size:12px">
                    @foreach($datosf as $p)
                   
                        <tr>
                            <th style="width: 40%;"><strong>Area de Mejora</strong></th> 
                            <td style="width: 60%;" >FAMILIA Y COMUNIDAD</td>
                        </tr> 
                        <tr>                      
                            <td><strong>Título del Proyecto</strong></td>
                            <td>{{ $p->NOMBREPROYECTO }}</td>
                            </tr>
                            <tr>
                          
                            <td><strong>Coordinador e integrantes del equipo de mejora</strong></td>
                            <td>{{ $p->NOMBRE_EPL }} {{$p->APELLIDO_EPL }} </td>
                           
                            </tr>
                            <tr>
                            <td><strong>Objetivo General</strong></td>
                            <td>{{ $p->DESCRIPCION }}</td>
                            </tr>
                            
                            <tr>
                            <td><strong>Departamento</strong></td>
                            <td>{{ $p->DESCRIPCION_DEP  }}</td>
                        </tr>
                        @endforeach 
                        </table> 
                        <table style="font-size:12px">
                        <tr>
                            <th><strong>OBJETIVOS ESPECÍFICOS</strong></th>
                            <th><strong>INDICADORES DE LOGRO</strong></th>
                            <th><strong>ACTIVIDADES</strong></th>
                            <th><strong>RESPONSABLE</strong></th>
                            <th><strong>RECURSOS</strong></th>
                            <th><strong>PLAZO</strong></th>
                        </tr>
                        
                            
                        
                         
                    </table> 
                    
                     
                </div>
                
            </div>
            
        </body>
        
</html>

            @push('PageScript')
                                <script type="text/javascript" src="{{ url('js/plugins/knob/jquery.knob.min.js')}}"></script>
                                <script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script> 
                            @endpush('PageScript')

