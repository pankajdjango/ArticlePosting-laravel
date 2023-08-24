@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Article List</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            
            <div id="addmodel">
                <a href="#" data-toggle="modal" data-target="#addModal" class="btn btn-primary add_model">Add Article</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
            <div id="article-list" class="row">
                    <!-- Article list items will be appended here -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade popup" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
               <form id="create-article-form">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="add_title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" id="add_content" name="content" rows="4" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="add_image" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="published_at" class="form-label">Published Date</label>
                    <input type="date" class="form-control" id="add_published_at" name="published_at"  required>
                </div>
               
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save-changes">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade popup" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Article</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form id="edit-article-form">
                @csrf
                @method('PUT')
                <input type="hidden" id="article_id" name="article_id" >
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
                    <img src="" id="image_url" class="img-fluid" alt="Old Image" width="100">
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="published_at" class="form-label">Published Date</label>
                    <input type="date" class="form-control" id="published_at" name="published_at"  required>
                </div>
               
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save-changes">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


