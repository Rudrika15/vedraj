@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Users</h3>
            </div>
            <div class="margin-top-10">
                <a href="{{ route('staff.create') }}" class="btn btn-sm btn-primary">
                    Add User
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Address</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Date Of Birth </th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($staffs as $staff)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->email }}</td>
                            <td>{{ $staff->mobile_no }}</td>
                            <td>{{ $staff->address }}</td>

                            <td>{{ $staff->branch->branch_name ?? '' }}</td>
                            <td>{{ $staff->dob }}</td>
                            <td>{{ $staff->role }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('staff.edit', $staff->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                <a href="{{ route('staff.delete', $staff->id) }}"
                                    data-url="{{ route('staff.delete', $staff->id) }}"
                                    class="btn btn-xs btn-danger delete-button">Delete</a>
                                <a href="{{ route('user.permission', $staff->id) }}"
                                    class="btn btn-xs btn-info">Permissions</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $staffs->links() }}
            </div>
        </div>
    </div>
@endsection
