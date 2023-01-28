@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            <p class="text-success mb-0">{{session('success')}}</p>
        </div>
    @endif
    <form action="{{route('admin.food.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="mb-3 mt-3">
            <input class="form-control" value="{{old('title')}}" type="text" placeholder="title" name="title">
        </div>
        <div class="mb-3">
            <textarea class="form-control"  placeholder="description" name="description">{{old('description')}}</textarea>
        </div>
        <div class="mb-3">
            <input class="form-control" value="{{old('stock')}}" type="number" placeholder="stock" name="stock">
        </div>
        <div class="mb-3">
            <textarea class="form-control" placeholder="history(nullable)" name="history">{{old('history')}}</textarea>
        </div>
        <div class="mb-3">
            <input class="form-control" value="{{old('price')}}" type="number" placeholder="price" name="price">
        </div>
        @foreach($categories as $category)
        <div class="form-check mb-3">

                <input class="form-check-input" type="radio" name="category" value="{{$category->id}}" id="{{$category->id}}">
                <label class="form-check-label" for="{{$category->id}}">
                    {{$category->name}}
                </label>
        </div>
        @endforeach
        <div class="mb-3">
            <h2>image</h2>
            <input class="form-control" type="file" name="image">
        </div>

    @if ($errors->any())
            <div class="mb-2">
                @foreach ($errors->all() as $error)

                    <li class="text-danger">{{$error}}</li>

                @endforeach
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Add food</button>
    </form>
    <div>
        <table class="table table-dark table-striped">
            <thead>
            @if($foods->count() != 0)
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Date created</th>
                    <th>Action</th>
                </tr>
            @endempty
            </thead>
            <tbody>

                @forelse($foods as $food)
                    <tr>
                    <td>{{$food->title}}</td>
                    <td><img src="{{asset('images/foods/'.$food->image)}}" width="100"></td>
                        <td>{{$food->stock}}</td>
                        <td>${{$food->price}}</td>
                        <td>{{$food->category->name}}</td>
                    <td>{{$food->created_at}}</td>
                    <td>
                        <a href="{{route('admin.food.show',$food->id)}}" class="btn btn-success">edit</a>
                        <a href="{{route('admin.food.delete',$food->id)}}" class="btn btn-outline-danger">delete</a>
                    </td>
                @empty
                    no food
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

@endsection
