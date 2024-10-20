<input type="text" id="buscar-categorias" placeholder="Buscar categorias...">
<!--<button><a href="<?= BASE_URI; ?>/src/controllers/lib_props.php?categorias=<?= urlencode(json_encode($categorias)); ?>">Excel</a></button>-->
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
                    <a href="<?= BASE_URI; ?>/categorias/editar/<?php echo $categoria->getId(); ?>">Editar</a>
                    <a href="<?= BASE_URI; ?>/categorias/eliminar/<?php echo $categoria->getId(); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>