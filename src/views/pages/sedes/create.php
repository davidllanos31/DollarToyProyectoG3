<form id="sedeForm" action="<?= BASE_URI; ?>/sedes/crear" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="direccion">Direccion</label>
    <input type="text" name="direccion" id="direccion" required>

    <label for="ciudad">Ciudad</label>
    <input type="text" name="ciudad" id="ciudad" required>

    <button type="submit">Guardar</button>
</form>