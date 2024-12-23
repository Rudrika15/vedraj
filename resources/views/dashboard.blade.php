@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Dashboard</h1>
        <p>Welcome {{ auth()->user()->name }}</p>
        <div class="row g-3 mb-5 mt-2">
            <div class="col-md-4">
                <a href="{{ route('staff.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class=" text-center">
                                <i class="fa fa-users"></i>
                            </div>
                            <h5 class="card-title text-center">Total Staff</h5>
                            <h5 class="card-text text-center">{{ $totalStaff }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('disease.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-syringe"></i>
                            </div>
                            <h5 class="card-title text-center">Total Diseases</h5>
                            <h5 class="card-text text-center">{{ $totalDiseases }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('product.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-pills"></i>
                            </div>
                            <h5 class="card-title text-center">Total Products</h5>
                            <h5 class="card-text text-center">{{ $totalProducts }}</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('article.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-newspaper"></i>
                            </div>
                            <h5 class="card-title text-center">Total Articles</h5>
                            <h5 class="card-text text-center">{{ $totalArticles }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('video.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-video"></i>
                            </div>
                            <h5 class="card-title text-center">Total Videos</h5>
                            <h5 class="card-text text-center">{{ $totalVideos }}</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('branch.index') }}" class="text-decoration-none">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-hospital"></i>
                            </div>
                            <h5 class="card-title text-center">Total Branches</h5>
                            <h5 class="card-text text-center">{{ $totalBranches }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
