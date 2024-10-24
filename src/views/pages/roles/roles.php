<input type="text" id="buscar-categorias" placeholder="Buscar productos...">

<table class="table table-striped" id="rolesTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $rol): ?>
        <tr>
            <td><?php echo $rol->getId(); ?></td>
            <td><?php echo $rol->getNombre(); ?></td>
            <td>
                <a href="/roles/edit/<?php echo $rol->getId(); ?>">Editar</a>
                <a href="/roles/delete/<?php echo $rol->getId(); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>