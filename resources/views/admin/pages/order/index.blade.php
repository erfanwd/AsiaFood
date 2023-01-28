@extends('admin.layouts.app')
@section('title','User')
@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success mt-2">
            <p class="text-success mb-0">{{session('success')}}</p>
        </div>
    @endif
    <div>
        <table class="table table-dark table-striped mt-2">
            <thead>
            @if($orders->count() != 0)
                <tr>
                    <th>Food</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            @endempty
            </thead>
            <tbody>

                @forelse($orders as $order)
                    <tr>
                    <td>{{$order->food->title}}</td>
                        <td>${{$order->amount}}</td>
                        @if($order->status == 1)
                        <td><span class="badge badge-danger">Waiting for accept</span></td>
                        @endif
                        @if($order->status == 2)
                            <td><span class="badge badge-success">Accepted</span></td>
                        @endif
                        <td>
                            @if($order->status == 1)
                            <a href="{{route('admin.order.accept',$order->id)}}" class="btn btn-success">accept</a>
                            @endif
                        </td>
                @empty
                    no order
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

@endsection
