<h1 class="mb-4">Ventas</h1>
<div id="navbar" class="mb-4">
    <a href="#" class="nav-ventas btn btn-primary me-2" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="nav-ventas btn btn-secondary link-nav-interno-activo" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>
<h3 class="mb-4">Registrar Nueva Venta</h3>
<form id="ventaForm" method="POST" action="<?= BASE_URI; ?>/ventas/registrar" class="mb-4">
    <div class="mb-3">
        <label for="id_usuario_texto" class="form-label">Usuario: </label>
        <input type="text" id="id_usuario_texto" name="id_usuario_texto" class="form-control" value="cajeroventa" readonly>
        <input type="hidden" id="id_usuario" name="id_usuario" value="1">
    </div>
    <div class="mb-3">
        <label for="cliente" class="form-label">Cliente: </label>
        <input type="text" id="cliente" name="cliente" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="fecha_venta" class="form-label">Fecha: </label>
        <input type="date" id="fecha_venta" name="fecha_venta" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="id_metodopago" class="form-label">Método de pago: </label>
        <select id="id_metodopago" name="id_metodopago" class="form-select" required>
            <option value="">Seleccione un método de pago</option>
            <option value="1">Efectivo</option>
            <option value="2">Tarjeta</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="buscar_producto" class="form-label">Buscar Producto:</label>
        <input type="text" id="buscar_producto" name="buscar_producto" class="form-control">
        <div id="resultados_busqueda" class="dropdown mt-2"></div>
    </div>
    <div id="detallesContainer" class="mb-3"> <!-- Contenedor para los productos -->
    </div>
    <div class="mb-3">
        <label for="total" class="form-label">Total: </label>
        <input type="text" id="total" name="total" class="form-control" readonly>
    </div>

    <button type="submit" class="btn btn-success">Guardar Venta</button>
</form>