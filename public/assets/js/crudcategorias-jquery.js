$(document).ready(function() {
    // Leer todos los usuarios
    function loadUsers() {
        $.ajax({
            url: 'controller.php',
            method: 'POST',
            data: { action: 'read' },
            success: function(response) {
                const users = JSON.parse(response);
                let rows = '';
                users.forEach(user => {
                    rows += `
                        <tr>
                            <td>${user.id}</td>
                            <td>${user.name}</td>
                            <td>${user.email}</td>
                            <td>
                                <button class="editBtn" data-id="${user.id}" data-name="${user.name}" data-email="${user.email}">Editar</button>
                                <button class="deleteBtn" data-id="${user.id}">Eliminar</button>
                            </td>
                        </tr>
                    `;
                });
                $('#usersTable tbody').html(rows);
            }
        });
    }

    loadUsers();

    // Crear o actualizar usuario
    $('#userForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            id: $('#userId').val(),
            name: $('#name').val(),
            email: $('#email').val(),
            action: $('#userId').val() ? 'update' : 'create'
        };

        $.ajax({
            url: 'controller.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                const result = JSON.parse(response);
                alert(result.message);
                $('#userForm')[0].reset();
                $('#userId').val('');
                loadUsers();
            }
        });
    });

    // Rellenar el formulario para editar
    $(document).on('click', '.editBtn', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');

        $('#userId').val(id);
        $('#name').val(name);
        $('#email').val(email);
    });

    // Eliminar usuario
    $(document).on('click', '.deleteBtn', function() {
        const id = $(this).data('id');
        if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
            $.ajax({
                url: 'controller.php',
                method: 'POST',
                data: { id: id, action: 'delete' },
                success: function(response) {
                    const result = JSON.parse(response);
                    alert(result.message);
                    loadUsers();
                }
            });
        }
    });

});