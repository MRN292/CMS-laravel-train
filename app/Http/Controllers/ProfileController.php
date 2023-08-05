<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function edit_informations(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable| min:3 | max:100| regex:/^[\p{Arabic}\s]+$/u',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'username' => 'required|alpha_dash|min:3|unique:users,username,' . auth()->user()->id,
            'description' => 'nullable|min:3|'
        ]);
        if ($validator->passes()) {
            $user = User::findOrFail(auth()->user()->id);
            $user->name = $validator->validated()['name'];
            $user->email = $validator->validated()['email'];
            $user->username = $validator->validated()['username'];
            $user->description = $validator->validated()['description'];
            $user->save();
            return response()->json(['successMessages' => ["اطلاعات با موفقیت بروزرسانی شدند"]]);
        } else {
            return response()->json(['errorMessages' => $validator->errors()->all()]);
        }
    }
    public function edit_password(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'prevPassword' => "required|min:8",
            'newPassword' => "required|min:8",
        ]);
        if ($validator->passes()) {

            $user = User::findOrFail(auth()->user()->id);
            if (Hash::make($request->prevPassword) == $user->password) {
                $user->password = Hash::make($request->newPassword);
                $user->save();
                return redirect()->route('dashboard-profile')->with(['successMessages' => ["اطلاعات با موفقیت بروزرسانی شدند"]]);
            } else {
                return redirect()->route('dashboard-profile')->with(['errorMessages' => ['رمز عبور وارد شده اشتباه است']]);
            }
        } else {
            return redirect()->route('dashboard-profile')->with(['errorMessages' => $validator->errors()->all()]);
        }
    }
    public function add_user_img(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'img' => 'required|file|max:2048|mimes:png,jpg,jpeg,gif',

        ]);
        if ($validator->passes()) {
            $user = User::findOrFail(auth()->user()->id);

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

    public function getProfile()
    {

        $user = User::findOrFail(auth()->user()->id);
        return response()->json(["user" => $user]);
    }
}
