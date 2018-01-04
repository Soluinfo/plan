<!-- START RESPONSIVE TABLES -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">{{$titleComponent}}</h3>
    </div>

    <div class="panel-body panel-body-table">

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-actions" id="{{$idcomponent}}">
                <thead>
                    {{$slot}}
                </thead>
                <tbody>                                            
                    
                </tbody>
            </table>
        </div>                                

    </div>
</div> 
<!-- END RESPONSIVE TABLES --> 