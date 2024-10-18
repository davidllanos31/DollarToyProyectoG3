<h1>Ventas</h1>
<div id="navbar">
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>
<?php if (!empty($ventas)) : ?>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha de Venta</th>
                <th>Método de Pago</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($venta->nombre_cliente); ?></td>
                    <td><?php echo htmlspecialchars($venta->nombre_vendedor); ?></td>
                    <td><?php echo htmlspecialchars($venta->nombre_producto); ?></td>
                    <td><?php echo htmlspecialchars($venta->cantidad); ?></td>
                    <td><?php echo htmlspecialchars($venta->fecha_venta); ?></td>
                    <td><?php echo htmlspecialchars($venta->metodo_pago); ?></td>
                    <td><?php echo htmlspecialchars($venta->total); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No hay ventas disponibles</p>
<?php endif; ?>