<h1>Ventas</h1>
<div id="navbar">
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>
<h3>Nueva Venta</h3>
<form id="formVenta" action="ruta_a_procesar_venta.php" method="POST">
        <!-- Datos de la Venta -->
        <div>
            <label for="id_usuario">Vendedor</label>
            <select id="id_usuario" name="id_usuario" required>
                <option value="">Seleccionar usuario</option>
                <!-- Aquí se llenarán los usuarios de la base de datos -->
                <option value="1">Usuario 1</option>
                <option value="2">Usuario 2</option>
            </select>
        </div>

        <!-- <div>
            <label for="id_cliente">Cliente</label>
            <select id="id_cliente" name="id_cliente" required>
                <option value="">Seleccionar cliente</option>
                Aquí se llenarán los clientes de la base de datos
                <option value="1">Cliente 1</option>
                <option value="2">Cliente 2</option>
            </select>
        </div> -->

        <div>
            <label for="id_metodopago">Método de Pago</label>
            <select id="id_metodopago" name="id_metodopago" required>
                <option value="">Seleccionar método de pago</option>
                <!-- Aquí se llenarán los métodos de pago de la base de datos -->
                <option value="1">Tarjeta de crédito</option>
                <option value="2">Transferencia bancaria</option>
            </select>
        </div>

        <div>
            <label for="total">Total</label>
            <input type="number" id="total" name="total" step="0.01" min="0" required>
        </div>

        <!-- Detalles de la Venta -->
        <h3>Detalles de la Venta</h3>
        <div id="detallesVenta">
            <div class="detalleVenta">
                <div>
                    <label for="id_producto_0">Producto</label>
                    <select id="id_producto_0" name="productos[0][id_producto]" required>
                        <option value="">Seleccionar producto</option>
                        <!-- Aquí se llenarán los productos de la base de datos -->
                        <option value="1">Producto 1</option>
                        <option value="2">Producto 2</option>
                    </select>
                </div>

                <div>
                    <label for="cantidad_0">Cantidad</label>
                    <input type="number" id="cantidad_0" name="productos[0][cantidad]" min="1" required>
                </div>

                <div>
                    <label for="precio_unitario_0">Precio Unitario</label>
                    <input type="number" id="precio_unitario_0" name="productos[0][precio_unitario]" step="0.01" min="0" required>
                </div>
            </div>
        </div>

        <div>
            <button type="button" id="addDetalle" disabled>Agregar Producto</button>
        </div>

        <button type="submit">Registrar Venta</button>
    </form>