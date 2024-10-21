    // MANEJA NAVEGACIÓN
    $('#content').on('click', '.nav-ventas', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('#content').html(response);
            },
            error: function () {
                $('#content').html('<p>Error al cargar la página.</p>');
            }
        });
    });
