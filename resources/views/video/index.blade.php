@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Videos</h3>
            </div>
            <div class="">
                <a href="{{ route('video.create') }}" class="btn btn-primary">Create Video</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Disease Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Title Hindi</th>
                        <th scope="col">Youtube Link</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($videos as $video)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $video->disease->disease_name }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->title_hindi }}</td>
                            <td>{{ $video->youtube_link }}</td>
                            <td><img src="{{ asset('images/videos/' . $video->thumbnail) }}" width="120" alt="">
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('video.edit', $video->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                    <a href="{{ route('video.delete', $video->id) }}"
                                        data-url="{{ route('video.delete', $video->id) }}"
                                        class="btn btn-xs btn-danger delete-button">Delete</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
