<?php

class Database
{
    private $host = "localhost";
    private $dbname = "pawfinder";
    private $usuario = "root";
    private $password = "";
    private $conexion;

    public function conectar()
    {
        $this->conexion = null;

        try {

            $this->conexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->dbname,
                $this->usuario,
                $this->password
            );

            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo "Error de conexión: " . $e->getMessage();

        }

        return $this->conexion;
    }
}