<h2 class="mb-4">Sedes</h2>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/sedes" class="nav-ventas btn btn-secondary">Listar Sedes</a>
    <a href="<?= BASE_URI; ?>/sedes/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nueva Sede</a>
</div>
<form id="sedeForm" action="<?= BASE_URI; ?>/sedes/crear" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="direccion">Direccion</label>
    <input type="text" name="direccion" id="direccion" required>

    <label for="ciudad">Ciudad</label>
    <input type="text" name="ciudad" id="ciudad" required>

    <button type="submit">Guardar</button>
</form>