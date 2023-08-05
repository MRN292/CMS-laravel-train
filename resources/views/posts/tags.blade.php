@extends('layouts.dashboard')


@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">برچسب ها</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">پست ها</li>
                        <li class="breadcrumb-item active">برچسب ها</li>
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
            <form method="post" action="{{route('tags-add')}}" class="mt-6 space-y-6">
                @csrf
                <div class="mb-4">
                    <input name="tag" type="text" class="form-control" placeholder="برچسب" />
                </div>
                <div class="d-grid">
                    <input type="submit" class="btn btn-success" value="اضافه کردن">
                </div>
            </form>
        </div>
        @isset($tags)
            <div class=" mt-2 scrollable-list bg-white ">
                <ul>
                    <table class="table table-striped">
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->name }}
                                </td>
                                <td>
                                    <form action="{{route('tags-delete')}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger btn-sm" type="submit" value="{{ $tag->id }}"
                                            name="TagId">
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