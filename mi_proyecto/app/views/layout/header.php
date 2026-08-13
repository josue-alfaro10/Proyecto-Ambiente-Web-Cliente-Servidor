<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawFinder</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS del proyecto -->
    <?php $cssVersion = @filemtime(__DIR__ . '/../../../public/css/styles.css') ?: time(); ?>
    <link rel="stylesheet" href="/mi_proyecto/public/css/styles.css?v=<?= $cssVersion ?>">
</head>

<body>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger m-3" role="alert">
        <?= htmlspecialchars($_SESSION['error']) ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (!empty($_SESSION['exito'])): ?>
    <div class="alert alert-success m-3" role="alert">
        <?= htmlspecialchars($_SESSION['exito']) ?>
    </div>
    <?php unset($_SESSION['exito']); ?>
<?php endif; ?>