<div>
    <!-- When there is no desire, all things are at peace. - Laozi -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">آخرین پست ها</h3>

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

                @foreach ($posts as $post)
                    <li>
                        <img class="img-thumbnail" style="height: 150px; width: 150px"
                            src="{{ asset("img/posts/$post->image") }}" alt="User Image">
                        <a class="users-list-name mt-2" href="#">{{ $post->title }} </a>
                        <span class="users-list-date">
                            @if ($post->published == 0)
                                منتشر نشده
                            @else
                                منتشر شده
                            @endif
                        </span>
                        <br>
                        <span class="users-list-date">
                            {{ $post->writer }}
                        </span>
                    </li>
                @endforeach

            </ul>
            <!-- /.users-list -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer text-center">
            <a href="{{ route('posts-all') }}">مشاهده همه پست ها</a>
        </div>
        <!-- /.card-footer -->
    </div>
</div>
