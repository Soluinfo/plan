<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Inicio de sesion</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                
                <div class="login-body">
                    <div class="login-title"><strong>Bienvenido</strong>, por favor Inicia sesión</div>
                    <form  class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" name="txtusuario" class="form-control" placeholder="Nombre de usuario"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="password" name="txtpassword" class="form-control" placeholder="Contraseña"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Olvidaste tu contraseña</a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ url('principal') }}" id="btnIniciar" type="button" class="btn btn-info btn-block">Iniciar sesión</a>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; 2017 Cristo Rey
                    </div>
                    <div class="pull-right">
                        <a href="#">Acerca</a> |
                        <a href="#">Privacidad</a> |
                        <a href="#">Contactanos</a>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>     
        <script>
        
        $(function(){
           
        });
        </script>   
        <!-- END PLUGINS -->
    </body>
    
    