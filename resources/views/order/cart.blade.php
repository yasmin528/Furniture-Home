@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if($orders->isNotEmpty())
                @foreach($orders as $order)
                    <div class="col-md-4 mb-4">
                        <div class="card p-2">
                            <div class="card-body">
                                <p>Order ID: {{ $order->id }}</p>
                                <img src="{{ url('build/assets/images/' . $order->product->image_url) }}" class="card-img-top" alt="{{ $order->product->name }}">
                                <h5 class="card-title">{{ $order->product->name }}</h5>
                                <p class="card-text">{{ $order->product->description }}</p>
                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantityAndTotalPrice('minus', '{{ $order->product->id }}','{{$order->id}}')">-</button>
                                    <input type="text" name="quantity" id="quantity-{{ $order->product->id }}" class="form-control text-center mx-2" value="{{$order->quantity}}" style="width: 60px;" max="{{$order->product->quantity}}" readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantityAndTotalPrice('plus', '{{ $order->product->id }}','{{$order->id}}')">+</button>
                                </div>
                                <p class="mt-2" id="total-price-{{ $order->id }}" style="color: green">Total Price: ${{ $order->total_price }}</p>
                                <div class="row">
                                    <form class="col-md-12" action="{{ route('order.destroy', ['order' => $order->id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                    <h1 class="text-center">Cart is Empty</h1>
                </div>
            @endif
        </div>
    </div>
@endsection
