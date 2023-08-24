function loadArticles() {
    $.ajax({
        url: '/api/articles',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);

            $('#article-list').empty();
            response.forEach(function (article) {
                var listItem = `<div class="col-md-3 mb-3">
                    
                        <strong>${article.title}</strong>
                        <div>
                            <img src="${article.image_url}" class="img-fluid" alt="${article.title}" width="100">
                        </div>
                        <div>${article.content}<br /><span style="float:right;">Published at: <sub>${article.published_at} </sub></span></div><br />
                        <div>
                            <a href="#" class="edit-article-btn btn btn-sm btn-primary" data-id="${article.id}" data-toggle="modal" data-target="#editModal">Edit</a>
                            <button class="btn btn-sm btn-danger" data-id="${article.id}" data-article-id="${article.id}">Delete</button>
                        </div><br />
                   </div>
                `;
                $('#article-list').append(listItem);
            });
        }
    });

    $('#article-list').on('click', '.edit-article-btn', function () {
        var articleId = $(this).data('id');
        $.ajax({
            url: '/api/articles/' + articleId,
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                var article = JSON.parse(response);
                $('#article_id').val(article.id);
                $('#title').val(article.title);
                $('#content').val(article.content);
                $('#image_url').attr('src', article.image_url);
                $('#published_at').val(article.published_at);
                $('#editModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
}

$(document).ready(function () {
    loadArticles();
});

$(document).ready(function () {
    $('#addmodel').on('click', '.add_model', function () {
        $('#addModal').modal('show');
    });
});

$(document).ready(function () {
    $('.close').click(function () {
        $('.popup').modal('hide');
    });
});

$(document).on('click', '.btn-danger', function () {
    var articleId = $(this).data('id');
    var confirmation = confirm("Are you sure you want to delete this article?");
    if (confirmation) {
        $.ajax({
            url: `/api/articles/${articleId}`,
            type: 'DELETE',
            dataType: 'json',
            success: function (response) {
                loadArticles();
            }
        });
    }
});

$('#create-article-form').submit(function (event) {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: '/api/articles',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (article) {
            alert("New Article Submitted");
            loadArticles();
        },
        error: function (xhr, status, error) {
            console.error('Error:', xhr.responseText);
        }
    });
});

$('#edit-article-form').submit(function (event) {
    event.preventDefault();
    var formData = new FormData(this);
    var articleId = $('#article_id').val();
    formData.append('_method', 'PUT');

    $.ajax({
        url: '/api/articles/' + articleId,
        type: 'POST',
        data: formData,
        processData: false,  
        contentType: false,  
        success: function (article) {
            $('.popup').modal('hide');
            loadArticles();
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
            console.error('Error:', xhr.responseText);
        }
    });

});

$(document).ready(function () {
  
    $('.edit-article-btn').click(function () {
        var articleId = $(this).data('article-id');
        $('#editModalContent').empty(); 
        $('#editModal').modal('show');
        loadEditForm(articleId);
    });

    function loadEditForm(articleId) {
        $.ajax({
            url: '/api/articles/' + articleId + '/edit',
            type: 'GET',
            dataType: 'html',
            success: function (response) {
                $('#editModalContent').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Error:', xhr.responseText);
            }
        });
    }

});
