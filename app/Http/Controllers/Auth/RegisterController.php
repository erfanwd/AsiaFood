<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function form()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validateForm($request);
        $user = $this->registerUser($request);
        $this->loginUser($user);

        return redirect()->route('app.food.index');
    }

    protected function loginUser($user)
    {
        Auth::login($user);
    }

    protected function registerUser($request)
    {
        return User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>Hash::make($request->password),
        ]);
    }

    protected function validateForm($request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'regex:/(^([a-zA-Z]+)(\d+)?$)/u', 'min:6','max:20'],
        ]);
    }
}
