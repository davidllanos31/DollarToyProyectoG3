$(document).ready(function () {
    $('#buscar-roles').on('keyup', function () {
        var query = $(this).val();
        // if (query.length > 0) {
        $.ajax({
            url: '/DollarToyProyectoG3/roles/buscar',
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
                    data.forEach(function (roles) {
                        resultado += '<tr>';
                        resultado += '<td>' + roles.id + '</td>';
                        resultado += '<td>' + roles.nombre + '</td>';
                        resultado += '<td>';
                        resultado += '<a href="/roles/edit/' + roles.id + '">Editar</a>';
                        resultado += ' <a href="/roles/delete/' + roles.id + '" onclick="return confirm(\'¿Estás seguro?\')">Eliminar</a>';
                        resultado += '</td>';
                        resultado += '</tr>';
                    });
                }

                $('#rolesTable tbody').html(resultado);
            }
        });

    });
});