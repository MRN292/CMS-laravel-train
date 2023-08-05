<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function showTable()
    {
        $users = User::whereNull('deleted_at')->get();
        return view('users/users', ['users' => $users]);
    }
    public function changeRole(Request $request)
    {
        $role = $request->role;
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->role = $role;
        $user->save();
        return response()->json(['successMessages' => ['سمت با موفقیت ویرایش شد']]);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        User::where('id', $id)->delete();
        return response()->json(['successMessages' => ['کاربر با موفقیت حذف شد']]);
    }
    public function ban(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->banned = 1;
        $user->save();
        return response()->json(['successMessages' => ['کاربر مسدود شد']]);
    }
    public function unBan(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        $user->banned = 0;
        $user->save();
        return response()->json(['successMessages' => ['کاربر رفع مسدودیت شد']]);
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        // dd($user);
        return view('users/edit', ['user_id' => $user->id]);
    }
    public function getinfo(Request $request)
    {
        $user_id  = $request->user_id;
        $user = User::findOrFail($user_id);
        return response()->json(['user' => $user]);
    }
    public function edit_info(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => "required|max:255 |min:3 | regex:/^[\p{Arabic}\s]+$/u",
            'email' => "required|email |unique:users,email," . $request->id,
            "username" => "required | alpha_dash| min:3|unique:users,username," . $request->id,
        ]);
        if ($validator->passes()) {
            $user = User::findOrFail($request->id);
            $user->name = $validator->validated()['name'];
            $user->email = $validator->validated()['email'];
            $user->username = $validator->validated()['username'];

            $user->description = $request->description;

            $user->save();
            return response()->json(['successMessages' => ["اطلاعات با موفقیت بروزرسانی شدند"]]);
        } else {
            return response()->json(['errorMessages' => $validator->errors()->all()]);
        }
    }
    public function edit_img(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'img' => 'required|file|max:2048|mimes:png,jpg,jpeg,gif',

        ]);
        if ($validator->passes()) {
            $user = User::findOrFail($request->id);

            $extension = $validator->validated()['img']->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $validator->validated()['img']->move(public_path('img/users'), $fileName);
            $user->image = $fileName;
            $user->save();
            return response()->json(['successMessages' => ["اطلاعات با موفقیت بروزرسانی شدند"]]);
        } else {
            return response()->json(['errorMessages' => $validator->errors()->all()]);
        }
    }
    public function edit_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/',
        ]);

        if ($validator->passes()) {
            $user = User::findOrFail($request->id);
            $user->password =  Hash::make($validator->validated()['password']);
            $user->save();
            return response()->json(['successMessages' => ["اطلاعات با موفقیت بروزرسانی شدند"]]);
        } else {
            return response()->json(['errorMessages' => $validator->errors()->all()]);
        }
    }
    public function newUser()
    {
        return view('users/newUser');
    }
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => "required|email |unique:users",
            "username" => "required | alpha_dash| min:3|unique:users",
            'password' => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/',
        ]);
        if ($validator->passes()) {
            $user = new User();

            $user->email = $validator->validated()['email'];
            $user->username = $validator->validated()['username'];
            $user->password =Hash::make($validator->validated()['password']) ;
            $user->role = $request->role;
            
            $user->save();
            return response()->json(['successMessages' => ["کاربر اضافه شد"]]);
        } else {
            return response()->json(['errorMessages' => $validator->errors()->all()]);
        }
    }
}
