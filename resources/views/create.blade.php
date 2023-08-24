@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Add New Article</h2>
         <form id="create-article-form">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image_path" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="published_at" class="form-label">Published Date</label>
                <input type="date" class="form-control" id="published_at" name="published_at" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Article</button>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('js/articles.js') }}"></script>
@endsection

