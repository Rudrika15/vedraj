@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">

                <h3>Edit Product</h3>
            </div>
            <div class="margin-top-10">
                <a href="{{ route('product.index', request()->id) }}" class="btn btn-sm btn-primary">
                    Back
                </a>
            </div>
        </div>

        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="disease_id">Disease Name</label>
                <select class="form-select" id="disease_id" name="disease_id">
                    <option value="" selected disabled>Select Disease</option>
                    @foreach ($diseases as $disease)
                        <option value="{{ $disease->id }}" {{ $product->disease_id == $disease->id ? 'selected' : '' }}>
                            {{ $disease->disease_name }}</option>
                    @endforeach
                </select>
                @error('disease_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="product_name"
                    value="{{ $product->product_name ?? old('product_name') }}">
                @error('product_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $product->description ?? old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="amazon_link">Amazon Link</label>
                <input type="text" class="form-control" id="amazon_link" name="amazon_link"
                    value="{{ $product->amazon_link ?? old('amazon_link') }}s">
                @error('amazon_link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
