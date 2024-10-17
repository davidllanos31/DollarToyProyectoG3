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
                <a href="/categorias/edit/<?php echo $categoria->getId(); ?>">Editar</a>
                <a href="/categorias/delete/<?php echo $categoria->getId(); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>