<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function form()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateForm($request);
        $user = $this->getUser($request);
        if (!Hash::check($request->password,$user->password))
        {
            return back()->with('failed','Wrong password');
        }
        $this->loginUser($user);

        return redirect()->route('app.food.index');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('app.food.index');
    }

    protected function loginUser($user)
    {
        Auth::login($user);
    }

    protected function getUser($request)
    {
        return User::where('email',$request->email)->first();
    }


    protected function validateForm($request)
    {
        $request->validate([
            'email' => ['required', 'email','exists:users'],
            'password' => ['required', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u', 'min:6','max:20'],
        ]);
    }
}
