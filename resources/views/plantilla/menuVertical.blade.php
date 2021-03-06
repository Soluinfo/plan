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
                    
                    <li class="xn-title">Proyectos</li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Portafolio</span></a>                        
                        <ul>
                            <li><a href="{{ url('/proyectos') }}"><span class="fa fa-folder"></span> Proyectos</a></li>                            
                            <li><a href="{{ url('/actividades') }}"><span class="fa fa-ticket"></span> Actividades</a></li>
                            <li><a href="ui-buttons.html"><span class="fa fa-square-o"></span> Metas</a></li>                            
                            
                        </ul>
                    </li>                    
                    <li>
                        <a href="{{ url('/objetivos') }}"><span class="fa fa-pencil"></span> <span class="xn-text">Catalogo de Objetivos</span></a>
                    </li>
                    <li>
                        <a href="{{ url('/indicadores') }}"><span class="fa fa-table"></span> <span class="xn-text">Catalogo de indicadores</span></a>
                        
                    </li>
                    <li class="xn-openable">
                        <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Configuraciones</span></a>
                        <ul>
                            <li><a href="charts-morris.html"><span class="xn-text">Ambito</span></a></li>
                            <li><a href="charts-nvd3.html"><span class="xn-text">Alcance</span></a></li>
                            <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
                            <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
                        </ul>
                    </li>                                        
                </ul>
                <!-- END X-NAVIGATION -->