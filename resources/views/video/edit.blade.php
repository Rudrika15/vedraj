@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Create Video</h3>
            </div>
            <div class="">
                <a href="{{ route('video.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <form action="{{ route('video.update', $video->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="disease_id">Disease Name</label>
                <select name="disease_id" id="disease_id" class="form-select">
                    <option value="" selected disabled>select disease</option>
                    @foreach ($diseases as $disease)
                        <option value="{{ $disease->id }}" {{ $video->disease_id == $disease->id ? 'selected' : '' }}>
                            {{ $disease->disease_name }}</option>
                    @endforeach
                </select>
                @error('disease_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" value="{{ $video->title }}" class="form-control" id="title" name="title"
                    placeholder="Enter title">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="youtube_link">Youtube Link</label>
                <input type="text" value="{{ $video->youtube_link }}" class="form-control" id="youtube_link"
                    name="youtube_link" placeholder="Enter Youtube Link">
                @error('youtube_link')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <img src="{{ asset('images/videos/' . $video->thumbnail) }}" id="preview"
                    style="max-width: 150px; max-height: 120px; margin-bottom: 10px;">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" onchange="previewFile(this)"
                    placeholder="Enter thumbnail">
                @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <script>
        function previewFile(input) {
            var file = input.files[0];
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection
