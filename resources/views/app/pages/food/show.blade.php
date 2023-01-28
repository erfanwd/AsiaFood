@extends('app.layouts.app')
@section('title','Asiafood')
@section('content')
    @if(session()->has('failed'))
        <div class="alert alert-danger mt-2">
            <p class="text-danger mb-0">{{session('failed')}}</p>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            <p class="text-success mb-0">{{session('success')}}</p>
        </div>
    @endif
    <div class="mt-2 row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary">{{$food->category->name}}</strong>
            <h3 class="mb-0">{{$food->title}}</h3>
            <h4 class="mb-0 mt-2">${{$food->price}}</h4>
            @if(!is_null($food->history))
                <div class="mb-1 text-muted mt-2">History : {{$food->history}}</div>
            @endif
            <p class="card-text mb-auto mt-2">{{$food->description}}</p>
            <p class="card-text mb-auto mt-2">stock : {{$food->stock}}</p>
            <form method="post" action="{{route('app.food.buy')}}">
                @csrf
                <span style="display: flex;align-items: baseline">count: <input class="form-control" type="number" name="count" value="1" style="width: 80px"></span>
                <input hidden name="food" type="number" value="{{$food->id}}">
                <button type="submit" class="btn btn-info mt-1">buy</button>
            </form>

        </div>
        <div class="col-auto d-none d-lg-block">
            <img style="padding: 20px" src="{{asset('images/foods/'.$food->image)}}" class="bd-placeholder-img" height="350" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">

        </div>
    </div>
@endsection
