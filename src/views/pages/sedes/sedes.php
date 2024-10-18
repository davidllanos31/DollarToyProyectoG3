<input type="text" id="buscar-sedes" placeholder="Buscar Sedes...">

<table id="sedesTable" border="1" clas="table table-striped">
    <thead> 
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Ciudad</th>
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
                    <a href="<?= BASE_URI; ?>/sedes/editar/<?php echo $sede->getId(); ?>">Editar</a>
                    <a href="<?= BASE_URI; ?>/sedes/eliminar/<?php echo $sede->getId(); ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>