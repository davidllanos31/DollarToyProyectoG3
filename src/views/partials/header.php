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
    <?php include __DIR__ . '/navbar.php'; ?>   
    <main id="content" class="flex-grow-1 p-4">