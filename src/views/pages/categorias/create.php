<h1 class="mb-4">Nueva Categoria</h1>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/categorias" class="nav-ventas btn btn-secondary">Listar Categorias</a>
    <a href="<?= BASE_URI; ?>/categorias/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nueva Categoria</a>
</div>
<form id="categoriaForm" action="<?= BASE_URI; ?>/usuarios/store" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" id="descripcion" required>
    
    <button type="submit">Guardar</button>
</form>