<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Proyecto php grupo3'; ?></title>
    <link rel="stylesheet" href="/DollarToyProyectoG3/public/assets/css/style.css">
    <link rel="stylesheet" href="<?= $ruta ?>/css/bootstrap/css/bootstrap.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            min-width: 20%;
            background-color: #f8f9fa;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>    
    

        <main id="content" class="flex-grow-1 p-4"> <!-- Asegúrate de que main sea flexible -->
            <?php
            if (isset($content) && file_exists($content)) {
                include $content;
            } else {
                echo '<p>Contenido no disponible.</p>';
            }
            ?>
        </main>
    </div>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
    <script src="/DollarToyProyectoG3/public/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/contenido-jquery.js"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/crudcategorias-jquery.js"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/crudsedes.js"></script>
    
</body>

</html>