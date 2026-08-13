<?php

require_once __DIR__ . '/../../config/database.php';

class Solicitud
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // Usa el procedimiento almacenado RegistrarSolicitud definido en pawfinder.sql
    public function crear($mensaje, $idUsuario, $idMascota)
    {
        $sql = "CALL RegistrarSolicitud(:mensaje, :id_usuario, :id_mascota)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':mensaje', $mensaje);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_mascota', $idMascota, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Solicitudes hechas por un usuario, con el nombre e imagen de la mascota
    public function obtenerPorUsuario($idUsuario)
    {
        $sql = "SELECT s.*, m.nombre AS mascota, m.imagen
                FROM solicitudes s
                INNER JOIN mascotas m ON s.id_mascota = m.id_mascota
                WHERE s.id_usuario = :id_usuario
                ORDER BY s.fecha DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Todas las solicitudes del sistema, con datos de mascota y solicitante (para el admin)
    public function obtenerTodas()
    {
        $sql = "SELECT s.*, m.nombre AS mascota, m.imagen, u.nombre AS solicitante
                FROM solicitudes s
                INNER JOIN mascotas m ON s.id_mascota = m.id_mascota
                INNER JOIN usuarios u ON s.id_usuario = u.id_usuario
                ORDER BY s.fecha DESC";

        $stmt = $this->conexion->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT * FROM solicitudes WHERE id_solicitud = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Usa el procedimiento almacenado AprobarSolicitud: aprueba la solicitud
    // y automáticamente marca la mascota como "Adoptada"
    public function aprobar($id)
    {
        $sql = "CALL AprobarSolicitud(:id)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // No hay procedimiento para rechazar, así que se actualiza directamente
    public function rechazar($id)
    {
        $sql = "UPDATE solicitudes SET estado = 'Rechazada' WHERE id_solicitud = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function contarPorUsuario($idUsuario)
    {
        $sql = "SELECT COUNT(*) AS total FROM solicitudes WHERE id_usuario = :id_usuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function contarTodas()
    {
        $stmt = $this->conexion->query("SELECT COUNT(*) AS total FROM solicitudes");
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function contarPendientes()
    {
        $stmt = $this->conexion->query("SELECT COUNT(*) AS total FROM solicitudes WHERE estado = 'Pendiente'");
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
