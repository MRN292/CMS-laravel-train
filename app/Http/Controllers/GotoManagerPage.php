<?php


namespace App\Http\Controllers;

use App\Models\posts;
use App\Models\User;
use App\Models\roles;


use Illuminate\Http\Request;

class GotoManagerPage extends Controller
{
    public function index(){
        $posts = posts::take(8)->get();
        

        $users = User::take(8)->get();

        return view('dashboard/manager/manager' , compact('posts' , 'users'));
    }
}