@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">

                <h3>Create Permission</h3>
            </div>
            <div class="margin-top-10">
                <a href="{{ route('permission.index') }}" class="btn btn-sm btn-primary">
                    Back
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('permission.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
