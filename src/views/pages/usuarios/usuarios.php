


<h2 class="mb-4">Usuarios</h2>
<div id="navbar" class="mb-4">
    <a href="<?= BASE_URI; ?>/usuarios" class="btn btn-secondary">Listar Usuarios</a>
    <button onclick="window.location.href='<?= BASE_URI; ?>/usuarios/crear'" class="btn btn-primary">Agregar Usuarios</button>
</div>

<div class="mb-4">
    <input type="text" id="buscar-usuarios" class="form-control" placeholder="Buscar Usuarios...">
</div>

<table id="usuariosTable" border="1" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Celular</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario->getId(); ?></td>
                <td><?php echo $usuario->getNombre(); ?></td>
                <td><?php echo $usuario->getApellido(); ?></td>
                <td><?php echo $usuario->getEmail(); ?></td>
                <td><?php echo $usuario->getCelular(); ?></td>
                <td><?php echo $usuario->getRol(); ?></td>
                <td>
                    <a href="<?= BASE_URI; ?>/usuarios/editar/<?php echo $usuario->getId(); ?>">Editar</a>
                    <a href="<?= BASE_URI; ?>/usuarios/eliminar/<?php echo $usuario->getId(); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>