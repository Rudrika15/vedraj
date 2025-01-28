@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Permissions</h3>
            </div>
            <div class="">
                <a href="{{ route('permission.create') }}" class="btn btn-primary">Add Permission</a>
            </div>
        </div>
        <div class="table table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $permission->name }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('permission.edit', $permission->id) }}"
                                    class="btn btn-xs btn-primary">Edit</a>
                                <a href="{{ route('permission.delete', $permission->id) }}"
                                    data-url="{{ route('permission.delete', $permission->id) }}"
                                    class="btn btn-xs btn-danger delete-button">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
