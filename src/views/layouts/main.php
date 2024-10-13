<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Proyecto php grupo3'; ?></title>
    <link rel="stylesheet" href="/DollarToyProyectoG3/public/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <main id="content"><!-- id content usado para insertar el content con jquery -->
        <?php
        if (isset($content) && file_exists($content)) {
            include $content;
        } else {
            echo '<p>Contenido no disponible.</p>';
        }
        ?>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
    <script src="/DollarToyProyectoG3/public/assets/js/contenido-jquery.js"></script>
</body>

</html>