<div>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-check"></i> توجه!</h5>
        @foreach ($successMessages as $successMessage)
            <li> {{ $successMessage }}</li>
        @endforeach
    </div>
</div>
