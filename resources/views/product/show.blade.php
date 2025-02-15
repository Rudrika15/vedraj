@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>{{ $product->product_name }}</h3>
            </div>
            <div class="">
                <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card-image mb-3 text-center">
                    <img src="{{ asset('images/products/' . $product->thumbnail) }}" width="150" alt="Product Image"
                        class="img-fluid">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Product Name:</h5>
                        <p class="card-text">{{ $product->product_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Product Name Hindi:</h5>
                        <p class="card-text">{{ $product->product_name_hindi }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{ $product->description }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Description Hindi:</h5>
                        <p class="card-text">{{ $product->description_hindi }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5 class="card-title">is On Amazone:</h5>
                        <p class="card-text">{{ $product->is_on_amazone }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Amazon Link:</h5>
                        <p class="card-text">{{ $product->amazon_link }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
