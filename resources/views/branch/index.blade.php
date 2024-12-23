@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Branches</h3>
            </div>
            <div>
                <a href="{{ route('branch.create') }}" class="btn btn-sm btn-primary ">
                    Create Branch
                </a>
            </div>
        </div>
        <div class=" table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Branch Name</th>
                        <th scope="col">Branch PinCode</th>
                        <th scope="col">Branch City</th>
                        <th scope="col">Branch Mobile</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $branch->branch_name }}</td>
                            <td>{{ $branch->pincode }}</td>
                            <td>{{ $branch->city }}</td>
                            <td>{{ $branch->mobile_no }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('branch.edit', $branch->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                <a href="{{ route('branch.delete', $branch->id) }}"
                                    data-url="{{ route('branch.delete', $branch->id) }}"
                                    class="btn btn-xs btn-danger delete-button">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $branches->links() }}
            </div>
        </div>

    </div>
@endsection
