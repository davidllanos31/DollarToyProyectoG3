<form id="productoForm" action="<?= BASE_URI; ?>/productos/crear"  method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" id="descripcion" required>

    <label for="precio">Precio</label>
    <input type="number" step="0.01" name="precio" id="precio" required>

    <label for="img">Imagen</label>
    <input type="file" name="img" id="img" required>

    <label for="categoria">Categoría</label>
    <select name="id_categoria_producto" id="categoria" required>
        <?php foreach ($categorias as $categoria): ?>
            <option value="<?= $categoria['id_categoria']; ?>"><?= $categoria['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="sede">Sede</label>
    <select name="id_sede" id="sede" required>
        <?php foreach ($sedes as $sede): ?>
            <option value="<?= $sede['id_sede']; ?>"><?= $sede['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="stock">Stock Disponible</label>
    <input type="number" name="stock_disponible" id="stock" required>

    <button type="submit">Guardar</button>
</form>
