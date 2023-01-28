<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.pages.order.index',compact('orders'));
    }

    public function accept(Order $order)
    {
        $order->update([
            'status'=>2
        ]);
        return back();
    }
}
