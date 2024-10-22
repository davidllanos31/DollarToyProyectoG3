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
<table id="productosTable"  class="table">
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
                <td><?php echo $producto->getId(); ?></td>
                <td><?php echo $producto->getNombre(); ?></td>
                <td><?php echo $producto->getDescripcion(); ?></td>
                <td><?php echo $producto->getPrecio(); ?></td>
                <td><?php echo $producto->getImg(); ?></td>
                <td><?php echo $producto->getCategoria(); ?></td>
                <td>
                    <a href="<?= BASE_URI; ?>/sedes/editar/<?php echo $sede->getId(); ?>" class="btn btn-primary">Editar</a>
                    <button class="btn btn-danger" onclick="confirmarEliminacionSede(<?= $sede->getId(); ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
  </tbody>
</table>
