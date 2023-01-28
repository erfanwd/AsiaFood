<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.pages.category.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validateFrom($request);
        $this->createCategory($request);

        return back()->with('success','New category created');
    }

    protected function createCategory($request)
    {
        Category::create([
            'name'=>$request->name
        ]);
    }

    protected function validateFrom($request)
    {
        $request->validate([
           'name'=>['required','unique:categories']
        ]);
    }

    public function show(Category $category)
    {
        return view('admin.pages.category.update',compact('category'));
    }

    public function update(Category $category,Request $request)
    {
        $this->validateFrom($request);
        $this->updateCategory($request,$category);

        return redirect()->route('admin.category.index')->with('success','Category edited');
    }

    protected function updateCategory($request,$category)
    {
        $category->update([
            'name'=>$request->name
        ]);
    }
    public function delete(Category $category)
    {
        if ($category->foods()->exists()){
            return back()->with('failed','Category has foods');
        }
        $category->delete();
        return back()->with('success','Category deleted');
    }
}
