@extends('layouts.dashboard')


@section('content')
    <!-- TABLE: LATEST ORDERS -->
    @if (session('successMessages'))
        <x-message.success-message :successMessages="session('successMessages')" />
    @endif

    @if (session('errorMessages'))
        <x-message.error-message :errorMessages="session('errorMessages')" />
    @endif

    <div class="col-md-12">

        <div id="successMessageSection" hidden>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-check"></i> توجه!</h5>
                <span id="successMessages"></span>
            </div>
        </div>

        <div id="errorMessageSection" hidden>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-ban"></i> توجه!</h5>
                <span id="errorMessage"></span>
            </div>
        </div>

    </div>

    <div class="col-md-12">
        <x-posts.posts-table :posts="$posts" />
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('.showCheck').change(function(e) {
                if ($(this).is(':checked')) {
                    // Checkbox is checked
                    let id = $(this).data('id');
                    $.ajax({
                        type: "post",
                        url: "{{ route('post-submit') }}",
                        data: {
                            'id': id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#errorMessage').attr('hidden', 'hidden');
                            $('#successMessageSection').removeAttr('hidden');
                            $("#successMessages").append('<li>' +
                                response.successMessages + '</li>').hide().fadeIn(300);
                        }
                    });
                } else {
                    // Checkbox is checked
                    let id = $(this).data('id');
                    $.ajax({
                        type: "post",
                        url: "{{ route('post-unsubmit') }}",
                        data: {
                            'id': id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#errorMessage').attr('hidden', 'hidden');
                            $('#successMessageSection').removeAttr('hidden');
                            $("#successMessages").append('<li>' +
                                response.successMessages + '</li>').hide().fadeIn(300);
                        }
                    });
                }

            });

            $('.post-delete').click(function(e) {
                let id = $(this).val();
                let tag = $(this).parent().parent();
                $.ajax({
                    type: "post",
                    url: "{{ route('post-delete')}}",
                    data: {
                        'id': id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // console.log(tag);
                        tag.fadeOut(300, function() {
                            $(this).remove();
                        });
                        $('#errorMessage').attr('hidden', 'hidden');
                        $('#successMessageSection').removeAttr('hidden');
                        $("#successMessages").append('<li>' +
                            response.successMessages + '</li>').hide().fadeIn(300);

                    }
                });
            });
        });
    </script>
@endsection
