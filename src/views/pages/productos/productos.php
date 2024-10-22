<?php
require __DIR__ . '/../../../controllers/lib_props.php';
$lib_props = new Lib_props()
?>

<h2 class="mb-4">Productos</h2>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/productos" class="nav-ventas btn btn-secondary">Listar Productos</a>
    <a href="<?= BASE_URI; ?>/productos/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nuevo Producto</a>
    <button class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">
        <a href="<?= $lib_props->generarEnlaceExcel($productos); ?>" style="color:black; border:none">Excel</a>
    </button>
</div>

<div class="mb-4">
    <input type="text" id="buscar-productos" class="form-control" placeholder="Buscar Productos">
</div>
<table id="productosTable" class="table">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Categoria</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($productos as $producto): ?>
            <tr>
                <td id="id"><?php echo $producto->getId(); ?></td>
                <td id="nombre"><?php echo $producto->getNombre(); ?></td>
                <td id="descripcion"><?php echo $producto->getDescripcion(); ?></td>
                <td id="precio"><?php echo $producto->getPrecio(); ?></td>
                <td id="img"><?php echo $producto->getImg(); ?></td>
                <td id="categoria"><?php foreach ($categorias as $categoria){
                                    if($producto->getCategoria() == $categoria['id']){
                                        echo $categoria['nombre'];
                                    }
                                }?></td>
                <td>
                    <a href="<?= BASE_URI; ?>/productos/editar/<?= $producto->getId(); ?>" class="btn btn-success btnEditar" data-id="<?= $producto->getId(); ?>" data-nombre="<?= $producto->getNombre(); ?>">Editar</a>
                    <a href="#" class="btn btn-danger" onclick="confirmarEliminacion(<?= $producto->getId(); ?>)">Eliminar</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div id="editarModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Producto</h5>
            </div>
            <div class="modal-body">
                <form id="productoForm" method="post" action="<?= BASE_URI; ?>/productos/actualizar">
                    <input type="hidden" name="id_producto" id="productoId">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="productoNombre" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" id="productoDescripcion" required>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" class="form-control" name="precio" id="productoPrecio" required>
                    </div>

                    <div class="mb-3">
                        <label for="img" class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="img" id="productoImg">
                    </div>

                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-select" name="id_categoria_producto" id="productoCategoria" required>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['id']; ?>"><?= $categoria['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sede" class="form-label">Sede</label>
                        <select class="form-select" name="id_sede" id="productoSede" required>
                            <?php foreach ($sedes as $sede): ?>
                                <option value="<?= $sede['id']; ?>"><?= $sede['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Disponible</label>
                        <input type="number" class="form-control" name="stock_disponible" id="productoStock" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" form="productoForm">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btnEditar').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const idProducto = this.getAttribute('data-id'); // Obtener el ID del producto desde el botón

                $.ajax({
                    url: '/DollarToyProyectoG3/productos/buscar', // Ruta para obtener los datos del producto
                    method: 'GET',
                    data: {
                        query: '',
                        id: idProducto,
                        action: 'buscar'
                    },
                    success: function(response) {
                        var data = JSON.parse(response)[0];
                        console.log("data", data);

                        document.getElementById('productoId').value = idProducto;
                        document.getElementById('productoNombre').value = data.nombre;
                        document.getElementById('productoDescripcion').value = data.descripcion;
                        document.getElementById('productoPrecio').value = parseFloat(data.precio);
                        // document.getElementById('productoImg').value = data.img;
                        document.getElementById('productoCategoria').value = data.id_categoria_producto;
                        document.getElementById('productoSede').value = data.id_sede;
                        document.getElementById('productoStock').value = data.stock_disponible;

                        $('#editarModal').modal('show');
                    },
                    error: function(error) {
                        console.error('Error al obtener los datos del producto:', error);
                        alert('Hubo un error al obtener los datos del producto. Inténtalo de nuevo.');
                    }
                });
            });
        });

        $('.close, .btn-secondary').on('click', function() {
            $('#editarModal').modal('hide');
        });
    });
</script>