@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">

                <h3>Edit Article</h3>
            </div>
            <div class="">
                <a href="{{ route('article.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('article.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="disease_id">Disease Name</label>
                <select class="form-select" id="disease_id" name="disease_id">
                    <option value="" selected disabled>Select Disease</option>
                    @foreach ($diseases as $disease)
                        <option value="{{ $disease->id }}" {{ $article->disease_id == $disease->id ? 'selected' : '' }}>
                            {{ $disease->disease_name }}</option>
                    @endforeach
                </select>
                @error('disease_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Article Title</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="{{ $article->title ?? old('title') }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title_hindi">Article Title Hindi</label>
                <input type="text" class="form-control" id="title_hindi" name="title_hindi"
                    value="{{ $article->title_hindi ?? old('title_hindi') }}">
                @error('title_hindi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="url">Article URL</label>
                <input type="text" class="form-control" id="url" name="url"
                    value="{{ $article->url ?? old('url') }}">
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumbnail">Article Image</label>
                <br>
                <img id="preview" src="{{ asset('images/articles/' . $article->thumbnail) }}"
                    style="max-width: 150px; max-height: 120px; margin-bottom: 10px; ">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" onchange="previewFile(this)">
                @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
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
