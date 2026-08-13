<?php

require_once __DIR__ . '/../helpers/sesion.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Mascota.php';
require_once __DIR__ . '/../models/Solicitud.php';

requerirSesion();

$usuarioModelo = new Usuario();
$mascotaModelo = new Mascota();
$solicitudModelo = new Solicitud();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? 'dashboard';

switch ($accion) {

    case 'dashboard':

        if ($_SESSION['usuario_rol'] === 'admin') {
            $totalMascotas = $mascotaModelo->contarTodas();
            $totalSolicitudes = $solicitudModelo->contarTodas();
        } else {
            $totalMascotas = count($mascotaModelo->obtenerPorUsuario($_SESSION['usuario_id']));
            $totalSolicitudes = $solicitudModelo->contarPorUsuario($_SESSION['usuario_id']);
        }

        $solicitudesPendientes = $solicitudModelo->contarPendientes();
        $mascotasRecientes = $mascotaModelo->obtenerRecientes(4);

        require __DIR__ . '/../views/usuarios/dashboard.php';
        break;

    case 'perfil':
        $usuario = $usuarioModelo->buscarPorId($_SESSION['usuario_id']);
        require __DIR__ . '/../views/usuarios/perfil.php';
        break;

    case 'actualizar_perfil':
        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $passwordActual = $_POST['password_actual'] ?? '';
        $passwordNueva = $_POST['password_nueva'] ?? '';

        $usuarioModelo->actualizarDatos($_SESSION['usuario_id'], $nombre, $email, $telefono);
        $_SESSION['usuario_nombre'] = $nombre;

        // El cambio de contraseña es opcional
        if ($passwordNueva !== '') {
            $usuarioActual = $usuarioModelo->buscarPorId($_SESSION['usuario_id']);

            if ($usuarioModelo->verificarPassword($passwordActual, $usuarioActual['password'])) {
                $usuarioModelo->actualizarPassword($_SESSION['usuario_id'], password_hash($passwordNueva, PASSWORD_DEFAULT));
            } else {
                $_SESSION['error'] = 'La contraseña actual no es correcta, no se cambió la contraseña.';
                header('Location: /mi_proyecto/app/controllers/UsuarioController.php?accion=perfil');
                exit;
            }
        }

        $_SESSION['exito'] = 'Perfil actualizado correctamente.';
        header('Location: /mi_proyecto/app/controllers/UsuarioController.php?accion=perfil');
        exit;

    default:
        header('Location: /mi_proyecto/app/controllers/UsuarioController.php?accion=dashboard');
        exit;
}
