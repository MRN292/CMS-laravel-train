@extends('layouts.dashboard')



@section('content')
    <div class="d-flex justify-content-center">
        <div class="card mb-5 mt-3" style="width: 1200px">
            <img class="rounded" style="max-height:700px ; min-width = 1000px ; max-width:1200px ; min-height:500px"
                src="{{ asset("img/posts/$post->image") }}">
            <div class="card-header mt-2">
                <span class="card-title">
                    <i class="nav-icon fa fa-pencil-square-o"></i>
                    <small>نویسنده :</small>
                    <button class="btn btn=link" value="{{$user->id}}"> {{ $user->name }}</button>
                   
                </span>
                <span class="mr-5 float-left">
                    <i class="nav-icon fa fa-tags"></i>
                    @isset($genres)
                        @foreach ($genres as $genre)
                            @foreach ($post->genres as $genreID)
                                @if ($genreID == $genre->id)
                                    <button type="button" class="btn btn-link">{{ $genre->name }}</button>
                                @endif
                            @endforeach
                        @endforeach
                    @endisset

                </span>


            </div>
            <div class="card-body">

                <h1 class="mt-2 mb-4">
                    {{ $post->title }}
                </h1>
                <div>
                    {!! $post->description !!}
                </div>
            </div>
            <div class="card-footer">
                برچسب ها :

                @isset($tags)
                    @foreach ($tags as $tag)
                        @foreach ($post->tags as $tagID)
                            @if ($tagID == $tag->id)
                                <button type="button" class="btn btn-light"> {{ $tag->name }}</button>
                            @endif
                        @endforeach
                    @endforeach
                @endisset
            </div>
            <div class="card-footer" style="direction: ltr">
                <span> {{ $post->created_at }}</span>
                <small> :تاریخ انتشار</small>
            </div>


        </div>
    </div>
@endsection
