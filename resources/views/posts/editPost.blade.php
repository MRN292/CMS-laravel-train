@extends('layouts.dashboard')

@section('links')
    <link rel="stylesheet" href="{{ asset('css/multi-select-tag.css') }}">
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>ویرایش پست</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">نوشته ها</li>
                        <li class="breadcrumb-item active">ویراش پست ها</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            @if (session('successMessages'))
                <x-message.success-message :successMessages="session('successMessages')" />
            @endif

            @if (session('errorMessages'))
                <x-message.error-message :errorMessages="session('errorMessages')" />
            @endif
        </div>
        <form action="{{ route('post-update') }}" method="POST" enctype="multipart/form-data">
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

                            <input value='{{ $post->title }}' class="post-title form-control" type="text"
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
                                <img width="250px" src="{{ asset("img/posts/$post->image") }}" class="img-thumbnail">
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
                                <textarea dir="rtl" id="editor" class="form-control" placeholder="لطفا متن خود را وارد کنید" name="description"></textarea>


                            </div>
                        </div>
                    </div>

                    <div class="d-flex"">

                        <div class="card col-6">
                            <div class="card-header">
                                <h3 class="card-title">
                                    دسته بندی ها
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <select name="genres[]" id="genres" multiple class="form-select">
                                        @isset($genres)
                                            @foreach ($genres as $genre)
                                                <option value="{{ $genre->id }}"
                                                    @foreach ($post->genres as $genreID)
                                                    @if ($genreID == $genre->id)
                                                    selected
                                                    @endif @endforeach>

                                                    >{{ $genre->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card col-6"">
                            <div class="card-header">
                                <h3 class="card-title">
                                    برچسب ها
                                </h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pad">
                                <div class="mb-3">
                                    <select name="tags[]" id="tags" multiple class="form-select">
                                        @isset($tags)
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    @foreach ($post->tags as $tagID)
                                                    @if ($tagID == $tag->id)
                                                    selected
                                                    @endif @endforeach>
                                                    {{ $tag->name }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button value="{{ $post->id }}" name="postId" class="btn btn-info mt-4"
                        type="submit">تایید</button>
                </div>
                <!-- /.col-->

            </div>
            <!-- ./row -->
        </form>
    </section>
    <!-- /.content -->



@endsection

@section('scripts')
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/multi-select-tag.js') }}"></script>
    <script>
        new MultiSelectTag('genres');
        new MultiSelectTag('tags');
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('Post.img.upload') . '?_token=' . csrf_token() }}'
                },
                language: {
                    ui: 'en', // Set UI language to English
                    content: 'fa' // Set content language to Arabic
                }
            })
            .then(editor => {
                editor.setData('{!! addslashes($post->description) !!}');
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
