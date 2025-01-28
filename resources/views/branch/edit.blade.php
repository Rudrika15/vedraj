@extends('layouts.app')

@section('content')
    <div class="container mb-3">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Edit Branch</h3>
            </div>
            <div class="">
                <a href="{{ route('branch.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('branch.update', $branch->id) }}">
            @csrf
            <div class="form-group">
                <label for="name"> Name</label>
                <input type="text" class="form-control" id="name" name="branch_name"
                    value="{{ $branch->branch_name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pincode">Pincode</label>
                <input type="number" class="form-control" id="pincode" name="pincode" value="{{ $branch->pincode }}">
                @error('pincode')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $branch->city }}">
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $branch->address }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address_hindi">Address Hindi</label>
                <input type="text" class="form-control" id="address_hindi" name="address_hindi"
                    value="{{ $branch->address_hindi }}">
                @error('address_hindi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="mobile_no">Mobile No</label>
                <input type="number" class="form-control" id="mobile_no" name="mobile_no"
                    value="{{ $branch->mobile_no }}">
                @error('mobile_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
