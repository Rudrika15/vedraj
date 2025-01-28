@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>User Permissions</h3>
            </div>
            <div class="">
                <a href="{{ route('staff.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form method="POST" action="{{ route('user.permission.update', request()->route('id')) }}">
            @csrf
            <div class="form-group">
                <label for="permissions">Permissions</label>
                <div class="d-flex flex-wrap">
                    <input type="hidden" name="user_id" value="{{ request()->route('id') }}">
                    @foreach ($permissions as $permission)
                        <div class="form-check me-3">
                            <input class="form-check-input" type="checkbox" name="permission_id[]"
                                value="{{ $permission->id }}" id="permission-{{ $permission->id }}"
                                @if ($userWisePermission->pluck('permission_id')->contains($permission->id)) checked @endif> <label class="form-check-label"
                                for="permission-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('permission_id')
                        <br>
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Permissions</button>

        </form>
    </div>
@endsection
