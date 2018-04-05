@extends('master')
@section('title','envio de correos')
@section('principal')
		<div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">dasboard</div>
                            <div class="panel-body">
                                <form action="{{url('enviar')}}" method="POST">

                                    {{ csrf_field() }}

                                    <div class="form-goup">
                                        <label for="title">titulo del correo</label>
                                        <input type="text" name="title" class="form-control" required>
                                    </div>

                                    <div class="form-goup">
                                        <label for="email">destino</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="emeil@ejemplo.com">
                                    </div>

                                    <div class="form-goup">
                                        <label for="content">contenido</label>
                                        <textarea name="content" class="form-control" required>
                                        </textarea>
                                    </div>
                                    <button id="enviar" class="btn btn-primary pull-right">enviar email<span class="fa fa-floppy-o fa-right"></span></button>
   
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	@endsection	



unidadeducativaprivadcristorey
colegiocristorey