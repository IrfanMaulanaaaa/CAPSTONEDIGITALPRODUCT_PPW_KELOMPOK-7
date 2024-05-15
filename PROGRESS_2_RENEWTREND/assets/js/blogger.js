$(document).ready(function() {
    $('.blog-item').click(function() {
        var blogId = $(this).data('blog-id');
        $.ajax({
            url: 'get_blog_content.php',
            type: 'GET',
            data: { id: blogId },
            dataType: 'json',
            success: function(response) {
                $('.blog-content-container').html('<h3>' + response.title + '</h3><img src="' + response.image_path + '" alt="Blog Image" style="width: 25%;"><p>' + response.content + '</p><p>Oleh ' + response.creator_name + '</p>');
                if (response.status === 'rejected' && response.rejection_notes) {
                    $('.blog-content-container').append('<div class="rejection-note-container"><h3>Rejection Note</h3><p>' + response.rejection_notes + '</p></div>');
                }
                $('.blog-content-container').data('blog-id', blogId);
                $('.blog-content-container').show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});
