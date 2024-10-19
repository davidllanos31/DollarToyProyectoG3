$(document).ready(function () {
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
                        resultado += '<a href="/sedes/edit/' + sede.id + '">Editar</a>';
                        resultado += ' <a href="/sedes/delete/' + sede.id + '" onclick="return confirm(\'¿Estás seguro?\')">Eliminar</a>';
                        resultado += '</td>';
                        resultado += '</tr>';
                    });
                }

                $('#sedesTable tbody').html(resultado);
            }
        });

    });
});