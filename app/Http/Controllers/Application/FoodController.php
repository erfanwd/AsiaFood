<?php

namespace App\Http\Controllers\Application;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->category;
        $categories = Category::all();
        $foods = Food::with('category')->when($category)
            ->whereHas('category',function ($query) use ($category){
                $query->where('name',$category);
            })->get();
        return view('app.pages.food.index',compact('categories','foods'));
    }

    public function show(Food $food)
    {
        return view('app.pages.food.show',compact('food'));
    }

    public function buy(Request $request)
    {
        $food = Food::find($request->food);
        if ($request->count > $food->stock){
            return back()->with('failed', 'Out of stock');
        }
        $this->makeOrder($request,$food);

        return redirect()->route('user.orders');
    }

    protected function makeOrder($request,$food)
    {
        Auth::user()->orders()->create([
           'amount'=>$request->count * $food->price,
           'count'=>$request->count,
            'food_id'=>$food->id
        ]);
        $food->update([
            'stock'=>$food->stock - $request->count
        ]);
    }
}
