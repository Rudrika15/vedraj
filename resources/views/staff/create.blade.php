@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Create Staff</h3>
            </div>
            <div class="">
                <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('staff.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="branch_id">Branch</label>
                <select class="form-control" id="branch_id" name="branch_id">
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">
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
                <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="{{ old('email') }}" class="form-control" id="email" name="email"
                    onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly'); }">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" value="{{ old('password') }}" autocomplete="new-password" class="form-control"
                    id="password" name="password"
                    onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly'); }">
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" value="{{ old('confirm_password') }}" class="form-control" id="confirm_password"
                    name="confirm_password">
                @error('confirm_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" value="{{ old('address') }}" class="form-control" id="address" name="address">
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="mobile_no">Mobile No</label>
                <input type="number" min="0" autocomplete="none" value="{{ old('mobile_no') }}"
                    class="form-control" id="mobile_no" name="mobile_no">
                @error('mobile_no')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" id="role" name="role">
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="staff">Staff</option>
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Create</button>
        </form>
    </div>
@endsection
