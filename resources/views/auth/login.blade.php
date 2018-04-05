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
                    <form  class="form-horizontal" method="post" action="{{ route('principal') }}">
                    {{csrf_field()}}
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <div class="col-md-12">
                            <input type="text" name="email" class="form-control" placeholder="E-mail de usuario" />
                            {!! $errors->first('email', '<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <div class="col-md-12">
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                            {!! $errors->first('password', '<span class="help-block">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-link btn-block">Olvidaste tu contraseña</a>
                        </div>
                        <div class="col-md-6">
                            <button  class="btn btn-info btn-block">Iniciar sesión</button>
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

        <script type="text/javascript" src="{{ url('js/plugins/smartwizard/jquery.smartWizard-2.0.min.js') }}"></script>        
        <script type="text/javascript" src="{{ url('js/plugins/jquery-validation/jquery.validate.js') }}"></script>      
        <script>
        
        $(function(){
            //variables para el wizard
   $("#btnIniciarSesion").on("click",function(){
        datos = $("#formActividad").validate({
            ignore: ":hidden:not(select)",
            
            rules: {
                txtusuario: {
                    required: true,       
                },
                
                txtcontraseña: {
                        required: true,    
                        
                }               
            },
            messages: {
                txtusuario: {
                    required: "El campo Nombre de Nombre deUsuario es requerido",                                 
                },
                
                txt contraseña: {
                        required: "El campo Contraseña es Requerido",
                    }              
            },
            success: function ( label, element ) {
                
                var element2 = label.siblings('div'); 
                                
                if(element2.hasClass('btn-group')){
                    element2.attr("class","btn-group bootstrap-select form-control select valid");
                }
                
            },
            errorPlacement: function (error, element) {
                console.log('error');
                var element2 = element.siblings('div'); 
                var element3 = element.siblings('span'); 
                
                if (element2.hasClass('btn-group')) {
                    element2.attr("class","btn-group bootstrap-select form-control select error");
                    error.insertAfter(element2);
                } else {
                    
                    element3.hide();
                    error.insertAfter(element);
                    
                }
                /*Add other (if...else...) conditions depending on your
                * validation styling requirements*/
            },
            
            
        });
        $('select.select').on('change', function () {
            datos.element($(this));
            element = $(this);
            var element2 = element.siblings('div'); 
            if(element.val() > 0){
                console.log('mayor a cero');
            }else{
                if (element2.hasClass('btn-group')) {
                    element2.attr("class","btn-group bootstrap-select form-control select error");
                    error.insertAfter(element2);
                }
            }
            
        })
    
    
       
    }); 
        });
        </script>   
        <!-- END PLUGINS -->
    </body>
    
    