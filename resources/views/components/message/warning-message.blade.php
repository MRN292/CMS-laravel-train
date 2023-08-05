<div>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-warning"></i> توجه!</h5>
        @foreach ($warningMessages as $warningMessage)
            <li>{{ $warningMessage }}</li>
        @endforeach
    </div>
</div>
