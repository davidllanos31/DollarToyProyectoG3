<h1><?php echo $title; ?></h1>
<form action="/usuarios/store" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" required>

    <label for="email">Correo Electrónico</label>
    <input type="email" name="email" id="email" required>

    <label for="celular">Celular</label>
    <input type="text" name="celular" id="celular" required>

    <label for="fecha_registro">Fecha de Registro</label>
    <input type="date" name="fecha_registro" id="fecha_registro" required>

    <label for="rol">Rol</label>
    <select name="rol" id="rol" required>
        <option value="">Seleccione un rol</option>

        <?php foreach ($roles as $rol): ?>
            <option value="<?php echo $rol->getId(); ?>"><?php echo $rol->getNombre(); ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Guardar</button>
</form>