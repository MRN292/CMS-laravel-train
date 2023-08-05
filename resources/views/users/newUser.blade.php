@extends('layouts/dashboard')


@section('content')
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

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>کاربر جدید</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">کاربران</li>
                        <li class="breadcrumb-item active">کاربر جدید</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="card">
        <section class="content">
            <div class=" container-fluid">
                <section class="form-horizontal mt-3" id="edit_form">
                    <meta name="csrf-token" content="{{ csrf_token() }}">


                    <div class="form-group">
                        <label for="inputUserName" class="col-sm-2 control-label">نام کاربری</label>

                        <div class="col-sm-10">
                            <input value="" name="username" class="form-control" id="inputUsername"
                                placeholder="نام کاربری">
                        </div>

                        <div dir="rtl" style="color:red">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">ایمیل</label>

                        <div class="col-sm-10">
                            <input name="email" value="" type="email" id="inputEmail" class="form-control"
                                id="inputEmail" placeholder="ایمیل">
                        </div>

                        <div dir="rtl" style="color:red">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-sm-2 control-label">رمز عبور</label>

                        <div class="col-sm-10">
                            <input name="password" value="" type="password" id="inputPassword" class="form-control">
                        </div>

                        <div dir="rtl" style="color:red">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="col-sm-2 control-label">سمت</label>

                        <select name="role" id="inputRole">
                            <option value="manager">مدیر</option>
                            <option value="writer">نویسنده</option>
                            <option value="user">کاربر</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" id="newUserButton" class="btn btn-success">ثبت</button>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#newUserButton', function() {
                var username = $('#inputUsername').val();
                var email = $('#inputEmail').val();
                var password = $('#inputPassword').val();
                var role = $('#inputRole').val();
                if (email.length == 0 || username.length == 0 || password.length == 0) {
                    $('#errorMessage').html('');
                    $('#errorMessageSection').removeAttr('hidden');
                    $("#errorMessage").append('<li>' +
                        "فیلد های ضروری را وارد کنید" + '</li>').hide().fadeIn(300);
                } else {
                    var errorString = '';
                    var flag = false;
                    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
                    // var regName = /^[\u0600-\u06FF\s]+$/;
                    var regUsername = /^[a-zA-Z0-9]+$/;
                    var regEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                    // if (regName.test(name) == false) {

                    //     errorString += '<li>' +
                    //         "نام نامعتبر می باشد" + '</li>';
                    //     flag = true;
                    // }
                    if (regEmail.test(email) == false) {
                        errorString += '<li>' +
                            "ایمیل معتبر نمی باشد" + '</li>';
                        flag = true;
                    }
                    if (regUsername.test(username) == false) {
                        errorString += '<li>' +
                            "نام کاربری معتبر نمی باشد" + '</li>';
                        flag = true;
                    }
                    if (passwordRegex.test(password) == false) {
                        errorString += '<li>' +
                            "رمز عبور معتبر نمی باشد" + '</li>';
                        flag = true;
                    }
                    if (flag == false) {

                        $.ajax({
                            type: "post",
                            url: "{{ route('add-user') }}",
                            data: {
                                'username': username,
                                'email': email,
                                'password': password,
                                'role': role
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                if (response.successMessages) {
                                    $('#successMessages').html('');

                                    $('#inputUsername').val('');
                                    $('#inputEmail').val('');
                                    $('#inputPassword').val('');

                                    for (let x of response.successMessages) {
                                        $('#successMessageSection').removeAttr('hidden');
                                        $("#successMessages").append('<li>' +
                                            x + '</li>').hide().fadeIn(300);
                                    }
                                    show();
                                } else {
                                    $('#errorMessage').html('');

                                    for (let x of response.errorMessages) {
                                        $('#errorMessageSection').removeAttr('hidden');
                                        $("#errorMessage").append('<li>' +
                                            x + '</li>').hide().fadeIn(300);
                                    }
                                }
                            }
                        });
                    } else {
                        // console.log(errorString);
                        $('#errorMessage').html('');
                        $('#errorMessageSection').removeAttr('hidden');
                        $("#errorMessage").append(errorString).hide().fadeIn(300);
                    }
                }
            })
        });
    </script>
@endsection
