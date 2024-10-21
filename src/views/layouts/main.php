<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Proyecto php grupo3'; ?></title>
    <link rel="stylesheet" href="<?= BASE_URI; ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= BASE_URI; ?>/public/assets/css/bootstrap/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <?php include __DIR__ . '/../partials/navbar.php'; ?>


        <main id="content" class="flex-grow-1 p-4">
            <?php
            if (isset($content)) {
                include $content;
            } else {
                echo '<p>Contenido no disponible.</p>';
            }
            ?>
        </main>
    </div>

    <?php //include __DIR__ . '/../partials/footer.php'; 
    ?>
    <script src="<?= BASE_URI; ?>/public/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?= BASE_URI; ?>/public/assets/js/crudcategorias-jquery.js"></script> -->
    <script src="<?= BASE_URI; ?>/public/assets/js/crudVentas.js"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/contenido-jquery.js"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/crudcategorias-jquery.js"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/crudsedes.js"></script>
    <script src="<?= BASE_URI; ?>/public/assets/js/crudproductos-jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>