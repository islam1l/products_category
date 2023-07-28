@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product Details</div>
                    <div class="card-body">
                        <h4>{{ $product->title }}</h4>
                        <p><strong>Description:</strong> {{ $product->description }}</p>
                        <p><strong>Price:</strong> ${{ $product->price }}</p>
                        <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
