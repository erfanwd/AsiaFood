@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            <p class="text-success mb-0">{{session('success')}}</p>
        </div>
    @endif
    <form action="{{route('admin.food.update',$food->id)}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mb-3 mt-3">
            <input class="form-control" value="{{$food->title}}" type="text" placeholder="title" name="title">
        </div>
        <div class="mb-3">
            <textarea class="form-control"  placeholder="description" name="description">{{$food->description}}</textarea>
        </div>
        <div class="mb-3">
            <input class="form-control" value="{{$food->stock}}" type="number" placeholder="stock" name="stock">
        </div>
        <div class="mb-3">
            <textarea class="form-control" placeholder="history(nullable)" name="history">{{$food->history}}</textarea>
        </div>
        <div class="mb-3">
            <input class="form-control" value="{{$food->price}}" type="number" placeholder="price" name="price">
        </div>
        @foreach($categories as $category)
            <div class="form-check mb-3">

                <input class="form-check-input" type="radio" name="category" value="{{$category->id}}" id="{{$category->id}}" {{$category->id == $food->category_id ? 'checked' : ''}}>
                <label class="form-check-label" for="{{$category->id}}">
                    {{$category->name}}
                </label>
            </div>
        @endforeach
        <div class="mb-3">
            <h2>image</h2>
            <input class="form-control" type="file" name="image">
            <img class="mt-2" src="{{asset('images/foods/'.$food->image)}}" width="100">
        </div>

        @if ($errors->any())
            <div class="mb-2">
                @foreach ($errors->all() as $error)

                    <li class="text-danger">{{$error}}</li>

                @endforeach
            </div>
        @endif
        <button type="submit" class="btn btn-primary">edit food</button>
    </form>
@endsection
