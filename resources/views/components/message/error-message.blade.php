<div>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fa fa-ban"></i> توجه!</h5>
        @foreach ($errorMessages as $errorMessage)
        <li> {{ $errorMessage }}</li>
           
        @endforeach
    </div>
</div>
