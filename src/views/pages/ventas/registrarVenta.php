<h1>Ventas</h1>
<div id="navbar">
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas">Listar Ventas</a>
    <a href="#" class="nav-ventas" data-url="<?= BASE_URI; ?>/ventas/crear">Registrar Nueva Venta</a>
</div>
<h1>Registrar Nueva Venta</h1>
<h1>Registrar Venta</h1>

<form action="/crear-venta" method="POST">
    <fieldset>
        <legend>Datos de la Venta</legend>

        <label for="usuario">ID Usuario:</label>
        <input type="number" id="usuario" name="id_usuario" required><br>

        <label for="cliente">Cliente:</label>
        <input type="text" id="cliente" name="cliente" required><br>

        <label for="fecha_venta">Fecha de Venta:</label>
        <input type="date" id="fecha_venta" name="fecha_venta" required><br>

        <label for="metodo_pago">Método de Pago:</label>
        <select id="metodo_pago" name="id_metodopago" required>
            <option value="1">Tarjeta</option>
            <option value="2">Efectivo</option>
            <option value="3">Transferencia</option>
        </select><br>

        <label for="total">Total:</label>
        <input type="number" id="total" name="total" step="0.01" required><br>

    </fieldset>

    <fieldset>
        <legend>Productos</legend>

        <table id="productos">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="producto[]" required></td>
                    <td><input type="number" name="cantidad[]" required></td>
                    <td><input type="number" name="precio_unitario[]" step="0.01" required></td>
                    <td><button type="button" onclick="eliminarProducto(this)">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
        <button type="button" onclick="agregarProducto()">Agregar Producto</button>

    </fieldset>

    <button type="submit">Guardar Venta</button>

</form>
<script>
    function agregarProducto() {
        // Crear fila para agregar nuevo producto en la tabla
        const tablaProductos = document.getElementById('productos');
        const nuevaFila = tablaProductos.insertRow();

        nuevaFila.innerHTML = `
                <td><input type="text" name="producto[]" required></td>
                <td><input type="number" name="cantidad[]" required></td>
                <td><input type="number" name="precio_unitario[]" step="0.01" required></td>
                <td><button type="button" onclick="eliminarProducto(this)">Eliminar</button></td>
            `;
    }

    function eliminarProducto(boton) {
        const fila = boton.parentElement.parentElement;
        fila.remove();
    }
</script>