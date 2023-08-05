@extends('layouts.dashboard')


@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css') }}">

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
    <!-- /.card -->
    <div class="col-md-12">
        <x-users.users-table :users="$users" />

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('change', '#banCheck',function() {
                if ($(this).is(':checked')) {
                    // Checkbox is checked
                    let id = $(this).data('id');
                    $.ajax({
                        type: "post",
                        url: "{{ route('users-ban') }}",
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
                    // Checkbox is unchecked
                    let id = $(this).data('id');
                    $.ajax({
                        type: "post",
                        url: "{{ route('users-unBan') }}",
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
            $(document).on('click', '#user-delete',function() {
                let id = $(this).val();
                let tag = $(this).parent().parent();
                $.ajax({
                    type: "post",
                    url: "{{ route('users-delete') }}",
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
            
            $(document).on('change', '#role', function() {
                console.log('change');
                let id = $(this).data('id');
                let role = $(this).val();
                $.ajax({
                    type: "post",
                    url: "{{ route('users-changeRole') }}",
                    data: {
                        'id': id,
                        'role': role,
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
            });

        });
    </script>
@endsection
