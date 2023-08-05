<?php

namespace App\Http\Controllers;

use App\Models\tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    //


    public function index (){
        $tags=tags::all();
        return view('posts/tags')->with(['tags' => $tags]);
    }
    public function delete(Request $request){
        $tagId = $request->TagId;
        tags::where('id', $tagId)->delete();
        return redirect()->route('posts-tags')->with(['successMessages' => ['برچسب با موفقیت حذف شد']]);
        

    }
    public function add(Request $request){
        $tag = new tags();

        $tag->name = $request->tag;

        $tag->save();

        return redirect()->route('posts-tags')->with(['successMessages'=>['برچسب با موفقیت اضافه شد']]);
    }
}
