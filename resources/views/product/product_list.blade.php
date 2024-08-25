@extends('layouts.admin')

@section('content')
    <h1 style="font-size: x-large; color: #0a58ca">Products: </h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th>Show</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
        <tr>
            <th scope="row">{{$product->id}}</th>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->quantity}}</td>
            <td>{{$product->price}}</td>
            <td><img src="{{url('build/assets/images/' .$product->image_url)}}" class="img-fluid" style="max-width: 100px; height: auto;"></td>
            <td>
                <a class="btn btn-secondary" href="{{route('products.show',['product' => $product->id])}}">Show</a>
            </td>
            <td>
                <a class="btn btn-info" href="{{route('products.edit',['product' => $product->id])}}">Edit</a>
            </td>
            <td>
                <form action="{{route('products.destroy' , ['product'=> $product->id])}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
