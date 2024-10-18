<h1><?php echo $title; ?></h1>
<form action="/roles/update/<?php echo $rol->getId(); ?>" method="POST">
    <label for="nombre">Nombre del Rol</label>
    <input type="text" name="nombre" id="nombre" value="<?php echo $rol->getNombre(); ?>" required>
    
    <button type="submit">Actualizar</button>
</form>
