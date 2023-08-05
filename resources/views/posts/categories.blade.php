@extends('layouts.dashboard')


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">دسته بندی ها</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">پست ها</li>
                        <li class="breadcrumb-item active">درسته بندی ها</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if (session('successMessages'))
        <x-message.success-message :successMessages="session('successMessages')" />
    @endif

    @if (session('errorMessages'))
        <x-message.error-message :errorMessages="session('errorMessages')" />
    @endif
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-sm">
            <form method="post" action="{{ route('categories-add') }}" class="mt-6 space-y-6">
                @csrf
                <div class="mb-4">
                    <input name="genre" type="text" class="form-control" placeholder="دسته بندی ها" />
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-success" value="اضافه کردن">
                </div>
            </form>
        </div>
        @isset($categories)
            <div class=" mt-2 scrollable-list bg-white ">
                <ul>
                    <table class="table table-striped">
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    <form action="{{ route('categories-delete') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit" value="{{ $category->id }}"
                                            name="cateId">
                                            &times;
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </ul>
            </div>
        @endisset
    </div>

@endsection
