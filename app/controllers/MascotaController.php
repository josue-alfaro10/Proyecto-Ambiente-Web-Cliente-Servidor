<?php

require_once __DIR__ . '/../helpers/sesion.php';
require_once __DIR__ . '/../models/Mascota.php';

requerirSesion();

$mascotaModelo = new Mascota();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? 'catalogo';

// Sube la imagen de la mascota (si el usuario adjuntó una) y devuelve
// la ruta pública para guardarla en la base de datos. Si no adjuntó
// nada, devuelve cadena vacía.
function subirImagenMascota()
{
    if (empty($_FILES['imagen']['name']) || $_FILES['imagen']['error'] !== UPLOAD_ERR_OK) {
        return '';
    }

    $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $extensionesPermitidas)) {
        return '';
    }

    $nombreArchivo = uniqid('mascota_') . '.' . $extension;
    $rutaDestino = __DIR__ . '/../../public/uploads/mascotas/' . $nombreArchivo;

    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
        return '/mi_proyecto/public/uploads/mascotas/' . $nombreArchivo;
    }

    return '';
}

switch ($accion) {

    case 'catalogo':
        $filtroEspecie = $_GET['especie'] ?? '';
        $filtroTamano = $_GET['tamano'] ?? '';
        $filtroLugar = $_GET['ubicacion'] ?? '';

        $mascotas = $mascotaModelo->obtenerTodas($filtroEspecie, $filtroTamano, $filtroLugar);

        require __DIR__ . '/../views/mascotas/catalogo.php';
        break;

    case 'detalle':
        $id = (int)($_GET['id'] ?? 0);
        $mascota = $mascotaModelo->obtenerPorId($id);

        if (!$mascota) {
            header('Location: /mi_proyecto/app/controllers/MascotaController.php?accion=catalogo');
            exit;
        }

        require __DIR__ . '/../views/mascotas/detalle.php';
        break;

    case 'agregar':
        require __DIR__ . '/../views/mascotas/agregar.php';
        break;

    case 'crear':
        $rutaImagen = subirImagenMascota();

        $datos = [
            'nombre' => trim($_POST['nombre'] ?? ''),
            'especie' => $_POST['especie'] ?? '',
            'raza' => trim($_POST['raza'] ?? ''),
            'edad' => trim($_POST['edad'] ?? ''),
            'sexo' => $_POST['sexo'] ?? '',
            'tamano' => $_POST['tamano'] ?? '',
            'ubicacion' => $_POST['ubicacion'] ?? '',
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'imagen' => $rutaImagen ?: '/mi_proyecto/public/img/placeholder-mascota.jpg',
            'id_usuario' => $_SESSION['usuario_id'],
        ];

        $mascotaModelo->crear($datos);

        $_SESSION['exito'] = 'Mascota publicada correctamente.';
        header('Location: /mi_proyecto/app/controllers/MascotaController.php?accion=administrar');
        exit;

    case 'administrar':
        requerirAdmin();

        $mascotas = $mascotaModelo->obtenerTodas();

        require __DIR__ . '/../views/mascotas/administrar.php';
        break;

    case 'editar':
        requerirAdmin();
        $id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rutaImagen = subirImagenMascota();

            $datos = [
                'nombre' => trim($_POST['nombre'] ?? ''),
                'especie' => $_POST['especie'] ?? '',
                'raza' => trim($_POST['raza'] ?? ''),
                'edad' => trim($_POST['edad'] ?? ''),
                'sexo' => $_POST['sexo'] ?? '',
                'tamano' => $_POST['tamano'] ?? '',
                'ubicacion' => $_POST['ubicacion'] ?? '',
                'descripcion' => trim($_POST['descripcion'] ?? ''),
                'imagen' => $rutaImagen,
            ];

            $mascotaModelo->actualizar($id, $datos);

            $_SESSION['exito'] = 'Mascota actualizada correctamente.';
            header('Location: /mi_proyecto/app/controllers/MascotaController.php?accion=administrar');
            exit;
        }

        $mascota = $mascotaModelo->obtenerPorId($id);

        if (!$mascota) {
            header('Location: /mi_proyecto/app/controllers/MascotaController.php?accion=administrar');
            exit;
        }

        require __DIR__ . '/../views/mascotas/editar.php';
        break;

    case 'eliminar':
        requerirAdmin();
        $id = (int)($_GET['id'] ?? 0);
        $mascotaModelo->eliminar($id);

        $_SESSION['exito'] = 'Mascota eliminada correctamente.';
        header('Location: /mi_proyecto/app/controllers/MascotaController.php?accion=administrar');
        exit;

    default:
        header('Location: /mi_proyecto/app/controllers/MascotaController.php?accion=catalogo');
        exit;
}
