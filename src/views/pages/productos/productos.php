<input type="text" id="buscar-productos" placeholder="Buscar productos...">

<table id="productosTable" border="1" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Stock</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td><?php echo $producto->getId(); ?></td>
                <td><?php echo $producto->getNombre(); ?></td>
                <td><?php echo $producto->getDescripcion(); ?></td>
                <td><?php echo $producto->getPrecio(); ?></td>
                <td><?php echo $producto->getImg(); ?></td>
                <td>H0la</td>
                <td>
                    <!-- 
                <a href="<?= BASE_URI; ?>/categorias/editar/<?php echo $categoria['id']; ?>">Editar</a>
                <a href="<?= BASE_URI; ?>/categorias/eliminar/<?php echo $categoria['id']; ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a> 
                -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>