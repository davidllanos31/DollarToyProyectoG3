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
                        resultado += '<td>' + producto.imagen_url + '</td>';
                        resultado += '<td>' + producto.id_categoria_producto + '</td>';
                        resultado += '<td>';
                        resultado += '<a href="/categorias/editar/" class="btn btn-success">Editar</a>';
                        resultado += '<a href="#" class="btn btn-danger" onclick="">Eliminar</a>';
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

function confirmarEliminacion(productoId) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "No podrás deshacer esta acción.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/DollarToyProyectoG3/productos/eliminar?id=' + productoId,
                type: 'POST',
                data: 'json',
                success: function(response) {
                    const data = JSON.parse(response);
                    alert(data.message);
                    if (data.status === 'success') {
                        location.reload(); // Recargar la página para ver los cambios
                    }
                },
                error: function() {
                    location.reload();
                }
             });
        }
    });
}