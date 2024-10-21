<style>
    .table thead {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 1;
    }

    .table-wrapper {
        max-height: 480px;
        overflow-y: auto;
    }
</style>

<h2 class="mb-4">Ventas</h2>
<div id="navbar" class="mb-4">
    <a href="#" class="btn btn-primary me-2 nav-ventas link-nav-interno-activo" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="btn btn-secondary nav-ventas" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>
<div class="mb-4">
    <input type="text" id="buscar_venta" name="buscar_venta" class="form-control" placeholder="Buscar venta">
</div>
<?php if (!empty($ventas)): ?>
    <div class="table-wrapper">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID Venta</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Fecha de Venta</th>
                    <th>Método de Pago</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($venta->id_venta); ?></td>
                        <td><?php echo htmlspecialchars($venta->nombre_usuario); ?></td>
                        <td><?php echo htmlspecialchars($venta->cliente); ?></td>
                        <td><?php echo htmlspecialchars($venta->fecha_venta); ?></td>
                        <td><?php echo htmlspecialchars($venta->nombre_metodopago); ?></td>
                        <td><?php echo htmlspecialchars($venta->total); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        No hay ventas disponibles.
    </div>
<?php endif; ?>