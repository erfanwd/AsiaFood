@extends('app.layouts.app')
@section('title','Asiafood')
@section('content')
    <div class="row mt-2 text-center">
        @foreach($categories as $category)
            <a href="{{route('app.food.index',['category'=>$category->name])}}" class="col-md-2" style="text-decoration: none">
                <div class="card  p-3" style="margin-right: 5px">{{$category->name}}</div>
            </a>
        @endforeach
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3 mt-1">
        @foreach($foods as $food)
        <div class="col">
            <div class="card shadow-sm">
                <img src="{{asset('images/foods/'.$food->image)}}" class="bd-placeholder-img card-img-top" width="100%" height="225" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false" alt="">

                <div class="card-body">
                    <h3>{{$food->title}}</h3>
                    <p class="card-text">{{$food->description}}</p>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="{{route('app.food.show',$food->id)}}" class="btn btn-sm btn-outline-secondary">Buy</a>
                            <button type="button" class="btn btn-sm btn-outline-secondary" disabled>{{$food->category->name}}</button>
                        </div>
                        <small class="text-muted">${{$food->price}}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
