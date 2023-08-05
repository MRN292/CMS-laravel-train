@extends('layouts.dashboard')


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>پست جدید</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">پست جدید</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="col-md-12">
        @isset($successMessages)
            <x-message.success-message :successMessages="$successMessages" />
        @endisset


        @isset($errorMessages)
            <x-message.error-message :errorMessages="$errorMessages" />
        @endisset
    </div>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">

                <div class="col-md-12">

                    {{-- title --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                موضوع
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <input class="post-title form-control" type="text"
                                style="width: 100% ; border: 1px solid #dddddd;" name="title"
                                placeholder="لطفا متن خود را وارد کنید">

                        </div>
                    </div>
                    {{-- main-img --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                عکس شاخص
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <input class="form-control" type="file" name='main_img' id="formFile">
                                <small>عکس نباید بیشتر از 20 مگابایت باشد ، فرمت های مجاز GIF PNG JPG JPEG هستند</small>
                            </div>

                        </div>
                    </div>
                    <!-- /.card -->
                    {{-- description --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                توضیحات
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad">
                            <div class="mb-3">
                                <textarea dir="ltr" id="editor" class="form-control" placeholder="لطفا متن خود را وارد کنید"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                    name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-info mt-4" type="submit">تایید</button>
                </div>
                <!-- /.col-->

            </div>
            <!-- ./row -->
        </form>
    </section>
    <!-- /.content -->

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <script src="{{ asset('js/demo.js') }}"></script>
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('Post.img.upload') . '?_token=' . csrf_token() }}'
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
