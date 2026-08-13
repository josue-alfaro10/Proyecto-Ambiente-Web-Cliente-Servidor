<?php

require_once __DIR__ . '/../../config/database.php';

class Usuario
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }

    // Busca un usuario por su correo (se usa para login y validar duplicados)
    public function buscarPorEmail($email)
    {
        $sql = "SELECT u.*, r.nombre AS rol
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol
                WHERE u.email = :email";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Busca un usuario por su id (se usa para el perfil y el dashboard)
    public function buscarPorId($id)
    {
        $sql = "SELECT u.*, r.nombre AS rol
                FROM usuarios u
                INNER JOIN roles r ON u.id_rol = r.id_rol
                WHERE u.id_usuario = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Registra un usuario nuevo con rol "usuario" (id_rol = 2 según el seed de la BD)
    public function registrar($nombre, $email, $telefono, $passwordHash)
    {
        $sql = "INSERT INTO usuarios (nombre, email, telefono, password, id_rol)
                VALUES (:nombre, :email, :telefono, :password, 2)";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->execute();

        return $this->conexion->lastInsertId();
    }

    // Actualiza los datos básicos del perfil (nombre, email, teléfono)
    public function actualizarDatos($id, $nombre, $email, $telefono)
    {
        $sql = "UPDATE usuarios
                SET nombre = :nombre, email = :email, telefono = :telefono
                WHERE id_usuario = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Actualiza únicamente la contraseña (ya debe venir hasheada)
    public function actualizarPassword($id, $passwordHash)
    {
        $sql = "UPDATE usuarios SET password = :password WHERE id_usuario = :id";

        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Verifica la contraseña ingresada contra el hash guardado.
    // Compatibilidad: los usuarios de prueba del seed.sql tienen la
    // contraseña en texto plano ("123456"), así que si password_verify
    // falla, se compara también en texto plano.
    public function verificarPassword($passwordIngresada, $passwordGuardada)
    {
        if (password_verify($passwordIngresada, $passwordGuardada)) {
            return true;
        }

        return $passwordIngresada === $passwordGuardada;
    }
    // Genera un token de recuperación y lo guarda con expiración de 1 hora
    public function crearTokenRecuperacion($email)
    {
        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $stmt = $this->conexion->prepare("DELETE FROM password_resets WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (:email, :token, :expira)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':expira', $expira);
        $stmt->execute();

        return $token;
    }

    // Valida que el token exista y no haya expirado
    public function validarTokenRecuperacion($token)
    {
        $sql = "SELECT * FROM password_resets WHERE token = :token AND expires_at > NOW()";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Borra el token una vez usado
    public function borrarTokenRecuperacion($token)
    {
        $stmt = $this->conexion->prepare("DELETE FROM password_resets WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    }

    // Actualiza la contraseña usando el email (no tenemos sesión activa en este flujo)
    public function actualizarPasswordPorEmail($email, $passwordHash)
    {
        $sql = "UPDATE usuarios SET password = :password WHERE email = :email";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }
}
