@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-2 m-3" >
                    <img src="{{ url('build/assets/images/' . $product->image_url) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <div class="card-text">
                            Price: <span class="text-center" style="color: green">${{ $product->price }}</span>
                            @if($product->quantity == 0)
                                <span class="text-center mx-2" style="color: red">SOLD OUT</span>
                            @endif
                        </div>
                        <p class="card-text">Quantity: {{ $product->quantity }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
