$(document).ready(function() {
    $('.blog-item.pending').click(function() {
        var blogId = $(this).data('blog-id');
        
        $.ajax({
            url: 'get_blog_content.php',
            type: 'GET',
            data: { id: blogId },
            dataType: 'json',
            success: function(response) {
                $('.blog-content-container').html('<h3>' + response.title + '</h3><img src="' + response.image_path + '" alt="Blog Image" style="width: 25%;"><p>' + response.content + '</p><p>Created by: ' + response.creator_name + '</p>');
                $('.blog-content-container').data('blog-id', blogId); 
                $('.blog-content-container').show();

                $('.action-buttons').show();
                $('#delete-btn').hide();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('.blog-item.published').click(function() {
        var blogId = $(this).data('blog-id');
        
        $.ajax({
            url: 'get_blog_content.php',
            type: 'GET',
            data: { id: blogId },
            dataType: 'json',
            success: function(response) {
                $('.blog-content-container').html('<h3>' + response.title + '</h3><img src="' + response.image_path + '" alt="Blog Image" style="width: 25%;"><p>' + response.content + '</p><p>Created by: ' + response.creator_name + '</p>');
                $('.blog-content-container').data('blog-id', blogId); // Simpan ID blog di dalam container untuk penggunaan berikutnya
                $('.blog-content-container').show();

                $('.action-buttons').hide();
                $('#delete-btn').show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Ketika tombol delete diklik
    $('#delete-btn').click(function() {
        var blogId = $('.blog-content-container').data('blog-id');
        $.ajax({
            url: 'delete_blog.php',
            type: 'POST',
            data: { id: blogId },
            success: function(response) {
                alert('Blog has been deleted!');
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Ketika tombol approve diklik
    $('#approve-btn').click(function() {
        var blogId = $('.blog-content-container').data('blog-id');
        $.ajax({
            url: 'update_blog_status.php',
            type: 'POST',
            data: { id: blogId, status: 'approved' },
            success: function(response) {
                alert('Blog has been approved!');
                sendNotificationToSubscribers(blogId);
                location.reload(); 
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
 $('#reject-btn').click(function() {
                $('#rejection-note').show();
            });

            $('#reject-submit').click(function() {
                var blogId = $('.blog-content-container').data('blog-id');
                var rejectionNote = $('#rejection-note-input').val();
                $.ajax({
                    url: 'update_blog_status.php',
                    type: 'POST',
                    data: { id: blogId, status: 'rejected', note: rejectionNote },
                    success: function(response) {
                        alert('Blog has been rejected with note: ' + rejectionNote);
                        location.reload(); 
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

    function sendNotificationToSubscribers(blogId) {
        $.ajax({
            url: 'send.php',
            type: 'POST',
            data: { blogId: blogId },
            success: function(response) {
                console.log('Notification sent to subscribers.');
            },
            error: function(xhr, status, error) {
                console.error('Failed to send notification to subscribers.');
                console.error(xhr.responseText);
            }
        });
    }
    $('.action-buttons').hide();
            $('#delete-btn').hide();

});
