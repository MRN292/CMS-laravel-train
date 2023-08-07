<div>
    <link rel="stylesheet" href="{{ asset('css/usersTable.css') }}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">پست ها</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">مدیریت</li>
                        <li class="breadcrumb-item active">پست ها</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="table-responsive">

                <meta name="csrf-token" content="{{ csrf_token() }}">

                <table class="table m-0">
                    <thead>
                    <tr>
                        <th>عکس</th>
                        <th>ای دی پست</th>
                        <th>پست</th>
                        <th>وضعیت انتشار</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($posts)
                        @foreach ($posts as $post)

                            <tr>
                                <td>
                                    <img style="height: 50px; width: 50px" class="rounded-circle"
                                         src="{{ asset("img/posts/$post->image") }}" alt="post Image">
                                </td>
                                <td>
                                    <form action="{{ route('post-show', $post->id) }}" method="get">
                                        <button class="btn btn-link">{{ $post->id }} </button>
                                    </form>
                                </td>
                                <td>
                                    {{ $post->title }}
                                </td>
                                @if (auth()->user()->role == 'manager')
                                    <td>
                                        <label class="toggle">

                                            <input data-id='{{ $post->id }}' class="toggle-checkbox showCheck"
                                                   type="checkbox"
                                                @php
                                                    if ($post->published == 1) { echo "checked";
                                                    } @endphp>
                                            <div class="toggle-switch"></div>
                                        </label>
                                    </td>

                                @else
                                    <td>
                                        @if ($post->published == 0)
                                            <span class="badge badge-warning">
                                                در انتضار انتشار</span>
                                        @elseif($post->published == 1)
                                            <span class="badge badge-success">
                                                منتشر شده</span>
                                        @endif
                                    </td>
                                @endif
                                <td class="d-flex">
                                    <form action="{{ route('post-edit', $post->id) }}" method="GET">

                                        <button class="m-1 text-white btn btn-info btn-sm">ویرایش</button>

                                    </form>
                                    <button value="{{$post->id}}" type="submit"
                                            class="m-1 text-white btn btn-danger btn-sm post-delete">حذف
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <form method="GET" action="{{ route('posts-newpost') }}">
                <button class="btn btn-sm btn-info float-left">پست جدید</button>
            </form>
        </div>
        <!-- /.card-footer -->
    </div>
</div>
