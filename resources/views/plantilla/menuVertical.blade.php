                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="index.html">Joli Admin</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <img src="{{ url('assets/images/users/avatar.jpg') }}" alt="John Doe"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="{{ url('assets/images/users/avatar.jpg') }}" alt="John Doe"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name">John Doe</div>
                                <div class="profile-data-title">Web Developer/Designer</div>
                            </div>
                            
                            <div class="profile-controls">
                                <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>
                        </div>                                                                        
                    </li>
                    <li class="xn-title">Navegacion</li>
                    <li class="active">
                        <a href="{{ url('/principal') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Principal</span></a>                        
                    </li>                    
                    
                    <li class="">
                        <a href="{{ url('/proyectos') }}"><span class = "fa fa-briefcase"> </span> <span class="xn-text">Proyectos</span></a>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class = "fa fa-folder"> </span> <span class="xn-text">Actividades</span></a>                        
                        <ul>
                                                   
                            <li><a href="{{ url('/actividadesprogreso') }}"><span class="fa fa-ticket"></span>Progreso Actividades </a></li>
                            <li><a href="{{ url('/actividades') }}"><span class = "fa fa-puzzle-piece"> </span>Panel Actividades</a></li>
                            <li><a href="{{ url('/actividades/entregable') }}"><span class = "fa fa-file-text"> </span>Panel Entregables</a></li>                            
                            
                        </ul>
                    </li>                    
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-circle"></span> <span class="xn-text">Objetivos</span></a>                        
                        <ul> 
                            
                            <li><a href="{{ url('/catalogoObjetivos') }}"><span class="fa fa-list-ol"></span>Catalogo de Objetivos</a></li>
                            <li><a href="{{ url('/objetivos') }}"><span class="fa fa-pencil"></span>Panel de Objetivos</a></li>
                           
                        </ul>
                     </li>
                    <li class="xn-openable">
                        <a href="#"><span class = "fa fa-bar-chart-o"> </span> <span class="xn-text">Indicadores</span></a>                        
                        <ul> 
                            <li><a href="{{ url('/catalogoindicadores') }}"><span class="fa fa-list-ol"></span> Catalogo de indicadores</a></li>
                            <li><a href="{{ url('/indicadores') }}"><span class="fa fa-pencil"></span> Panel de indicadores</a></li>
                        </ul>
                     </li>
                     
                    <li class="xn-openable">
                        <a href="#"><span class = "fa fa-cog"> </span> <span class="xn-text">Configuraciones</span></a>
                        <ul>
                            <li><a href="charts-morris.html">Ambito</a></li>
                            <li><a href="charts-nvd3.html">Alcance</a></li>
                            <li><a href="{{ url('configurar/reportes') }}">Configuracion de Reportes</a></li>
                            <li><a href="charts-other.html">Other</a></li>
                        </ul>
                    </li> 
                    <li class="xn-openable">
                        <a href="#"><span class = "fa fa-files-o"> </span> <span class="xn-text">Reportes</span></a>
                        <ul>
                            <li><a href="charts-morris.html"><span class="xn-text">Ambito</span></a></li>
                            <li><a href="charts-nvd3.html"><span class="xn-text">Alcance</span></a></li>
                            <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
                            <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
                        </ul>
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Estadistica</span></a>
                        <ul>
                            <li><a href="charts-morris.html"><span class="xn-text">Ambito</span></a></li>
                            <li><a href="charts-nvd3.html"><span class="xn-text">Alcance</span></a></li>
                            <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
                            <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
                        </ul>
                    </li>                                      
                </ul>
                <!-- END X-NAVIGATION -->