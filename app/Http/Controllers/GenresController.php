<?php

namespace App\Http\Controllers;

use App\Models\genres;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    //   
     public function index (){
        $genres=genres::all();
        return view('posts/categories')->with(['categories' => $genres]);
    }

    public function delete(Request $request){
        $cateId = $request->cateId;
        genres::where('id', $cateId)->delete();
        return redirect()->route('posts-categories')->with(['successMessages' => ['دسته بندی با موفقیت حذف شد']]);
        

    }
    public function add(Request $request){
        $genre = new genres();

        $genre->name = $request->genre;

        $genre->save();

        return redirect()->route('posts-categories')->with(['successMessages'=>['دسته بندی با موفقیت اضافه شد']]);

    }
}
