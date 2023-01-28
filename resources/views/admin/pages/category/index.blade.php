@extends('admin.layouts.app')
@section('title','Admin')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            <p class="text-success mb-0">{{session('success')}}</p>
        </div>
    @endif
    <form action="{{route('admin.category.store')}}" method="post">
        @csrf
        <div class="mb-3 mt-3">
            <input class="form-control" id="name" placeholder="name" name="name">
        </div>
        @if ($errors->any())
            <div class="mb-2">
                @foreach ($errors->all() as $error)

                    <li class="text-danger">{{$error}}</li>

                @endforeach
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Add category</button>
    </form>
    <div>
        <table class="table table-dark table-striped">
            <thead>
            @if($categories->count() != 0)
            <tr>
                <th>Name</th>
                <th>Date created</th>
                <th>Action</th>
            </tr>
            @endempty
            </thead>
            <tbody>

                    @forelse($categories as $category)
                        <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>
                            <a href="{{route('admin.category.show',$category->id)}}" class="btn btn-success">edit</a>
                            <a href="{{route('admin.category.delete',$category->id)}}" class="btn btn-outline-danger">delete</a>
                        </td>
                    @empty
                        no category
                        </tr>
                    @endforelse

            </tbody>
        </table>
    </div>

@endsection
