$(document).ready(function () {
    $('#buscar-productos').on('keyup', function () {
        var query = $(this).val();
        // if (query.length > 0) {
        $.ajax({
            url: '/DollarToyProyectoG3/productos/buscar',
            method: 'GET',
            data: {
                query: query || '',
                action: 'buscar'
            },
            success: function (response) {
                var data = JSON.parse(response);
                console.log(data);
                var resultado = '';
                if (data.length === 0) {
                    resultado += '<tr><td colspan="5">No se encontraron resultados</td></tr>';
                } else {
                    data.forEach(function (producto) {
                        resultado += '<tr>';
                        resultado += '<td>' + producto.id + '</td>';
                        resultado += '<td>' + producto.nombre + '</td>';
                        resultado += '<td>' + producto.descripcion + '</td>';
                        resultado += '<td>' + producto.precio + '</td>';
                        resultado += '<td>';
                        resultado += '<a href="/productos/edit/' + producto.id + '">Editar</a>';
                        resultado += ' <a href="/productos/delete/' + producto.id + '" onclick="return confirm(\'¿Estás seguro?\')">Eliminar</a>';
                        resultado += '</td>';
                        resultado += '</tr>';
                    });
                }
                $('#productosTable tbody').html(resultado);
            }
        });

    });
    
    $('#productoForm').on('submit', function(e) {
        e.preventDefault();
    
        var formData = new FormData(this); // Permite manejar los archivos
    
        $.ajax({
            url: '/DollarToyProyectoG3/productos/store', // La URL donde se procesará el formulario
            method: 'POST',
            data: formData,
            processData: false, // Necesario para el manejo de archivos
            contentType: false, // Necesario para el manejo de archivos
            success: function(response) {
                var res = JSON.parse(response);
                alert(res.message);
                window.location.href = '/DollarToyProyectoG3/productos'; // Redirige tras guardar el producto
            },
            error: function() {
                alert("Error al guardar el producto.");
            }
        });
    });
    
});