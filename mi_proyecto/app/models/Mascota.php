<?php

require_once __DIR__ . '/../../config/database.php';

class Mascota
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // Devuelve el listado de mascotas para el catálogo, aplicando
    // filtros opcionales de especie, tamaño y ubicación.
    public function obtenerTodas($especie = '', $tamano = '', $ubicacion = '')
    {
        $sql = "SELECT *, id_mascota AS id FROM mascotas WHERE 1 = 1";
        $parametros = [];

        if (!empty($especie)) {
            $sql .= " AND especie = :especie";
            $parametros[':especie'] = $especie;
        }

        if (!empty($tamano)) {
            $sql .= " AND tamano = :tamano";
            $parametros[':tamano'] = $tamano;
        }

        if (!empty($ubicacion)) {
            $sql .= " AND ubicacion = :ubicacion";
            $parametros[':ubicacion'] = $ubicacion;
        }

        $sql .= " ORDER BY fecha_publicacion DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute($parametros);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Últimas mascotas publicadas (se usa en el dashboard)
    public function obtenerRecientes($limite = 4)
    {
        $sql = "SELECT *, id_mascota AS id FROM mascotas ORDER BY fecha_publicacion DESC LIMIT :limite";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id)
    {
        $sql = "SELECT *, id_mascota AS id FROM mascotas WHERE id_mascota = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mascotas publicadas por un usuario en particular
    public function obtenerPorUsuario($idUsuario)
    {
        $sql = "SELECT *, id_mascota AS id FROM mascotas WHERE id_usuario = :id_usuario ORDER BY fecha_publicacion DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id_usuario', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Usa el procedimiento almacenado RegistrarMascota definido en pawfinder.sql
    public function crear($datos)
    {
        $sql = "CALL RegistrarMascota(:nombre, :especie, :raza, :edad, :sexo, :tamano, :ubicacion, :descripcion, :imagen, :id_usuario)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':especie', $datos['especie']);
        $stmt->bindParam(':raza', $datos['raza']);
        $stmt->bindParam(':edad', $datos['edad']);
        $stmt->bindParam(':sexo', $datos['sexo']);
        $stmt->bindParam(':tamano', $datos['tamano']);
        $stmt->bindParam(':ubicacion', $datos['ubicacion']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);
        $stmt->bindParam(':imagen', $datos['imagen']);
        $stmt->bindParam(':id_usuario', $datos['id_usuario'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Edición completa de una mascota existente
    public function actualizar($id, $datos)
    {
        $sql = "UPDATE mascotas SET
                    nombre = :nombre,
                    especie = :especie,
                    raza = :raza,
                    edad = :edad,
                    sexo = :sexo,
                    tamano = :tamano,
                    ubicacion = :ubicacion,
                    descripcion = :descripcion";

        // La imagen solo se actualiza si el usuario subió una nueva
        if (!empty($datos['imagen'])) {
            $sql .= ", imagen = :imagen";
        }

        $sql .= " WHERE id_mascota = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $datos['nombre']);
        $stmt->bindParam(':especie', $datos['especie']);
        $stmt->bindParam(':raza', $datos['raza']);
        $stmt->bindParam(':edad', $datos['edad']);
        $stmt->bindParam(':sexo', $datos['sexo']);
        $stmt->bindParam(':tamano', $datos['tamano']);
        $stmt->bindParam(':ubicacion', $datos['ubicacion']);
        $stmt->bindParam(':descripcion', $datos['descripcion']);

        if (!empty($datos['imagen'])) {
            $stmt->bindParam(':imagen', $datos['imagen']);
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Usa el procedimiento almacenado CambiarEstadoMascota definido en pawfinder.sql
    public function cambiarEstado($id, $estado)
    {
        $sql = "CALL CambiarEstadoMascota(:id, :estado)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':estado', $estado);

        return $stmt->execute();
    }

    // Elimina una mascota. Primero se eliminan sus solicitudes asociadas
    // porque la tabla solicitudes tiene una llave foránea hacia mascotas.
    public function eliminar($id)
    {
        $sqlSolicitudes = "DELETE FROM solicitudes WHERE id_mascota = :id";
        $stmt1 = $this->conexion->prepare($sqlSolicitudes);
        $stmt1->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt1->execute();

        $sqlMascota = "DELETE FROM mascotas WHERE id_mascota = :id";
        $stmt2 = $this->conexion->prepare($sqlMascota);
        $stmt2->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt2->execute();
    }

    public function contarTodas()
    {
        $stmt = $this->conexion->query("SELECT COUNT(*) AS total FROM mascotas");
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}
