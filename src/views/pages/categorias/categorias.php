<h2 class="mb-4">Categorias</h2>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/categorias" class="nav-ventas btn btn-secondary">Listar Categorias</a>
    <a href="<?= BASE_URI; ?>/categorias/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nueva Categoria</a>
</div>
<input type="text" id="buscar-categorias" placeholder="Buscar categorias...">
<!--<button><a href="<?= BASE_URI; ?>/src/controllers/lib_props.php?categorias=<?= urlencode(json_encode($categorias)); ?>">Excel</a></button>-->
<table id="categoriasTable" border="1" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?php echo $categoria->getId(); ?></td>
                <td><?php echo $categoria->getNombre(); ?></td>
                <td><?php echo $categoria->getDescripcion(); ?></td>
                <td>
                <a href="<?= BASE_URI; ?>/categorias/editar/<?php echo $categoria->getId(); ?>" class="btn btn-success">Editar</a>
                <a href="#" class="btn btn-danger" onclick="confirmarEliminacion(<?= $categoria->getId(); ?>)">Eliminar</a>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div id="editarModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Categoría</h5>
            </div>
            <div class="modal-body">
                <form id="editarCategoriaForm">
                    <input type="hidden" id="categoriaId" name="id">
                    <div class="form-group">
                        <label for="categoriaNombre">Nombre</label>
                        <input type="text" class="form-control" id="categoriaNombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="categoriaDescripcion">Descripción</label>
                        <textarea class="form-control" id="categoriaDescripcion" name="descripcion" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="cerrarC" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarCambiosC">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script> 
    document.addEventListener('DOMContentLoaded', function() {
    
    const editarModal = new bootstrap.Modal(document.getElementById('editarModal'));

    document.querySelectorAll('a[href*="editar"]').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            const categoriaId = this.href.split('/').pop(); 
            const categoriaNombre = this.closest('tr').children[1].innerText;
            const categoriaDescripcion = this.closest('tr').children[2].innerText;

            document.getElementById('categoriaId').value = categoriaId;
            document.getElementById('categoriaNombre').value = categoriaNombre;
            document.getElementById('categoriaDescripcion').value = categoriaDescripcion;

            editarModal.show();
        });
        $('.close, .btn-secondary').on('click', function() {
            $('#editarModal').modal('hide');
        });
    });
});


</script>




