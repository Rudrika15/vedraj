@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Edit Staff</h3>
            </div>
            <div class="">
                <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form method="POST" action="{{ route('staff.update', $staff->id) }}">
            @csrf
            <div class="form-group">
                <label for="branch_id">Branch</label>
                <select class="form-control" id="branch_id" name="branch_id">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $branch->id == $staff->branch_id ? 'selected' : '' }}>
                            {{ $branch->branch_name }}
                        </option>
                    @endforeach
                </select>
                @error('branch_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $staff->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $staff->email }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $staff->address }}">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobile_no">Mobile No</label>
                <input type="number" class="form-control" id="mobile_no" name="mobile_no" value="{{ $staff->mobile_no }}">
                @error('mobile_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobile_no">Date Of Birth</label>
                <input type="date" value="{{ $staff->dob }}" class="form-control" id="dob" name="dob">
                @error('dob')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-select" id="role" name="role">
                    <option value="admin" {{ $staff->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ $staff->role == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="staff" {{ $staff->role == 'staff' ? 'selected' : '' }}>Staff</option>
                    <option value="doctor" {{ $staff->role == 'doctor' ? 'selected' : '' }}>Doctor</option>
                    <option value="patient" {{ $staff->role == 'patient' ? 'selected' : '' }}>Patient</option>
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
