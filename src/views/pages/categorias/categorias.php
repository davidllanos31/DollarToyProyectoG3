<input type="text" id="buscar" placeholder="Buscar productos...">
<div id="resultado"></div>

<table id="categoriasTable" border="1" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?php echo $categoria->getId(); ?></td>
                <td><?php echo $categoria->getNombre(); ?></td>
                <td><?php echo $categoria->getDescripcion(); ?></td>
                <td>
                    <a href="/categorias/editar/<?php echo $categoria->getId(); ?>">Editar</a>
                    <a href="/categorias/eliminar/<?php echo $categoria->getId(); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#buscar').on('keyup', function() {
            var query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: '/DollarToyProyectoG3/categorias/buscar',
                    method: 'POST',
                    data: {
                        query: query,
                        action: 'buscar'
                    },
                    success: function(response) {
                        var data = JSON.parse(response);
                        console.log(data);
                        var resultado = '';
                        data.forEach(function(categoria) {
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

                        $('#categoriasTable tbody').html(resultado);
                    }
                });
            }
        });
    });
</script>