
                                    </script>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Nombre proyecto</th>
                                                <th>Fecha creacion</th>
                                                <th>Departamento</th>
                                                
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($proyectos as $p)
                                            <tr>
                                                <td>{{ $p->IDPROYECTO }}</td>
                                                <td>{{ $p->NOMBREPROYECTO }}</td>
                                                <td>{{ $p->FECHAPROYECTO }}</td>
                                                <td>{{ $p->DESCRIPCION_DEP }}</td>
                                                <td>{{ $p->DESCRIPCION_DEP }}</td>
                                                
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>