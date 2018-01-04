<!-- MODALS -->        
<div class="modal" id="{{$idmodal}}" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
        <div class="modal-dialog {{$tamanomodal}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="defModalHead">{{$titulomodal}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            {{$slot}}                            
                            
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