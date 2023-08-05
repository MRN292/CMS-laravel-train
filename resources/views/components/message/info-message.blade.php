<div>
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-check"></i> توجه!</h5>
        @foreach ($infoMessages as $infoMessage)
            <li>{{ $infoMessage }}</li>
        @endforeach
    </div>
</div>
