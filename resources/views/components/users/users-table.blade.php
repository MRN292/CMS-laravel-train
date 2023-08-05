<div>
    <link rel="stylesheet" href="{{ asset('css/usersTable.css') }}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">کاربران</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="#">خانه</a></li>
                        <li class="breadcrumb-item active">مدیریت</li>
                        <li class="breadcrumb-item active">کاربران</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0 ">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    
                    
                    <table class="table table-hover" id="data-tableb">

                        <tr>
                            <th>عکس</th>
                            <th>شناسه</th>
                            <th>نام کاربری</th>
                            <th>تاریخ عضویت</th>
                            <th>مسدودیت</th>
                            <th>سمت</th>
                            <th>عملیات</th>
                        </tr>

                        @foreach ($users as $user)
                            {{-- <input id="userId" type="text" hidden value="{{$user->id}}"> --}}
                            @if ($user->id == auth()->user()->id)
                                @php
                                    continue;
                                @endphp
                            @endif
                            <tr>
                                <td>
                                    @if ($user->image == null)
                                        <img style="width: 40px ; height:40px" class="rounded-circle"
                                            src="{{ asset('img/users/user-null.png') }}" alt="User Image">
                                    @else
                                        <img style="width: 40px ; height:40px" class="rounded-circle"
                                            src="{{ asset("img/users/$user->image") }}" alt="User Image">
                                    @endif
                                </td>
                                <td>{{ $user->id }} </td>
                                <td>{{ $user->username }} </td>
                                <td>{{ $user->created_at }} </td>
                                <td>
                                    <label class="toggle">

                                        <input data-id='{{ $user->id }}' class="toggle-checkbox" id="banCheck"
                                            type="checkbox"
                                            @php
if ($user->banned == 1) {
                                                echo "checked";
                                            } @endphp>
                                        <div class="toggle-switch"></div>
                                    </label>
                                </td>
                                <td>
                                    <form class="m-2" action="{{ route('users-changeRole') }}" method='post'>
                                        @csrf
                                        <select name="role" id="role" data-id="{{$user->id}}">
                                            @if ($user->role == 'manager')
                                                <option value="manager" selected>مدیر</option>
                                                @else
                                                <option value="manager">مدیر</option>
                                            @endif
                                            @if ($user->role == 'writer')
                                                <option value="writer" selected>نویسنده</option>
                                                @else
                                                <option value="writer">نویسنده</option>
                                            @endif
                                            @if ($user->role == 'user')
                                                <option value="user" selected>کاربر</option>
                                                @else
                                                <option value="user">کاربر</option>

                                            @endif
                                        </select>
                                    </form>
                                </td>
                                <td class="d-flex">

                           
                                    {{-- <form action="{{ route('users-delete') }}" method="post">
                                        @csrf
                                    </form> --}}
                                    <button value="{{ $user->id }}" id="user-delete"
                                        class="btn btn-danger btn-sm m-2">حذف</button>
                                    <a href="{{ route('users-edit', $user->id) }}"
                                        class="btn btn-info btn-sm m-2">ویرایش</a>


                                </td>

                            </tr>
                        @endforeach


                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div><!-- /.row -->
</div>
