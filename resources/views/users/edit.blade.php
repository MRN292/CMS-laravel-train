@extends('layouts.dashboard')

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
    <input id="user_id" value="{{ $user_id }}" hidden>
    <div class=" d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <section>
                    <img style="width: 100px ; height:100px" class="profile-user-img img-fluid img-circle" id="userImg"
                        src="" alt="">
                    <label for="inputImg" class="col-sm-2 control-label">انتخاب عکس جدید</label>
                    <input name="img" type="file" id="inputImg" class="form-controle">
                    <button id="newImg" type="submit" class="btn btn-primary btn-sm">ذخیره</button>
                </section>
            </div>
        </div>
    </div>
    <div class=" d-flex justify-content-center">

        <div class="col-md-9">
            <div class="card">
                <section class="form-horizontal" id="edit_form">
                    <meta name="csrf-token" content="{{ csrf_token() }}">


                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">نام</label>

                        <div class="col-sm-10">
                            <input id="inputName" name="name" class="form-control" placeholder="نام" >
                        </div>

                        <div dir="rtl" style="color:red">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUsername" class="col-sm-2 control-label">نام کاربری</label>

                        <div class="col-sm-10">
                            <input  name="username" class="form-control" id="inputUsername"
                                placeholder="نام کاربری">
                        </div>

                        <div dir="rtl" style="color:red">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">ایمیل</label>

                        <div class="col-sm-10">
                            <input name="email"  type="email" id="inputEmail" class="form-control" placeholder="ایمیل">
                        </div>

                        <div dir="rtl" style="color:red">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputExperience" class="col-sm-2 control-label">یادداشت</label>

                        <div class="col-sm-10">
                            <textarea name="description" class="form-control" id="inputAboutMe" placeholder="درباره من"></textarea>
                        </div>

                        <div dir="rtl" style="color:red">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" id="editButton" class="btn btn-success">ثبت</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </div>
    <div class=" d-flex justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <label for="inputPassword" class=" mt-2 col-sm-2 control-label">رمز عبور</label>

                <div class="col-sm-10">
                    <input id="inputPassword" type="password" name="password" class="form-control"
                        placeholder="رمز عبور" value="">
                </div>
                <div class="form-group">
                    <div class=" mt-2 col-sm-offset-2 col-sm-10">
                        <button type="submit" id="editPassword" class="btn btn-success">ثبت</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {


            function show() {
                var id = $('#user_id').val();

                $.ajax({
                    type: "post",
                    url: '{{ route('users_edit_getinfo') }}',
                    data: {
                        'user_id': id,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $("#inputName").val(response.user.name);
                        $("#inputUsername").val(response.user.username);
                        $("#inputEmail").val(response.user.email);
                        $("#inputAboutMe").val(response.user.description);
                        if (response.user.image == null) {
                            $('#userImg').attr('src', "{{ asset('img/users/user-null.png') }}");
                        } else {
                            $('#userImg').attr('src', "{{ asset('img/users/') }}/" + response.user
                                .image);
                        }
                        $('#user_id').val(response.user.id);

                    }
                });
            }
            show();


            $(document).on('click', '#editButton', function() {
                var id = $('#user_id').val();

                var name = $('#inputName').val();
                var username = $('#inputUsername').val();
                var email = $('#inputEmail').val();
                var description = $('#inputAboutMe').val();
                if (name.length == 0 || username.length == 0) {
                    $('#errorMessage').html('');
                    $('#errorMessageSection').removeAttr('hidden');
                    $("#errorMessage").append('<li>' +
                        "فیلد های ضروری را وارد کنید" + '</li>').hide().fadeIn(300);
                } else {
                    var errorString = '';
                    var flag = false;
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
                    if (flag == false) {

                        $.ajax({
                            type: "post",
                            url: "{{ route('user_edit_informations') }}",
                            data: {
                                'id': id,
                                'name': name,
                                'username': username,
                                'email': email,
                                'description': description
                            },
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {

                                if (response.successMessages) {
                                    $('#successMessages').html('');

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


            $(document).on('click', '#newImg', function() {
                var id = $('#user_id').val();

                var img = $("#inputImg").prop('files')[0];
                if (img == null) {
                    $('#errorMessage').html('');
                    $('#errorMessageSection').removeAttr('hidden');
                    $("#errorMessage").append('<li>' +
                        "عکس انتخاب شده" + '</li>').hide().fadeIn(300);
                } else {
                    if (img.size <= 2097152) {
                        var form_data = new FormData();
                        form_data.append('img', img);
                        form_data.append('id', id);
                        $.ajax({
                            type: "post",
                            url: "{{ route('user_edit_img') }}",

                            data: form_data,
                            processData: false, // Set processData to false
                            contentType: false, //
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#successMessages').html('');
                                if (response.successMessages) {
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
                        $('#errorMessage').html('');
                        $('#errorMessageSection').removeAttr('hidden');
                        $("#errorMessage").append('<li>' +
                            "عکس انتخاب شده بزرگ تر از حد مجاز است" + '</li>').hide().fadeIn(300);
                    }


                }
            });


            $(document).on('click', '#editPassword', function() {
                var id = $('#user_id').val();

                var password = $('#inputPassword').val();

                if (password.trim().length == 0) {
                    $('#errorMessage').html('');

                    $('#errorMessageSection').removeAttr('hidden');
                    $("#errorMessage").append('<li>' +
                        "فیلد رمز خالی است" + '</li>').hide().fadeIn(300);
                } else {
                    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
                    if (passwordRegex.test(password)) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('user_edit_password') }}",

                            data: {
                                'id': id,
                                'password': password,
                            },

                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.successMessages) {
                                    $('#successMessages').html('');
                                    for (let x of response.successMessages) {

                                        $('#errorMessage').attr('hidden', 'hidden');
                                        $('#successMessageSection').removeAttr('hidden');
                                        $("#successMessages").append('<li>' +
                                            x + '</li>').hide().fadeIn(300);
                                        $('#inputPassword').val('');
                                    }
                                    show();
                                } else {
                                    $('#errorMessage').html('');
                                    for (let x of response.errorMessages) {

                                        $('#successMessages').attr('hidden', 'hidden');
                                        $('#errorMessageSection').removeAttr('hidden');
                                        $("#errorMessage").append('<li>' +
                                            x + '</li>').hide().fadeIn(300);
                                    }
                                }
                            }
                        });
                    } else {
                        $('#errorMessage').html('');

                        $('#errorMessageSection').removeAttr('hidden');
                        $("#errorMessage").append('<li>' +
                            "رمز نامعتبر است" + '</li>').hide().fadeIn(300);
                    }


                }

            });
        });
    </script>
@endsection
