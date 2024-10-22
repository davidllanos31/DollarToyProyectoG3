$(document).ready(function () {
    // CODIGO BUSQUEDA 
    $('#buscar-sedes').on('keyup', function () {
        var query = $(this).val();
        // if (query.length > 0) {
        $.ajax({
            url: '/DollarToyProyectoG3/sedes/buscar',
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
                    data.forEach(function (sede) {
                        resultado += '<tr>';
                        resultado += '<td>' + sede.id + '</td>';
                        resultado += '<td>' + sede.nombre + '</td>';
                        resultado += '<td>' + sede.direccion + '</td>';
                        resultado += '<td>' + sede.ciudad + '</td>';
                        resultado += '<td>';
                        resultado += '<a href="<?= BASE_URI; ?>/sedes/editar/<?php echo $sede->getId(); ?>" class="btn btn-primary">Editar</a>';
                        resultado += '<button class="btn btn-danger" data-id="<?php echo $sede->getId(); ?>">Eliminar</button>';
                        resultado += '</td>';
                        resultado += '</tr>';
                    });
                }

                $('#sedesTable tbody').html(resultado);
            }
        });

    });
    // CODIGO CREAR
    $('#sedeForm').on('submit',function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            url: '/DollarToyProyectoG3/sedes/store',
            method: 'POST',         
            data: formData,
            success: function (response) {
                if (response) {
                    var res = JSON.parse(response);
                    alert(res.message);
                    window.location.href = '/DollarToyProyectoG3/sedes';
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

    // CODIGO ELIMINAR
    $(document).ready(function() {
        $('.btnEliminar').on('click', function() {
            var sedeId = $(this).data('id'); // Obtiene el ID de la sede del botón

            if (confirm('¿Estás seguro de que deseas eliminar esta sede?')) {
                $.ajax({
                    url: '/DollarToyProyectoG3/sedes/eliminar?id=' + sedeId, // Ajusta la URL si es necesario
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        alert(response.message); // Muestra el mensaje
    
                        if (response.status === 'success') {
                            // Recargar la página o eliminar la fila de la tabla
                            location.reload(); // O puedes eliminar la fila directamente del DOM
                        }
                    },
                    error: function() {
                        alert('Error al eliminar la sede. Inténtalo de nuevo.');
                    }
                });
            }
        });
    });

    
    // CODIGO EDITAR
    $('#guardarCambios').on('click', function() {
        const formData = $('#editarsedeForm').serialize();
        console.log(formData);
        $.ajax({
            url: '/DollarToyProyectoG3/sedes/editar', // Cambia esta URL según tu configuración
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

function confirmarEliminacionSede(sedeId) {
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
                url: '/DollarToyProyectoG3/sedes/eliminar?id=' + sedeId,
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