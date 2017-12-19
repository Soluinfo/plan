@extends('master')
@section('title','Crear proyecto')
@section('principal')
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="{{ url('/')}}">Principal</a></li>                    
                    <li><a href="{{ url('/proyectos')}}">Portafolio de proyectos</a></li>
                    <li class="active">Crear proyecto</li>
                </ul>
                <!-- END BREADCRUMB -->                       
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span> Crear proyecto</h2>
                </div>
                <!-- END PAGE TITLE --> 
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        
                        <div class="col-md-12">

                             <!-- START WIZARD WITH VALIDATION -->
                             <div class="block">
                                                            
                                <form action="javascript:alert('Validated!');" role="form" class="form-horizontal" id="wizard-validation">
                                <div class="wizard show-submit wizard-validation">
                                    <ul>
                                        <li>
                                            <a href="#step-7">
                                                <span class="stepNumber">1</span>
                                                <span class="stepDesc">Paso 1<br /><small>Informacion</small></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#step-8">
                                                <span class="stepNumber">2</span>
                                                <span class="stepDesc">Paso 2<br /><small>Objetivos</small></span>
                                            </a>
                                        </li>                                    
                                    </ul>

                                    <div id="step-7">   

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Nombre de catálogo</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="login" placeholder="Login"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Fecha creacion</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control" name="password" placeholder="Password" id="password"/>
                                            </div>
                                        </div>             
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Estado</label>
                                            <div class="col-md-6">
                                                <input type="password" class="form-control" name="repassword" placeholder="Re-Password"/>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="step-8">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalObjetivo">Agregar objetivo</button>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <!-- START RESPONSIVE TABLES -->
                                                    <div class="panel panel-default">

                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Responsive tables</h3>
                                                        </div>

                                                        <div class="panel-body panel-body-table">

                                                            <div class="table-responsive">
                                                                <table class="table table-bordered table-striped table-actions">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="50">id</th>
                                                                            <th>name</th>
                                                                            <th width="100">status</th>
                                                                            <th width="100">amount</th>
                                                                            <th width="100">date</th>
                                                                            <th width="100">actions</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>                                            
                                                                        <tr id="trow_1">
                                                                            <td class="text-center">1</td>
                                                                            <td><strong>John Doe</strong></td>
                                                                            <td><span class="label label-success">New</span></td>
                                                                            <td>$430.20</td>
                                                                            <td>24/09/2014</td>
                                                                            <td>
                                                                                <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                                                                <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_1');"><span class="fa fa-times"></span></button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr id="trow_2">
                                                                            <td class="text-center">2</td>
                                                                            <td><strong>Dmitry Ivaniuk</strong></td>
                                                                            <td><span class="label label-warning">Pending</span></td>
                                                                            <td>$1,351.00</td>
                                                                            <td>23/09/2014</td>
                                                                            <td>
                                                                                <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                                                                <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_2');"><span class="fa fa-times"></span></button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr id="trow_3">
                                                                            <td class="text-center">3</td>
                                                                            <td><strong>Nadia Ali</strong></td>
                                                                            <td><span class="label label-info">In Queue</span></td>
                                                                            <td>$2,621.00</td>
                                                                            <td>22/09/2014</td>
                                                                            <td>
                                                                                <button class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></button>
                                                                                <button class="btn btn-danger btn-rounded btn-sm" onClick="delete_row('trow_3');"><span class="fa fa-times"></span></button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>                                

                                                        </div>
                                                    </div> 
                                                <!-- END RESPONSIVE TABLES --> 
                                            </div>
                                        </div>
                                        
                                    </div>                                                                                                            
                                </div>
                                </form>
                            </div>                        
                            <!-- END WIZARD WITH VALIDATION -->

                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->
                <!-- MODALS -->        
                    <div class="modal" id="modalObjetivo" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="defModalHead">Basic Modal</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <form class="form-horizontal">
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-xs-12 control-label">Literal</label>
                                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                                <select class="form-control select">
                                                                    <option>A</option>
                                                                    <option>B</option>
                                                                    <option>C</option>
                                                                    <option>D</option>
                                                                    <option>E</option>
                                                                </select>
                                                                <span class="help-block">Select box example</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-xs-12 control-label">Descripción</label>
                                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                                <input type="text" class="form-control" row="5" value=""/>
                                                                <span class="help-block">Default textarea field</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-xs-12 control-label">Alcance</label>
                                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                                <select class="form-control select">
                                                                    <option>Option 1</option>
                                                                    <option>Option 2</option>
                                                                    <option>Option 3</option>
                                                                    <option>Option 4</option>
                                                                    <option>Option 5</option>
                                                                </select>
                                                                <span class="help-block">Select box example</span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label class="col-md-3 col-xs-12 control-label">Ambito</label>
                                                            <div class="col-md-6 col-xs-12">                                                                                            
                                                                <select class="form-control select">
                                                                    <option>Option 1</option>
                                                                    <option>Option 2</option>
                                                                    <option>Option 3</option>
                                                                    <option>Option 4</option>
                                                                    <option>Option 5</option>
                                                                </select>
                                                                <span class="help-block">Select box example</span>
                                                            </div>
                                                        </div>
                                                       
                                            </form>
                                            
                                        </div>
                                    </div>   
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- END MODALS -->   
                @push('PageScript')
                <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
               
                <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
                <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
                <script type="text/javascript" src="js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>        
                <script type="text/javascript" src="js/plugins/jquery-validation/jquery.validate.js"></script> 
                @endpush('PageScript')
@endsection('principal')