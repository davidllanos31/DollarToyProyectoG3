<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Proyecto php grupo3'; ?></title>
    <link rel="stylesheet" href="/DollarToyProyectoG3/public/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/contenido-jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="/DollarToyProyectoG3/public/assets/js/crudcategorias-jquery.js"></script>
</body>

</html>