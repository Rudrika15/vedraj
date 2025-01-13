@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">
                <h3>Create Disease</h3>
            </div>
            <div class="">
                <a href="{{ route('disease.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form method="POST" action="{{ route('disease.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="disease_name">Disease Name</label>
                <input type="text" value="{{ old('disease_name') }}" class="form-control" id="disease_name"
                    name="disease_name">
                @error('disease_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="disease_name_hindi">Disease Name Hindi</label>
                <input type="text" value="{{ old('disease_name_hindi') }}" class="form-control" id="disease_name_hindi"
                    name="disease_name_hindi">
                @error('disease_name_hindi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="description_hindi">Description Hindi</label>
                <textarea class="form-control" id="description_hindi" name="description_hindi">{{ old('description_hindi') }}</textarea>
                @error('description_hindi')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="url">URL</label>
                <input type="text" value="{{ old('url') }}" class="form-control" id="url" name="url">
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>
                <br>
                <img id="preview" style="max-width: 150px; max-height: 120px; margin-bottom: 10px; display: none;">
                <input type="file" class="form-control" id="thumbnail" name="thumbnail" onchange="previewFile(this)">
                @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
        <script>
            function previewFile(input) {
                var file = $("input[type=file]").get(0).files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function() {
                        $("#preview").show();
                        $("#preview").attr("src", reader.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>
    </div>
@endsection
