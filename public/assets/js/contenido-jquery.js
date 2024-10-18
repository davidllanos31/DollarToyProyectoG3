$(document).ready(function() {
    $(document).on('click', '.nav-link', function(e) {
        e.preventDefault();
        var url = $(this).data('url');

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#content').html(response);
                history.pushState(null, '', url);
            },
            error: function() {
                $('#content').html('<p>Error al cargar la página.</p>');
            }
        });
    });
});
