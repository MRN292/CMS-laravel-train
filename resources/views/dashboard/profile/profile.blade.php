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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>پروفایل</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">پروفایل کاربری</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        {{-- csrf --}}
        <meta name="csrf-token" content="{{ csrf_token() }}" />


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">

                                <img id="noImg" hidden src="{{ asset('img/users/user-null.png') }}"
                                    class="profile-user-img img-fluid img-circle" alt="User Image">

                                <img id="userImg" hidden style="width: 100px ; height:100px" src=""
                                    class="profile-user-img img-fluid img-circle" alt="User Image">


                            </div>

                            <h3 id="name" class="profile-username text-center"></h3>

                            <p id="userRole" class="text-muted text-center"></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>پست منتشر کرده</b> <a class="float-right"> 1,322</a>
                                </li>
                            </ul>

                            {{-- <a href="#" class="btn btn-primary btn-block"><b>دنبال کردن</b></a> --}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->

                    <div id="aboutMeSection" class="card card-primary" hidden>
                        <div class="card-header d-flex">

                            <h3 class="card-title"><i class="fa fa-file-text-o mr-1"></i> درباره من</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">


                            <p id="aboutMe" class="text-muted"></p>

                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">فعالیت‌ها</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">تایم لاین</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">اطلاعات شخصی</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('img/user1-128x128.jpg') }}" alt="user image">
                                            <span class="username">
                                                <a href="#">حسام موسوی</a>
                                                <a href="#" class="float-left btn-tool"><i
                                                        class="fa fa-times"></i></a>
                                            </span>
                                            <span class="description">ارسال شده در 25 آذر 1397</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>

                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                            گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                            برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                            کاربردی می باشد.
                                        </p>

                                        <p>
                                            <a href="#" class="link-black text-sm mr-2"><i
                                                    class="fa fa-share mr-1"></i> اشتراک گذاری</a>
                                            <a href="#" class="link-black text-sm"><i
                                                    class="fa fa-thumbs-o-up mr-1"></i> لایک</a>
                                            <span class="float-left">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="fa fa-comments-o mr-1"></i> نظر (5)
                                                </a>
                                            </span>
                                        </p>

                                        <input class="form-control form-control-sm" type="text"
                                            placeholder="نظر خود را وارد کنید">
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post clearfix">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('img/user7-128x128.jpg') }}" alt="User Image">
                                            <span class="username">
                                                <a href="#">نینا الکس</a>
                                                <a href="#" class="float-left btn-tool"><i
                                                        class="fa fa-times"></i></a>
                                            </span>
                                            <span class="description">ارسال شده - 3 روز پیش</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان
                                            گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و
                                            برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای
                                            کاربردی می باشد.
                                        </p>

                                        <form class="form-horizontal">
                                            <div class="input-group input-group-sm mb-0">
                                                <input class="form-control form-control-sm"
                                                    placeholder="نظر خود را تایپ کنید">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-danger">ارسال</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('img/user6-128x128.jpg') }}" alt="User Image">
                                            <span class="username">
                                                <a href="#">محمد محمدی</a>
                                                <a href="#" class="float-left btn-tool"><i
                                                        class="fa fa-times"></i></a>
                                            </span>
                                            <span class="description">ارسال شده - 5 روز پیش</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <img class="img-fluid" src="{{ asset('img/photo1.png') }}"
                                                    alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid mb-3" src="{{ asset('img/photo2.png') }}"
                                                            alt="Photo">
                                                        <img class="img-fluid" src="{{ asset('img/photo3.jpg') }}"
                                                            alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid mb-3" src="{{ asset('img/photo4.jpg') }}"
                                                            alt="Photo">
                                                        <img class="img-fluid" src="{{ asset('img/photo1.png') }}"
                                                            alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <p>
                                            <a href="#" class="link-black text-sm mr-2"><i
                                                    class="fa fa-share mr-1"></i> اشتراک گذاری</a>
                                            <a href="#" class="link-black text-sm"><i
                                                    class="fa fa-thumbs-o-up mr-1"></i> لایک</a>
                                            <span class="float-left">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="fa fa-comments-o mr-1"></i> نظر (5)
                                                </a>
                                            </span>
                                        </p>

                                        <input class="form-control form-control-sm" type="text"
                                            placeholder="نظر خود را تایپ کنید">
                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <ul class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-danger">
                                                10 Feb. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-envelope bg-primary"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                                <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                                    email</h3>

                                                <div class="timeline-body">
                                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                    weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                    quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-user bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>

                                                <h3 class="timeline-header no-border"><a href="#">Sarah Young</a>
                                                    accepted your friend request
                                                </h3>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-comments bg-warning"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 27 mins ago</span>

                                                <h3 class="timeline-header"><a href="#">Jay White</a> commented on
                                                    your post</h3>

                                                <div class="timeline-body">
                                                    Take me to your leader!
                                                    Switzerland is small and neutral!
                                                    We are more like Germany, ambitious and misunderstood!
                                                </div>
                                                <div class="timeline-footer">
                                                    <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                        comment</a>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <!-- timeline time label -->
                                        <li class="time-label">
                                            <span class="bg-success">
                                                3 Jan. 2014
                                            </span>
                                        </li>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <li>
                                            <i class="fa fa-camera bg-purple"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                                                <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new
                                                    photos</h3>

                                                <div class="timeline-body">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                    <img src="http://placehold.it/150x100" alt="..." class="margin">
                                                </div>
                                            </div>
                                        </li>
                                        <!-- END timeline item -->
                                        <li>
                                            <i class="fa fa-clock-o bg-gray"></i>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">
                                    <section>
                                        <label for="inputImg" class="col-sm-2 control-label">انتخاب عکس جدید</label>
                                        <input name="img" type="file" id="inputImg" class="form-controle">
                                        <button id="newImg" type="submit"
                                            class="btn btn-primary btn-sm">ذخیره</button>
                                    </section>

                                    <hr>
                                    <section class="form-horizontal" id="edit_form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputName" class="col-sm-2 control-label">نام</label>

                                            <div class="col-sm-10">
                                                <input id="inputName" name="name" class="form-control" id="inputName"
                                                    placeholder="نام" value="">
                                            </div>

                                            <div dir="rtl" style="color:red">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputUserName" class="col-sm-2 control-label">نام کاربری</label>

                                            <div class="col-sm-10">
                                                <input value="" name="username" class="form-control"
                                                    id="inputUsername" placeholder="نام کاربری">
                                            </div>

                                            <div dir="rtl" style="color:red">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="col-sm-2 control-label">ایمیل</label>

                                            <div class="col-sm-10">
                                                <input name="email" value="" type="email" id="inputEmail"
                                                    class="form-control" id="inputEmail" placeholder="ایمیل">
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
                                                <button type="submit" id="editButton"
                                                    class="btn btn-success">ثبت</button>
                                            </div>
                                        </div>
                                    </section>


                                    <hr>


                                    <form class="form-horizontal" method="POST" action="{{ route('edit_password') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="inputPassword" class="col-sm-2 control-label">رمز عبور
                                                قبلی</label>

                                            <div class="col-sm-10">
                                                <input name="prevPassword" type="password" dir="ltr"
                                                    class="form-control prev_password" id="inputPassword">
                                            </div>
                                            <div dir="rtl" style="color:red">
                                            </div>

                                            <label for="password" class="col-sm-2 control-label">رمز عبور جدید</label>

                                            <div class="col-sm-10">
                                                <input name="newPassword" type="password" dir="ltr"
                                                    class="form-control new_password" id="inputPassword">
                                            </div>
                                            <div dir="rtl" style="color:red">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-info btn-sm">تغییر</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    {{-- <script src="{{asset('js/dashboard/profile.js')}}"></script> --}}
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            function show() {
                $.ajax({
                    type: "post",
                    url: '{{ route('getProfile') }}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.user.image == null) {
                            $('#noImg').removeAttr('hidden');
                        } else {
                            $('#noImg').attr('hidden', true);
                            $('#userImg').removeAttr('hidden');
                            $('#userImg').attr('src', "{{ asset('img/users/') }}/" + response.user
                                .image);
                        }
                        $('#name').text(response.user.name);
                        $('#userRole').text(response.user.role);
                        if (response.user.description == null) {
                            $('#aboutMeSection').attr('hidden', true);
                        } else {
                            $('#aboutMeSection').removeAttr('hidden');
                            $('#aboutMe').text(response.user.description);
                        }
                        $('#inputName').val(response.user.name);
                        $('#inputUsername').val(response.user.username);
                        $('#inputEmail').val(response.user.email);
                        $('#inputAboutMe').text(response.user.description);
                        $('#inputImg').val(null);

                    }
                });
            }
            show();


            $(document).on('click', '#editButton', function() {

                var name = $('#inputName').val();
                var username = $('#inputUsername').val();
                var email = $('#inputEmail').val();
                var description = $('#inputAboutMe').val();
                if (username.length == 0 || email.length == 0) {
                    $('#errorMessage').html('');
                    $('#errorMessageSection').removeAttr('hidden');
                    $("#errorMessage").append('<li>' +
                        "فیلد های ضروری را پر کنید" + '</li>').hide().fadeIn(300);
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
                            url: "{{ route('edit_informations') }}",
                            data: {
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

                var img = $("#inputImg").prop('files')[0];
                if (img == null) {
                    $('#errorMessage').html('');
                    $('#errorMessageSection').removeAttr('hidden');
                    $("#errorMessage").append('<li>' +
                        "عکس انتخاب نشده" + '</li>').hide().fadeIn(300);
                } else {
                    if (img.size<=2097152) {
                        var form_data = new FormData();
                        form_data.append('img', img);
                        $.ajax({
                            type: "post",
                            url: "{{ route('add_user_img') }}",

                            data: form_data,
                            processData: false, // Set processData to false
                            contentType: false, //
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
                    }else{
                        $('#errorMessage').html('');
                    $('#errorMessageSection').removeAttr('hidden');
                    $("#errorMessage").append('<li>' +
                        "عکس انتخاب شده بزرگ تر از حد مجاز است" + '</li>').hide().fadeIn(300);
                    }

                }

            });
        });
    </script>
@endsection
