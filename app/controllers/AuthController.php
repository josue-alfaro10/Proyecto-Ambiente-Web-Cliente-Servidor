<?php
session_start();

require_once __DIR__ . '/../models/Usuario.php';

$usuarioModelo = new Usuario();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? 'login';

switch ($accion) {

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $usuario = $usuarioModelo->buscarPorEmail($email);

            if ($usuario && $usuarioModelo->verificarPassword($password, $usuario['password'])) {

                $_SESSION['usuario_id'] = $usuario['id_usuario'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                $_SESSION['usuario_rol'] = $usuario['rol'];

                header('Location: /mi_proyecto/app/controllers/UsuarioController.php?accion=dashboard');
                exit;
            }

            $_SESSION['error'] = 'Correo o contraseña incorrectos.';
            header('Location: /mi_proyecto/app/views/auth/login.php');
            exit;
        }

        header('Location: /mi_proyecto/app/views/auth/login.php');
        exit;

    case 'registro':
        $nombre = trim($_POST['nombre'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if ($nombre === '' || $email === '' || $password === '') {
            $_SESSION['error'] = 'Completá todos los campos obligatorios.';
            header('Location: /mi_proyecto/app/views/auth/register.php');
            exit;
        }

        if ($password !== $passwordConfirm) {
            $_SESSION['error'] = 'Las contraseñas no coinciden.';
            header('Location: /mi_proyecto/app/views/auth/register.php');
            exit;
        }

        if ($usuarioModelo->buscarPorEmail($email)) {
            $_SESSION['error'] = 'Ya existe una cuenta registrada con ese correo.';
            header('Location: /mi_proyecto/app/views/auth/register.php');
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $idUsuario = $usuarioModelo->registrar($nombre, $email, $telefono, $passwordHash);

        $_SESSION['usuario_id'] = $idUsuario;
        $_SESSION['usuario_nombre'] = $nombre;
        $_SESSION['usuario_rol'] = 'usuario';

        header('Location: /mi_proyecto/app/controllers/UsuarioController.php?accion=dashboard');
        exit;

    case 'recuperar':
        $email = trim($_POST['email'] ?? '');
        $usuario = $usuarioModelo->buscarPorEmail($email);

        // Alcance introductorio: no se envía correo real, solo se confirma
        // al usuario que, si el correo existe, recibirá instrucciones.
        $_SESSION['exito'] = 'Si el correo ingresado existe en el sistema, recibirás instrucciones para recuperar tu contraseña.';
        header('Location: /mi_proyecto/app/views/auth/login.php');
        exit;

    case 'logout':
        $_SESSION = [];
        session_destroy();
        header('Location: /mi_proyecto/app/views/auth/login.php');
        exit;

    default:
        header('Location: /mi_proyecto/app/views/auth/login.php');
        exit;
}
