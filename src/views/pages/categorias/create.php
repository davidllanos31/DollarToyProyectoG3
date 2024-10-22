<h1><?php echo $title; ?></h1>
<form id="categoriaForm" action="<?= BASE_URI; ?>/usuarios/store" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion" id="descripcion" required>
    
    <button type="submit">Guardar</button>
</form>