<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        $categories = Category::all();
        return view('admin.pages.food.index',compact('foods','categories'));
    }

    public function store(Request $request)
    {
        $this->validateFrom($request);
        $image = $request->file('image');
        $image_name = rand(1000,9999).$image->getClientOriginalName();
        $image->move(public_path('images/foods'),$image_name);
        $this->createFood($request,$image_name);

        return back()->with('success','New food created');
    }

    protected function createFood($request,$image)
    {
        return Food::create([
            'title'=>$request->title,
            'category_id'=>$request->category,
            'image'=>$image,
            'description'=>$request->description,
            'stock'=>$request->stock,
            'history'=>$request->history,
            'price'=>$request->price,
        ]);
    }

    protected function validateFrom($request)
    {
        $request->validate([
            'title'=>['required','max:255'],
            'image'=>['required','mimes:jpeg,jpg'],
            'description'=>['required'],
            'stock'=>['required','integer'],
            'price'=>['required','integer'],
            'category'=>['required'],
        ]);
    }

    protected function validateFromUpdate($request)
    {
        $request->validate([
            'title'=>['required','max:255'],
            'image'=>['mimes:jpeg,jpg'],
            'description'=>['required'],
            'stock'=>['required','integer'],
            'price'=>['required','integer'],
            'category'=>['required'],
        ]);
    }

    public function show(Food $food)
    {
        $categories = Category::all();
        return view('admin.pages.food.update',compact('food','categories'));
    }

    public function update(Food $food,Request $request)
    {
        $this->validateFromUpdate($request);
        $image_name = $food->image;
        if ($request->hasFile('image')){
            File::delete(public_path('images/foods/'.$image_name));
            $image = $request->file('image');
            $image_name = rand(1000,9999).$image->getClientOriginalName();
            $image->move(public_path('images/foods'),$image_name);
        }

        $this->updateFood($request,$food,$image_name);

        return redirect()->route('admin.food.index')->with('success','Food edited');
    }

    protected function updateFood($request,$food,$image)
    {
        $food->update([
            'title'=>$request->title,
            'category_id'=>$request->category,
            'image'=>$image,
            'description'=>$request->description,
            'stock'=>$request->stock,
            'history'=>$request->history,
            'price'=>$request->price,
        ]);
    }
    public function delete(Food $food)
    {
        File::delete(public_path('images/foods/'.$food->image));
        $food->delete();
        return back()->with('success','Food deleted');
    }
}
