<h1><?php echo $title; ?></h1>
<form action="/roles/store" method="POST">
    <label for="nombre">Nombre del Rol</label>
    <input type="text" name="nombre" id="nombre" required>
    
    <button type="submit">Guardar</button>
</form>
