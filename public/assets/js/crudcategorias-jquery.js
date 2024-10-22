$(document).ready(function () {
    $('#buscar-categorias').on('keyup', function () {
        var query = $(this).val();
        // if (query.length > 0) {
        $.ajax({
            url: '/DollarToyProyectoG3/categorias/buscar',
            method: 'POST',
            data: {
                query: query || '',
                action: 'buscar'
            },
            success: function (response) {
                var data = JSON.parse(response);
                console.log(data);
                var resultado = '';
                if (data.length === 0) {
                    resultado += '<tr><td colspan="4">No se encontraron resultados</td></tr>';
                } else {
                    data.forEach(function (categoria) {
                        resultado += '<tr>';
                        resultado += '<td>' + categoria.id + '</td>';
                        resultado += '<td>' + categoria.nombre + '</td>';
                        resultado += '<td>' + categoria.descripcion + '</td>';
                        resultado += '<td>';
                        resultado += '<a href="<?= BASE_URI; ?>/categorias/editar/<?php echo $categoria->getId(); ?>" class="btn btn-success">Editar</a>';
                        resultado += '<a href="#" class="btn btn-danger" onclick="confirmarEliminacion(<?= $categoria->getId(); ?>)">Eliminar</a>';
                        resultado += '</td>';
                        resultado += '</tr>';
                    });
                }

                $('#categoriasTable tbody').html(resultado);
            }
        });

    });

    $('#categoriaForm').on('submit',function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            url: '/DollarToyProyectoG3/categorias/store',
            method: 'POST',         
            data: formData,
            success: function (response) {
                if (response) {
                    var res = JSON.parse(response);
                    alert(res.message);
                    window.location.href = '/DollarToyProyectoG3/categorias';
                    console.log(response);
                    console.log(res);
                }
            },
            
            error: function () {
                alert("Error al guardar la sede.");
                
            }
        });
        console.log('Formulario enviado', formData);

    });

    $('#guardarCambiosC').on('click', function() {
        const formData = $('#editarCategoriaForm').serialize();
        console.log(formData);
        $.ajax({
            url: '/DollarToyProyectoG3/categorias/editar', // Cambia esta URL según tu configuración
            method: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                alert(data.message);
                if (data.status === 'success') {
                    location.reload(); // Recargar la página para ver los cambios
                }
            },
            error: function() {
                alert('Error al guardar los cambios.');
            }
        });
    
        editarModal.hide(); // Cerrar el modal
    });
});

function confirmarEliminacion(categoriaId) {
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
                url: '/DollarToyProyectoG3/categorias/eliminar?id=' + categoriaId,
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