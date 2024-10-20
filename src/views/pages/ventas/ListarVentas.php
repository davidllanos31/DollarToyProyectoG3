<h1>Ventas</h1>
<div id="navbar">
    <a href="#" class="nav-ventas link-nav-interno-activo" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>

<h1>Listado de Ventas</h1>
<div><label for="buscar_venta"></label><input type="text" id="buscar_venta" name="buscar_venta" placeholder="Buscar venta"></div>

<?php if (!empty($ventas)): ?>
    <table border="1" cellpadding="10" cellspacing="">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>ID Usuario</th>
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
<?php else: ?>
    <p>No hay ventas disponibles.</p>
<?php endif; ?>