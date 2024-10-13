<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Mi Aplicación'; ?></title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include __DIR__ . '/../partials/header.php'; ?>

    <main>
        <?php
        if (isset($content) && file_exists($content)) {
            include $content;
        } else {
            echo '<p>Contenido no disponible.</p>';
        }
        ?>
    </main>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
</body>

</html>