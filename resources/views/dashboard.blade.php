@extends('layouts.app')

@section('content')
    <style>
        .col .card {
            height: 200px;

        }

        .col .card .card-body {
            margin-top: 50px;
        }
    </style>
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome {{ auth()->user()->name }}</p>
        <div class="row g-3 mb-5 mt-2">
            <div class="col">
                <a href="{{ route('staff.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Total Staff</h5>
                            <h5 class="card-text text-center">{{ $totalStaff }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('disease.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Total Diseases</h5>
                            <h5 class="card-text text-center">{{ $totalDiseases }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('product.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Total Products</h5>
                            <h5 class="card-text text-center">{{ $totalProducts }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('article.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Total Articles</h5>
                            <h5 class="card-text text-center">{{ $totalArticles }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('video.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Total Videos</h5>
                            <h5 class="card-text text-center">{{ $totalVideos }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('branch.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Total Branches</h5>
                            <h5 class="card-text text-center">{{ $totalBranches }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
