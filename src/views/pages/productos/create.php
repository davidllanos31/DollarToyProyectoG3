<h1 class="mb-4">Nuevo Producto</h1>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/productos" class="nav-ventas btn btn-secondary">Listar Productos</a>
    <a href="<?= BASE_URI; ?>/productos/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nuevo Producto</a>
</div>

<form id="productoForm" style="display: flex; flex-direction: column;">
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
            <option value="<?= $categoria['id']; ?>" >
                <?= $categoria['nombre']; ?>
            </option>
            <?php
                var_dump($categoria);
            ?>
        <?php endforeach; ?>
    </select>

    <label for="sede">Sede</label>
    <select name="id_sede" id="sede" required>
        <?php foreach ($sedes as $sede): ?>
            <option value="<?= $sede['id']; ?>"><?= $sede['nombre']; ?></option>
        <?php endforeach; ?>
    </select>

    <label for="stock">Stock Disponible</label>
    <input type="number" name="stock_disponible" id="stock" required>

    <button type="submit">Guardar</button>
</form>
<script>
    document.getElementById('categoria').addEventListener('change', function() {
        const formData = new FormData(this.form);
        console.log(formData);
        $.ajax({
            url: '/DollarToyProyectoG3/productos/store',
            method: 'POST',
            data: formData,
            success: function (response) {
                var res = JSON.parse(response);
                // alert(res.message);
                // window.location.href = '/DollarToyProyectoG3/productos';
            },
            error: function () {
                alert("Error al guardar el producto.");
            }
        });
    });
</script>