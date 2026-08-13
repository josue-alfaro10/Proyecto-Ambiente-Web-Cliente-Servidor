<?php
session_start();

// Punto de entrada: si ya hay sesión, va al dashboard; si no, al login.
if (!empty($_SESSION['usuario_id'])) {
    header('Location: /mi_proyecto/app/controllers/UsuarioController.php?accion=dashboard');
} else {
    header('Location: /mi_proyecto/app/views/auth/login.php');
}
exit;
