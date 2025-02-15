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
                <div class="card-image mb-3 text-center">
                    <img src="{{ asset('images/diseases/' . $disease->thumbnail) }}" width="150" alt="Disease Image"
                        class="img-fluid">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title">Disease Name:</h5>
                        <p class="card-text">{{ $disease->disease_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">URL :</h5>
                        <p class="card-text">{{ $disease->url }}</p>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5 class="card-title">Food Plan :</h5>
                        <p class="card-text">{{ $disease->food_plan }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Food Plan Hindi:</h5>
                        <p class="card-text">{{ $disease->food_plan_hindi }}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5 class="card-title">Description:</h5>
                        <p class="card-text">{{ $disease->description }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Description Hindi:</h5>
                        <p class="card-text">{{ $disease->description_hindi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
