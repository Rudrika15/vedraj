@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Products</h3>
            </div>
            <div class="">
                <a href="{{ route('product.create', request()->id) }}" class="btn btn-primary">Add Product</a>
            </div>
        </div>
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col"> Disease Name </th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Name Hindi</th>
                        <th scope="col">Product Description</th>
                        <th scope="col">Product Description Hindi</th>
                        <th scope="col">Amazon Link</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $product->disease->disease_name ?? '' }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_name_hindi }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->description_hindi }}</td>
                            <td>{{ $product->amazon_link }}</td>
                            <td>
                                <img src="{{ asset('images/products/' . $product->thumbnail) }}" width="120"
                                    alt="">
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-xs btn-primary">
                                        Edit
                                    </a>
                                    <a href="{{ route('product.delete', $product->id) }}"
                                        data-url="{{ route('product.delete', $product->id) }}"
                                        class="btn btn-xs btn-danger delete-button">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
