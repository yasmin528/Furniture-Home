@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <form action="{{ route('order.store') }}" method="post">
                        @csrf
                        <div class="card p-2">
                            <img src="{{ url('build/assets/images/' . $product->image_url) }}" class="card-img-top" alt="{{ $product->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <div class="card-text">
                                    Price: <span class="text-center" style="color: green">${{$product->price}}</span>
                                    @if($product->quantity == 0)
                                        <span class="text-center mx-2" style="color: red">SOLD OUT</span>
                                    @endif
                                </div>

                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantity('minus', '{{ $product->id }}')">-</button>
                                    <input type="text" name="quantity" id="quantity-{{ $product->id }}" class="form-control text-center mx-2" value="0" style="width: 60px;" max="{{$product->quantity}}" readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="changeQuantity('plus', '{{ $product->id }}')">+</button>
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="btn-{{ $product->id }}" class="btn btn-primary" disabled >BUY</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
