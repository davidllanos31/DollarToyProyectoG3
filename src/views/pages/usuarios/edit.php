<h1><?php echo $title; ?></h1>
<form action="/usuarios/update/<?php echo $usuario->getId(); ?>" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $usuario->getNombre(); ?>" required>

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" value="<?php echo $usuario->getApellido(); ?>" required>

    <label for="email">Correo Electrónico</label>
    <input type="email" name="email" id="email" value="<?php echo $usuario->getEmail(); ?>" required>

    <label for="celular">Celular</label>
    <input type="text" name="celular" id="celular" value="<?php echo $usuario->getCelular(); ?>" required>

    <label for="fecha_registro">Fecha de Registro</label>
    <input type="date" name="fecha_registro" id="fecha_registro" value="<?php echo $usuario->getFechaRegistro(); ?>" required>

    <label for="rol">Rol</label>
    <select name="rol" id="rol" required>
        <option value="">Seleccione un rol</option>

        <?php foreach ($roles as $rol): ?>
            <option value="<?php echo $rol->getId(); ?>" <?php echo $usuario->getRol() == $rol->getId() ? 'selected' : ''; ?>>
                <?php echo $rol->getNombre(); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Actualizar</button>
</form>