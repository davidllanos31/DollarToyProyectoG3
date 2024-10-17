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
                        resultado += '<a href="/categorias/edit/' + categoria.id + '">Editar</a>';
                        resultado += ' <a href="/categorias/delete/' + categoria.id + '" onclick="return confirm(\'¿Estás seguro?\')">Eliminar</a>';
                        resultado += '</td>';
                        resultado += '</tr>';
                    });
                }

                $('#categoriasTable tbody').html(resultado);
            }
        });

    });
});