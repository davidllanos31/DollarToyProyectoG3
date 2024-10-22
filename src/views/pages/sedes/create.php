<h2 class="mb-4">Sedes</h2>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/sedes" class="nav-ventas btn btn-secondary">Listar Sedes</a>
    <a href="<?= BASE_URI; ?>/sedes/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nueva Sede</a>
</div>


<form id="sedeForm" action="<?= BASE_URI; ?>/sedes/crear" method="POST">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre </label>
    <input type="text" name="nombre" class="form-control" id="nombre" required>
  </div>
  <div class="mb-3">
    <label for="direccion" class="form-label">Direccion</label>
    <input type="text" name="direccion" class="form-control" id="direccion" required>
  </div>
  <div class="mb-3">
    <label for="ciudad" class="form-label">Ciudad</label>
    <input type="text" name="ciudad" class="form-control" id="ciudad" required>
  </div>
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>
