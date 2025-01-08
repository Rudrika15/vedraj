@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">

            <div class="">
                <h3>Create Branch</h3>
            </div>
            <div class="">
                <a href="{{ route('branch.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('branch.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="form-group">
                <label for="branch_name"> Name</label>
                <input type="text" value="{{ old('branch_name') }}" class="form-control" id="branch_name"
                    name="branch_name" placeholder="Branch Name">
                @error('branch_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="pincode">Pincode</label>
                <input type="number" value="{{ old('pincode') }}" min="0" class="form-control" id="pincode"
                    name="pincode" placeholder="Pincode">
                @error('pincode')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" value="{{ old('city') }}" class="form-control" id="city" name="city"
                    placeholder="City">
                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobile_no">Mobile No</label>
                <input type="number" value="{{ old('mobile_no') }}" min="0" autocomplete="none" class="form-control"
                    id="mobile_no" name="mobile_no" placeholder="Mobile No">
                @error('mobile_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
