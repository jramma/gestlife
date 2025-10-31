<?php
// layout.php
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mi sitio PHP' ?></title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/prueba1.css">
    <link rel="stylesheet" href="styles/prueba2.css">
    <link rel="stylesheet" href="styles/prueba3.css">

</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <?= $content ?? '' ?>
    </main>
</body>

</html>