<h1 class="mb-4">Nueva Categoria</h1>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/categorias" class="nav-ventas btn btn-secondary">Listar Categorias</a>
    <a href="<?= BASE_URI; ?>/categorias/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nueva Categoria</a>
</div>

<form id="categoriaForm" action="<?= BASE_URI; ?>/sedes/crear" method="POST">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre </label>
    <input type="text" name="nombre" class="form-control" id="nombre" required>
  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <input type="text" name="descripcion" class="form-control" id="descripcion" required>
  </div>    
  <button type="submit" class="btn btn-primary">Guardar</button>
</form>