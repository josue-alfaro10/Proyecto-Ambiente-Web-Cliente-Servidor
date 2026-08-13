<?php
// Funciones pequeñas para no repetir la validación de sesión en cada controlador

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Corta la ejecución y manda al login si no hay sesión iniciada
function requerirSesion()
{
    if (empty($_SESSION['usuario_id'])) {
        header('Location: /mi_proyecto/app/views/auth/login.php');
        exit;
    }
}

// Corta la ejecución y manda al dashboard si el usuario no es admin
function requerirAdmin()
{
    requerirSesion();

    if (($_SESSION['usuario_rol'] ?? '') !== 'admin') {
        header('Location: /mi_proyecto/app/controllers/UsuarioController.php?accion=dashboard');
        exit;
    }
}
