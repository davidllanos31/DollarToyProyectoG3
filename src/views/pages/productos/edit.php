 <form action="/productos/update/<?php echo $producto->getId(); ?>" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $producto->getNombre(); ?>" required>

    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" id="descripcion" value="<?php echo $producto->getDescripcion(); ?>" required>

    <label for="precio">Precio</label>
    <input type="number" name="precio" id="precio" value="<?php echo $producto->getPrecio(); ?>" required>

    <label for="id_categoria_producto">Categoría</label>
    <select name="id_categoria_producto" id="id_categoria_producto" required>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id']; ?>" >
                <?= $categoria['nombre']; ?>
            </option>
            <?php
                var_dump($categoria);
            ?>
        <?php endforeach; ?>
    </select>

    <label for="id_sede">Sede</label>
    <select name="id_sede" id="id_sede" required>
        <?php foreach ($sedes as $sede): ?>
            <option value="<?= $sede['id']; ?>"><?= $sede['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="stock">Stock Disponible</label>
    <input type="number" name="stock_disponible" id="stock" value="<?php echo $producto->getStockDisponible(); ?>" required>

    <button type="submit">Actualizar</button>
</form>
<script>
    document.getElementById('id_categoria_producto').addEventListener('change', function() {
        const formData = new FormData(this.form);
        console.log(formData);
        $.ajax({
            url: '/DollarToyProyectoG3/productos/update',
            method: 'POST',
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                alert(res.message);
                window.location.href = '/DollarToyProyectoG3/productos';
            },
            error: function () {
                alert("Error al actualizar el producto.");
            }
        });
    });
</script>