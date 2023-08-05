@extends('layouts.dashboard')

@section('content')
    <div class="container mt-5">
        <div class="jumbotron">
            <h1>به سایت دل پژوهان غرب خوش آمدید</h1>
            <p class="lead mt-3">در اینجا میتوانید پست های خود را با ما به اشتراک بگذارید</p>
        </div>

        <div class="row">
            @isset($posts)
                @foreach($posts as $post)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ asset('img/posts/'.$post->image) }}" class="card-img-top" alt="Post Image">
                            <div class="card-body">
                                <form action="{{ route('post-show', $post->id) }}" method="get">
                                    <button class="btn btn-link card-title">{{ $post->title }} </button>
                                </form>
                            </div>
                            <div class="d-flex"><label class=" mr-3 text-secondary" for="author">نویسنده:</label>
                                <p class="mr-3" id="author">{{$post->user->name}}</p></div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
@endsection

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('js/adminlte.js') }}"></script>
