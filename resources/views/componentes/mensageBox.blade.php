<!-- default with sound -->
<div class="message-box message-box-info animated fadeIn" data-sound="alert" id="message-box-sound-1">
    <div class="mb-container">
        <div class="mb-middle">
            <div class="mb-title"><span class="fa fa-globe"></span> {{$titleComponent}}</div>
            <div class="mb-content">
                {{$slot}}                    
            </div>
            <div class="mb-footer">
                <button class="btn btn-info btn-lg pull-right mb-control-close">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- end default with sound -->