@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">

                <h3>Disease</h3>
            </div>
            <div class="margin-top-10">
                <a href="{{ route('disease.create') }}" class="btn btn-sm btn-primary">
                    Add Disease
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Disease Name</th>
                        <th scope="col">Disease Name Hindi</th>
                        <th scope="col">Description</th>
                        <th scope="col">Description Hindi</th>
                        <th scope="col">Food Plan</th>
                        <th scope="col">Food Plan Hindi</th>
                        <th scope="col">URL</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($diseases as $disease)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $disease->disease_name }}</td>
                            <td>{{ $disease->disease_name_hindi }}</td>
                            <td>{{ $disease->description }}</td>
                            <td>{{ $disease->description_hindi }}</td>
                            <td>{{ $disease->food_plan }}</td>
                            <td>{{ $disease->food_plan_hindi }}</td>
                            <td>{{ $disease->url }}</td>
                            <td><img src="{{ asset('images/diseases/' . $disease->thumbnail) }}" width="120"
                                    alt=""></td>
                            <td>
                                <div class="d-flex gap-2">

                                    <a href="{{ route('disease.edit', $disease->id) }}" class="btn btn-xs btn-primary">
                                        Edit
                                    </a>
                                    <a href="{{ route('disease.delete', $disease->id) }}"
                                        data-url="{{ route('disease.delete', $disease->id) }}"
                                        class="btn btn-xs btn-danger delete-button">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $diseases->links() }}
            </div>
        </div>
    </div>
@endsection
