<h1>Ventas</h1>
<div id="navbar">
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="nav-ventas link-nav-interno-activo" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>
<h2>Registrar Nueva Venta</h2>
<form id=ventaForm method="POST" action="<?= BASE_URI; ?>/ventas/registrar">
    <div>
        <label for="id_usuario_texto">Usuario: </label>
        <input type="text" id="id_usuario_texto" name="id_usuario_texto" value="cajeroventa" readonly>
        <input type="hidden" id="id_usuario" name="id_usuario" value="1">
    </div>
    <div>
        <label for="cliente">Cliente: </label>
        <input type="text" id="cliente" name="cliente" required>
    </div>
    <div>
        <label for="fecha_venta">Fecha: </label>
        <input type="date" id="fecha_venta" name="fecha_venta" value="<?php echo date('Y-m-d'); ?>" readonly>
    </div>
    <div>
        <label for="id_metodopago">Método de pago: </label>
        <select id="id_metodopago" name="id_metodopago" required>
            <option value="">Selecione un método de pago</option>
            <option value="1">Efectivo</option>
            <option value="2">Tarjeta</option>
        </select>
    </div>
    <div>
        <label for="total">total: </label>
        <input type="text" id="total" name="total" readonly>
    </div>
    <div id="detallesContainer">
        <div class="detalle">
            <label for="id_producto">ID Producto:</label>
            <input type="text" name="detalles[id_producto][]" required>
            <label for="cantidad_detalle">Cantidad:</label>
            <input type="number" name="detalles[cantidad][]" required class="cantidad">
            <label for="precio_unitario">Precio Unitario:</label>
            <input type="number" name="detalles[precio_unitario][]" required class="precio">
            <label for="sub_total">Sub Total:</label>
            <input type="number" name="sub_total[]" readonly class="sub-total">
        </div>
    </div>
    <button type="button" id="addDetalle">Añadir Detalle</button>
    <button type="submit">Guardar Venta</button>
</form>

<div>
    <label for="buscar_producto">Buscar Producto:</label>
    <input type="text" id="buscar_producto" name="buscar_producto">
    <div id="resultados_busqueda" class="dropdown"></div>
</div>