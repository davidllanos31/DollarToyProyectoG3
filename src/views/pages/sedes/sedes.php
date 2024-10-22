<style>
.close {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: transparent;
    border: none; 
    font-size: 24px; 
    color: red; 
}

.close:hover {
    color: darkred;
}
</style>
<h2 class="mb-4">Sedes</h2>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/sedes" class="nav-ventas btn btn-secondary">Listar Sedes</a>
    <a href="<?= BASE_URI; ?>/sedes/crear" class="nav-ventas btn btn-primary me-2 link-nav-interno-activo">Registrar Nueva Sede</a>
</div>



<div class="mb-4">
    <input type="text" id="buscar-sedes" class="form-control" placeholder="Buscar Sedes...">
</div>

<table id="sedesTable"  class="table">
  <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Acciones</th>
        </tr>
  </thead>
  <tbody>
        <?php foreach ($sedes as $sede): ?>
            <tr>
                <td><?php echo $sede->getId(); ?></td>
                <td><?php echo $sede->getNombre(); ?></td>
                <td><?php echo $sede->getDireccion(); ?></td>
                <td><?php echo $sede->getCiudad(); ?></td>
                <td>
                <a href="<?= BASE_URI; ?>/sedes/editar/<?php echo $sede->getId(); ?>" class="btn btn-primary">Editar</a>
                <button class="btn btn-danger" onclick="confirmarEliminacionSede(<?= $sede->getId(); ?>)">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
  </tbody>
</table>

<!-- MODAL EDITAR -->
<div id="editarModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Sede</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editarsedeForm">
                    <input type="hidden" id="categoriaId" name="id">
                    <div class="form-group">
                        <label for="sedenombre">Nombre</label>
                        <input type="text" class="form-control" id="sedenombre" name="sedenombre" required>
                    </div>
                    <div class="form-group">
                        <label for="sededireccion">Dirección</label>
                        <textarea class="form-control" id="sededireccion" name="sededireccion" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="sedeciudad">Ciudad</label>
                        <textarea class="form-control" id="sedeciudad" name="sedeciudad" required></textarea>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editarModal = new bootstrap.Modal(document.getElementById('editarModal'));

    document.querySelectorAll('a[href*="editar"]').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            const categoriaId = this.href.split('/').pop(); 
            const categoriaNombre = this.closest('tr').children[1].innerText;
            const categoriaDireccion = this.closest('tr').children[2].innerText; // Cambié el nombre a 'categoriaDireccion'
            const categoriaCiudad = this.closest('tr').children[3].innerText; // Asegúrate de que sea la columna correcta

            document.getElementById('categoriaId').value = categoriaId;
            document.getElementById('sedenombre').value = categoriaNombre;
            document.getElementById('sededireccion').value = categoriaDireccion;
            document.getElementById('sedeciudad').value = categoriaCiudad;

            editarModal.show();
        });
    });

    // document.getElementById('guardarCambios').addEventListener('click', function() {
    //     const formData = $('#editarsedeForm').serialize();

    //     $.ajax({
    //         url: '<?= BASE_URI; ?>/sedes/update', // Cambia esta URL según tu configuración
    //         method: 'POST',
    //         data: formData,
    //         success: function(response) {
    //             const data = JSON.parse(response);
    //             alert(data.message);
    //             if (data.status === 'success') {
    //                 location.reload(); // Recargar la página para ver los cambios
    //             }
    //         },
    //         error: function() {
    //             alert('Error al guardar los cambios.');
    //         }
    //     });

    //     editarModal.hide(); // Cerrar el modal
    // });

    $('.close, .btn-secondary').on('click', function() {
        $('#editarModal').modal('hide');
    });
});
</script>