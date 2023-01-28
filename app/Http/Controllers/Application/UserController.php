<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function orders()
    {
        $orders = Auth::user()->orders;
        return view('app.pages.user.orders',compact('orders'));
    }
}
