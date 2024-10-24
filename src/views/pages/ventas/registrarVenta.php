
<h2 class="mb-4">Ventas</h2>
<div id="navbar" class="mb-4">
    <a href="#" class="nav-ventas btn btn-secondary" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>
<form id="ventaForm" method="POST" action="<?= BASE_URI; ?>/ventas/registrar" class="mb-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="id_usuario_texto" class="form-label">Vendedor:</label>
            <input type="text" id="id_usuario_texto" name="id_usuario_texto" class="form-control" value="Alan_Brito_cajero" readonly>
            <input type="hidden" id="id_usuario" name="id_usuario" value="1">
        </div>
        <div class="col-md-6">
            <label for="cliente" class="form-label">Cliente:</label>
            <input type="text" id="cliente" name="cliente" class="form-control" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="fecha_venta" class="form-label">Fecha:</label>
            <input type="date" id="fecha_venta" name="fecha_venta" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
        </div>
        <div class="col-md-6">
            <label for="id_metodopago" class="form-label">Método de pago:</label>
            <select id="id_metodopago" name="id_metodopago" class="form-select" required>
                <option value="">Seleccione un método de pago</option>
                <option value="1">Efectivo</option>
                <option value="2">Tarjeta</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="buscar_producto" class="form-label">Buscar Producto:</label>
        <input type="text" id="buscar_producto" name="buscar_producto" class="form-control">
        <div id="resultados_busqueda" class="dropdown mt-2"></div>
    </div>
    <div id="detallesContainer" class="mb-3">
    <table class="table table-sm">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre Producto</th> <!-- Nueva columna -->
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Sub Total</th>
            </tr>
        </thead>
        <tbody id="detallesBody"><!-- Las filas de detalles -->
        </tbody>
    </table>
</div>
    </div>
    <div class="row mb-3 align-items-end">
        <div class="col-md-6">
            <label for="total" class="form-label">Total:</label>
            <input type="text" id="total" name="total" class="form-control" readonly>
        </div>
        <div class="col-md-6 text-start">
            <button type="submit" class="btn btn-success">Guardar Venta</button>
        </div>
    </div>
</form>


<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                La venta se ha guardado exitosamente.
            </div>
            <div class="modal-footer">
                <button type="button" id="closeSuccessModal" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Carga -->
<div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Cargando...</span>
                </div>
                <p>Cargando...</p>
            </div>
        </div>
    </div>
</div>