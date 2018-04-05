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
        <script>
            var baseUrl = "{{ asset('/') }}";
            
        </script> 
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('css/loader/jquery.loadingModal.min.css') }}"/>
        <!-- EOF CSS INCLUDE --> 
        <script type="text/javascript" src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/plugins/loader/jquery.loadingModal.min.js') }}"></script>                                   
    </head>
    <body>
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                
                <div class="login-body">
                    <div class="login-title"><strong>Bienvenido</strong>, por favor Inicia sesión</div>
                    {!! Form::open(['url' => 'autenticacion/login', "name" => "formLogin", "id" => "formLogin","class" => "form-horizontal", "role" => "form"])!!}
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
                                <a id="btnIniciar" type="button" class="btn btn-info btn-block">Iniciar sesión</a>
                            </div>
                        </div>
                        {{ csrf_field() }}
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
            $("#btnIniciar").on("click",function(){
                $("#formLogin").submit();
            })
            $("#formLogin").on("submit", function(e) {
                usuario = $("input[name=txtusuario]").val();
                clave = $("input[name=txtpassword]").val();
                _token = $("input[name=_token]").val();
                e.preventDefault();
                $.ajax({
                    url: $(this).attr("action"),
                    type: $(this).attr("method"),
                    data: { usuario:usuario,clave:clave,_token:_token},
                    dataType : 'json',
                    beforeSend : function(){
                        
                        //$('body').loadingModal('show');
                        //$('body').loadingModal('text', 'Reprogramando actividad...');
                    },
                    success : function(data){
                        if(data.respuesta == 'ok'){
                            $('body').loadingModal('text', 'Bienvenido...');
                            $(location).attr('href', '{{url("/principal")}}');
                        }
                        //$('body').loadingModal('hide');
                    },
                    error : function(xhr,estado){
                        //$('body').loadingModal('hide');
                    }
                })
            })
        });
        </script>   
        <!-- END PLUGINS -->
    </body>
    
    