<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="{{ route('dashboard-third') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">پنل مدیریت</span>
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar" style="direction: ltr">
        <div style="direction: rtl">
            <!-- Sidebar user panel (optional) -->
            @auth
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (auth()->user()->image == null)
                            <img src="{{ asset('img/users/user-null.png') }}" class="img-circle elevation-2"
                                 alt="User Image">
                        @else
                            <img style="width: 30px ; height:30px"
                                 src="{{ asset('img/users/' . auth()->user()->image) }}"
                                 class="img-circle elevation-2" alt="User Image">
                        @endif

                    </div>
                    <div class="info d-flex">
                        <a href="{{ route('dashboard-profile') }}" class="d-block">
                            {{ auth()->user()->username }}
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="mr-5 btn" style="background-color:transparent" class="nav-link">
                                <i style="color: white" class="nav-icon fa fa-sign-in"></i>
                            </button>
                        </form>
                    </div>

                </div>
            @else
                <div class="nav nav-pills user-panel mt-3 pb-3 mb-3 d-flex">

                    <a style=" margin-right:20px; font-size: 19px" class="" href="{{ route('login') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <i style="color: white" class="nav-icon fa fa-sign-in ml-2"></i> ورود
                        کاربر</a>

                </div>
            @endauth
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
                    @auth
                        <li class="nav-item has-treeview">
                            {{-- active --}}
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    داشبوردها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">


                                <li class="nav-item">
                                    <a href="{{ route('dashboard-profile') }}" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>پروفایل</p>
                                    </a>
                                </li>
                                @if (auth()->user()->role == 'manager')
                                    <li class="nav-item">
                                        <a href="{{ route('dashboard-management') }}" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مدیریت</p>
                                        </a>
                                    </li>
                                @endif
                                @endauth

                            </ul>
                        </li>

                        @auth
                            @if (auth()->user()->role == 'manager')
                                <li class="nav-item has-treeview">
                                    {{-- active --}}
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-user"></i>
                                        <p>
                                            کاربران
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('users-table') }}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>تمام کاربران</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('new-user')}}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>اضافه کردن کاربر</p>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            @endif
                        @endauth

                        @auth
                            @if (auth()->user()->role == 'manager' || auth()->user()->role == 'writer')
                                <li class="nav-item has-treeview">
                                    {{-- active --}}
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fa fa-pencil"></i>
                                        <p>
                                            نوشته ها
                                            <i class="right fa fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('posts-all') }}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>تمام نوشته ها</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('posts-newpost') }}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>نوشته جدید</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('posts-categories') }}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>دسته ها</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('posts-tags') }}" class="nav-link">
                                                <i class="fa fa-circle-o nav-icon"></i>
                                                <p>برچسب ها</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @endauth
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
