<?php

require_once __DIR__ . '/../helpers/sesion.php';
require_once __DIR__ . '/../models/Solicitud.php';

requerirSesion();

$solicitudModelo = new Solicitud();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? 'mis_solicitudes';

switch ($accion) {

    case 'crear':
        $mensaje = trim($_POST['mensaje'] ?? '');
        $idMascota = (int)($_POST['id_mascota'] ?? 0);

        if ($mensaje === '' || $idMascota === 0) {
            $_SESSION['error'] = 'Escribí un mensaje antes de enviar la solicitud.';
            header('Location: /mi_proyecto/app/controllers/MascotaController.php?accion=detalle&id=' . $idMascota);
            exit;
        }

        $solicitudModelo->crear($mensaje, $_SESSION['usuario_id'], $idMascota);

        $_SESSION['exito'] = 'Tu solicitud de adopción fue enviada.';
        header('Location: /mi_proyecto/app/controllers/SolicitudController.php?accion=mis_solicitudes');
        exit;

    case 'mis_solicitudes':
        $solicitudes = $solicitudModelo->obtenerPorUsuario($_SESSION['usuario_id']);
        require __DIR__ . '/../views/solicitudes/mis_solicitudes.php';
        break;

    case 'administrar':
        requerirAdmin();
        $solicitudes = $solicitudModelo->obtenerTodas();
        require __DIR__ . '/../views/solicitudes/administrar.php';
        break;

    case 'aprobar':
        requerirAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $solicitudModelo->aprobar($id);

        $_SESSION['exito'] = 'Solicitud aprobada. La mascota fue marcada como adoptada.';
        header('Location: /mi_proyecto/app/controllers/SolicitudController.php?accion=administrar');
        exit;

    case 'rechazar':
        requerirAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $solicitudModelo->rechazar($id);

        $_SESSION['exito'] = 'Solicitud rechazada.';
        header('Location: /mi_proyecto/app/controllers/SolicitudController.php?accion=administrar');
        exit;

    default:
        header('Location: /mi_proyecto/app/controllers/SolicitudController.php?accion=mis_solicitudes');
        exit;
}
