<h1 class="mb-4">Nuevo Producto</h1>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/productos" class="nav-ventas btn btn-secondary">Listar Productos</a>
    <a href="<?= BASE_URI; ?>/productos/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nuevo Producto</a>
</div>

<form id="productoForm" style="display: flex; flex-direction: column;">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" id="nombre" required>
    </div>
    
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <input type="text" class="form-control" name="descripcion" id="descripcion" required>
    </div>
    <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <input type="number" step="0.01" class="form-control" name="precio" id="precio" required>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Imagen</label>
        <input type="file" class="form-control" name="img" id="img" required>
    </div>
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría</label>
        <select class="form-select" aria-label="Default select example" name="id_categoria_producto" id="categoria" required>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id']; ?>" >
                    <?= $categoria['nombre']; ?>
                </option>
                <?php
                    var_dump($categoria);
                ?>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="sede" class="form-label">Sede</label>
        <select class="form-select" aria-label="Default select example" name="id_sede" id="sede" required>
            <?php foreach ($sedes as $sede): ?>
                <option value="<?= $sede['id']; ?>"><?= $sede['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="stock" class="form-label">Stock Disponible</label>
        <input type="number" class="form-control" name="stock_disponible" id="stock" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
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