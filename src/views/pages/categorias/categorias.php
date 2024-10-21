

<input type="text" id="buscar-categorias" placeholder="Buscar categorias...">
<!--<button><a href="<?= BASE_URI; ?>/src/controllers/lib_props.php?categorias=<?= urlencode(json_encode($categorias)); ?>">Excel</a></button>-->
<table id="categoriasTable" border="1" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?php echo $categoria->getId(); ?></td>
                <td><?php echo $categoria->getNombre(); ?></td>
                <td><?php echo $categoria->getDescripcion(); ?></td>
                <td>
                    <a href="<?= BASE_URI; ?>/categorias/editar/<?php echo $categoria->getId(); ?>">Editar</a>
                    <a href="#" onclick="$controller->delete(<?= $categoria->getId(); ?>)">Eliminar</a>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="guardarCambios">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>



