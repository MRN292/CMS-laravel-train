<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین اعضا</h3>

            <div class="card-tools">
                {{-- <span class="badge badge-danger">8 پیام جدید</span> --}}
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <ul class="users-list clearfix">

                @isset($users)
                    @foreach ($users as $user)
                        @if($user->id==auth()->user()->id) @continue @endif
                        <li>
                            @if ($user->image == null)
                                <img src="{{ asset('img/users/user-null.png') }}" alt="User Image">
                            @else
                                <img src="{{ asset("img/users/$user->image") }}" alt="User Image">
                            @endif

                            <a class="users-list-name mt-2" href="#">
                                @if ($user->name == null)
                                    ناشناس
                                @else
                                    {{ $user->name }}
                                @endif
                            </a>
                            <span class="users-list-date">{{ $user->role }}</span>
                        </li>
                    @endforeach
                @endisset

            </ul>
            <!-- /.users-list -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
            <a href="{{ route('users-table') }}">مشاهده همه کاربران</a>
        </div>
        <!-- /.card-footer -->
    </div>
</div>
