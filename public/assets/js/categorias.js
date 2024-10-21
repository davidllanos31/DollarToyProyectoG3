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
    });

    document.getElementById('guardarCambios').addEventListener('click', function() {
        editarModal.hide();
    });
    
    $('.close, .btn-secondary').on('click', function() {
        $('#editarModal').modal('hide');
    });
});

function confirmarEliminar(categoriaId) {
    swal({
        title: "¿Estás seguro?",
        text: "Una vez eliminado, no podrás recuperar esta categoría!",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancelar",
                value: null,
                visible: true,
                className: "btn-secondary",
                closeModal: true
            },
            confirm: {
                text: "Eliminar",
                value: true,
                visible: true,
                className: "btn-danger",
                closeModal: false
            }
        },
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            fetch(`/categorias/eliminar/${categoriaId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ '_method': 'DELETE' })
            })
            .then(response => {
                if (response.ok) {
                    window.location.reload(); 
                } else {
                    swal("Error", "No se pudo eliminar la categoría", "error");
                }
            });
        }
    });
}


