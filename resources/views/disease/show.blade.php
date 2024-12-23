@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>{{ $disease->disease_name }}</h3>
            </div>
            <div class="">
                <a href="{{ route('disease.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Disease Name:</h5>
                        <p class="card-text">{{ $disease->disease_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{ $disease->description }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">URL</h5>
                        <p class="card-text">{{ $disease->url }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-text">
                            <a class="btn btn-primary" href="{{ route('product.index', $disease->id) }}">View Products</a>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="card-text">
                            <a class="btn btn-primary" href="{{ route('article.index', $disease->id) }}">View Articles</a>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p class="card-text">
                            <a class="btn btn-primary" href="{{ route('video.index', $disease->id) }}">View Videos</a>
                        </p>
                    </div>
                </div>
            @endsection
