@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between mb-3">
            <div class="">

                <h3>Articles</h3>
            </div>
            <div class="">
                <a href="{{ route('article.create') }}" class="btn btn-primary">Add Article</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">Disease Name</th>
                        <th scope="col">Article Title</th>
                        <th scope="col">Article Image</th>
                        <th scope="col">Article URL</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $article->disease->disease_name }}</td>
                            <td>{{ $article->title }}</td>
                            <td>
                                <img src="{{ asset('images/articles/' . $article->thumbnail) }}" width="120"
                                    alt="">
                            </td>
                            <td>{{ $article->url }}</td>
                            <td>
                                <div class="d-flex gap-2">

                                    <a href="{{ route('article.edit', $article->id) }}" class="btn btn-xs btn-primary">
                                        Edit
                                    </a>
                                    <a href="{{ route('article.delete', $article->id) }}"
                                        data-url="{{ route('article.delete', $article->id) }}"
                                        class="btn btn-xs btn-danger delete-button">
                                        Delete
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
