@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Edit Article</h2>
         <form id="edit-article-form">
            @csrf
            @method('PUT')
            <input type="hidden" id="article-id" name="article_id" value="{{ $article->id }}">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required>{{ $article->content }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image_path" accept="image/*">
            </div>
            <div class="mb-3">
                <label for="published_at" class="form-label">Published Date</label>
                <input type="date" class="form-control" id="published_at" name="published_at" value="{{ $article->published_at }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/articles.js') }}"></script>
@endsection

