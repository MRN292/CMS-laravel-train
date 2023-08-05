<?php

namespace App\Http\Controllers;

use App\Models\genres;
use App\Models\posts;
use App\Models\tags;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;


class PostsController extends Controller
{

    public function landing()
    {
        $posts = posts::where('published', 1)->get();
        foreach ($posts as $post){
            $userId = $post->writer_id;
            $user = User::find($userId);
            $post->user = $user;
        }
        return view('welcome', ['posts' => $posts]);
    }

    public function index()
    {
        if (auth()->user()->role == 'mangager') {
            $posts = posts::whereNull('deleted_at')->get();
            return view('posts/allPosts', ['posts' => $posts]);
        } else {
            $posts = posts::whereNull('deleted_at')->where('writer_id', auth()->user()->id)->get();
            return view('posts/allPosts', ['posts' => $posts]);
        }
    }

    public function showPost($id)
    {

        $post = posts::find($id);
        if ($post->published == 0 && auth()->user()->role != 'manager') {
            abort(403, 'Unauthorized.');
        }
        $tags = tags::all();
        $genres = genres::all();

        $post->genres = explode(" / ", $post->genres);
        $post->tags = explode(" / ", $post->tags);
        $userId = $post->writer_id;
        $user = User::find($userId);


        return view('posts/post', ['post' => $post, 'genres' => $genres, 'tags' => $tags, 'user' => $user]);
    }

    public function delete(Request $request)
    {
        $post = posts::find($request->id);
        $post->delete();
        return response()->json(["successMessages" => ['با موفقیت حذف شد']]);
    }

    public function submit(Request $request)
    {
        $post = posts::where(['id' => $request->id])->update(['published' => 1]);

        return response()->json(["successMessages" => ['پست منشتر شد']]);
    }

    public function unsubmit(Request $request)
    {
        $post = posts::where(['id' => $request->id])->update(['published' => 0]);

        return response()->json(["successMessages" => ['لغو انتشار با موفقیت انجام شد']]);
    }

    public function show()
    {
        $tags = tags::all();
        $genres = genres::all();
        return view('posts/newpost', ['tags' => $tags, 'genres' => $genres]);
    }

    //
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'main_img' => 'nullable|file|max:20480|mimes:png,jpg,jpeg,gif',
            'title' => "required|max:255",
            'description' => "required",
            'genres' => "required",
            "tags" => "required"
        ]);
        if ($validator->passes()) {
            $post = posts::findOrFail($request->postId);
            $post->title = $validator->validated()['title'];
            if ($request->main_img !== null) {
                $extension = $validator->validated()['main_img']->getClientOriginalExtension();
                $fileName = time() . '.' . $extension;
                $validator->validated()['main_img']->move(public_path('img/posts'), $fileName);

                $post->image = $fileName;
            }

            $post->description = $validator->validated()['description'];


            $string = "";
            $genres = $validator->validated()['genres'];
            foreach ($genres as $genre) {
                $string .= $genre . " / ";
            };
            $post->genres = $string;

            $tags = $validator->validated()['tags'];
            $string = "";
            foreach ($tags as $tag) {
                $string .= $tag . " / ";
            };
            $post->tags = $string;
            $post->published = 0;

            $post->save();

            return back()->with(['successMessages' => ["پست با موفقیت ویرایش شد"]]);
        }
        return back()->with(['errorMessages' => $validator->errors()->all()]);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'title' => "required|max:255",
            'main_img' => 'required|file|max:20480|mimes:png,jpg,jpeg,gif',
            'description' => "required",
            'genres' => "required",
            "tags" => "required"
        ]);
        if ($validator->passes()) {
            $post = new posts();
            $post->title = $validator->validated()['title'];

            $extension = $validator->validated()['main_img']->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $validator->validated()['main_img']->move(public_path('img/posts'), $fileName);

            $post->image = $fileName;
            $post->writer_id = auth()->user()->id;
            $post->description = $validator->validated()['description'];


            $string = "";
            $genres = $validator->validated()['genres'];
            foreach ($genres as $genre) {
                $string .= $genre . " / ";
            };
            $post->genres = $string;

            $tags = $validator->validated()['tags'];
            $string = "";
            foreach ($tags as $tag) {
                $string .= $tag . " / ";
            };
            $post->tags = $string;

            $post->save();

            return view('posts/newPost', ['successMessages' => ["پست با موفقیت در صف تایید قرار گرفت"]]);
        }
        return view('posts/newPost')->with(['errorMessages' => $validator->errors()->all()]);
    }


    public function PostImgUpload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('img/posts'), $fileName);

            $url = asset('img/posts/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => true, 'url' => $url]);
        }
    }

    public function edit($id)
    {
        $post = posts::where('id', $id)->first();
        $tags = tags::all();
        $genres = genres::all();

        $post->genres = explode(" / ", $post->genres);
        $post->tags = explode(" / ", $post->tags);
        return view('posts/editPost', ['post' => $post, 'genres' => $genres, 'tags' => $tags]);
    }
}
