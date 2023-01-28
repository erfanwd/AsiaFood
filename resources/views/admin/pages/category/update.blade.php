@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    <form action="{{route('admin.category.update',$category->id)}}" method="post">
        @csrf
        <div class="mb-3 mt-3">
            <input class="form-control" id="name" value="{{$category->name}}" placeholder="name" name="name">
        </div>
        @if ($errors->any())
            <div class="mb-2">
                @foreach ($errors->all() as $error)

                    <li class="text-danger">{{$error}}</li>

                @endforeach
            </div>
        @endif
        <button type="submit" class="btn btn-primary">update category</button>
    </form>
@endsection
