@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">

                <h3>Create Article</h3>
            </div>
            <div class="">
                <a href="{{ route('article.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="disease_id">Disease Name</label>
                <select class="form-select" id="disease_id" name="disease_id">
                    <option value="" selected disabled>Select Disease</option>
                    @foreach ($diseases as $disease)
                        <option value="{{ $disease->id }}">{{ $disease->disease_name }}</option>
                    @endforeach
                </select>
                @error('disease_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title_hindi">Article Title Hindi</label>
                <input type="text" class="form-control" id="title_hindi" name="title_hindi"
                    value="{{ old('title_hindi') }}">
                @error('title_hindi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="url">Article URL</label>
                <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}">
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumbnail">Article Image</label>
                <br>
                <img id="preview" style="max-width: 150px; max-height: 120px; margin-bottom: 10px; display: none;">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" onchange="previewFile(this)">
                @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>

    </div>
    <script>
        function previewFile(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    var preview = document.getElementById('preview');
                    preview.src = reader.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
