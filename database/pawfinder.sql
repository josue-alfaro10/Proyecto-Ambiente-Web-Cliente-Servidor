-- =====================================================
-- PAWFINDER
-- Base de datos del sistema de adopción de mascotas
-- =====================================================

-- =====================================================
-- 1. ELIMINAR Y CREAR LA BASE DE DATOS
-- Esta sección elimina la base de datos si existe,
-- crea una nueva y la selecciona para trabajar.
-- =====================================================

DROP DATABASE IF EXISTS pawfinder;
CREATE DATABASE pawfinder;
USE pawfinder;


-- =====================================================
-- 2. CREACIÓN DE TABLAS
-- Se crean todas las tablas necesarias del sistema.
-- =====================================================

-- Tabla de roles de usuario
CREATE TABLE roles (

    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL

);

-- Tabla de usuarios registrados
CREATE TABLE usuarios (

    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    id_rol INT NOT NULL,
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_rol)
    REFERENCES roles(id_rol)

);

-- Tabla de mascotas publicadas
CREATE TABLE mascotas (

    id_mascota INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(80) NOT NULL,
    especie VARCHAR(30) NOT NULL,
    raza VARCHAR(60),
    edad VARCHAR(30),
    sexo VARCHAR(20),
    tamano VARCHAR(20),
    ubicacion VARCHAR(60),
    descripcion TEXT,
    imagen VARCHAR(255),
    estado VARCHAR(20) DEFAULT 'Disponible',
    id_usuario INT NOT NULL,
    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuario)
    REFERENCES usuarios(id_usuario)

);

-- Tabla de solicitudes de adopción
CREATE TABLE solicitudes (

    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    mensaje TEXT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(20) DEFAULT 'Pendiente',
    id_usuario INT NOT NULL,
    id_mascota INT NOT NULL,

    FOREIGN KEY (id_usuario)
    REFERENCES usuarios(id_usuario),

    FOREIGN KEY (id_mascota)
    REFERENCES mascotas(id_mascota)

);


-- =====================================================
-- 3. INSERCIÓN DE DATOS DE PRUEBA
-- Se agregan registros para probar el funcionamiento.
-- =====================================================

-- Roles del sistema
INSERT INTO roles(nombre)
VALUES
('admin'),
('usuario');


-- Usuarios de prueba
INSERT INTO usuarios
(nombre,email,telefono,password,id_rol)
VALUES

('Administrador',
'admin@pawfinder.com',
'88888888',
'123456',
1),

('Kevin',
'kevin@gmail.com',
'88881111',
'123456',
2),

('Maria',
'maria@gmail.com',
'88882222',
'123456',
2);


-- Mascotas de prueba
INSERT INTO mascotas
(nombre,especie,raza,edad,sexo,tamano,ubicacion,descripcion,imagen,estado,id_usuario)
VALUES

('Max',
'Perro',
'Labrador',
'2 años',
'Macho',
'Grande',
'Heredia',
'Muy juguetón',
'/mi_proyecto/public/img/placeholder-mascota.jpg',
'Disponible',
2),

('Luna',
'Gato',
'Siamés',
'1 año',
'Hembra',
'Pequeño',
'Alajuela',
'Muy tranquila',
'/mi_proyecto/public/img/placeholder-mascota.jpg',
'Disponible',
3),

('Rocky',
'Perro',
'Pastor Alemán',
'3 años',
'Macho',
'Grande',
'San José',
'Protector',
'/mi_proyecto/public/img/placeholder-mascota.jpg',
'Adoptada',
2);


-- Solicitudes de adopción de prueba
INSERT INTO solicitudes
(mensaje,estado,id_usuario,id_mascota)
VALUES

('Quiero adoptar a Max porque tengo experiencia con perros.',
'Pendiente',
3,
1),

('Tengo una casa grande para Luna.',
'Aprobada',
2,
2),

('Siempre quise un pastor alemán.',
'Rechazada',
3,
3);


-- =====================================================
-- 4. CREACIÓN DE ÍNDICES
-- Los índices permiten mejorar el rendimiento de las
-- consultas más utilizadas.
-- =====================================================

USE pawfinder;

CREATE INDEX idx_usuario_email
ON usuarios(email);

CREATE INDEX idx_mascota_estado
ON mascotas(estado);

CREATE INDEX idx_mascota_especie
ON mascotas(especie);

CREATE INDEX idx_solicitud_estado
ON solicitudes(estado);

CREATE INDEX idx_solicitud_fecha
ON solicitudes(fecha);


-- Mostrar índices creados
SHOW INDEX FROM usuarios;
SHOW INDEX FROM mascotas;
SHOW INDEX FROM solicitudes;


-- =====================================================
-- 5. PROCEDIMIENTO: REGISTRAR MASCOTA
-- Inserta una nueva mascota en el sistema.
-- =====================================================

DELIMITER $$

CREATE PROCEDURE RegistrarMascota(

IN p_nombre VARCHAR(80),
IN p_especie VARCHAR(30),
IN p_raza VARCHAR(60),
IN p_edad VARCHAR(30),
IN p_sexo VARCHAR(20),
IN p_tamano VARCHAR(20),
IN p_ubicacion VARCHAR(60),
IN p_descripcion TEXT,
IN p_imagen VARCHAR(255),
IN p_id_usuario INT

)

BEGIN

INSERT INTO mascotas(

nombre,
especie,
raza,
edad,
sexo,
tamano,
ubicacion,
descripcion,
imagen,
id_usuario

)

VALUES(

p_nombre,
p_especie,
p_raza,
p_edad,
p_sexo,
p_tamano,
p_ubicacion,
p_descripcion,
p_imagen,
p_id_usuario

);

END$$

DELIMITER ;


-- Prueba del procedimiento
CALL RegistrarMascota(

'Firulais',
'Perro',
'Criollo',
'4 años',
'Macho',
'Mediano',
'Cartago',
'Muy amigable',
'/img/firulais.jpg',
2

);

SELECT * FROM mascotas;


-- =====================================================
-- 6. PROCEDIMIENTO: CAMBIAR ESTADO DE UNA MASCOTA
-- Actualiza el estado de una mascota.
-- =====================================================

DELIMITER $$

CREATE PROCEDURE CambiarEstadoMascota(

IN p_id_mascota INT,
IN p_estado VARCHAR(20)

)

BEGIN

UPDATE mascotas
SET estado = p_estado
WHERE id_mascota = p_id_mascota;

END$$

DELIMITER ;


-- Prueba del procedimiento
CALL CambiarEstadoMascota(

1,
'Adoptada'

);

SELECT * FROM mascotas;


-- =====================================================
-- 7. PROCEDIMIENTO: REGISTRAR SOLICITUD
-- Guarda una nueva solicitud de adopción.
-- =====================================================

DELIMITER $$

CREATE PROCEDURE RegistrarSolicitud(

IN p_mensaje TEXT,
IN p_id_usuario INT,
IN p_id_mascota INT

)

BEGIN

INSERT INTO solicitudes(

mensaje,
id_usuario,
id_mascota

)

VALUES(

p_mensaje,
p_id_usuario,
p_id_mascota

);

END$$

DELIMITER ;


-- Prueba del procedimiento
CALL RegistrarSolicitud(

'Deseo adoptar a Firulais.',
3,
4

);

SELECT * FROM solicitudes;


-- =====================================================
-- 8. PROCEDIMIENTO: APROBAR SOLICITUD
-- Cambia el estado de la solicitud y marca
-- automáticamente la mascota como adoptada.
-- =====================================================

DELIMITER $$

CREATE PROCEDURE AprobarSolicitud(

IN p_id_solicitud INT

)

BEGIN

DECLARE v_id_mascota INT;

UPDATE solicitudes
SET estado = 'Aprobada'
WHERE id_solicitud = p_id_solicitud;

SELECT id_mascota
INTO v_id_mascota
FROM solicitudes
WHERE id_solicitud = p_id_solicitud;

UPDATE mascotas
SET estado = 'Adoptada'
WHERE id_mascota = v_id_mascota;

END$$

DELIMITER ;


-- Prueba del procedimiento
CALL AprobarSolicitud(4);

SELECT * FROM solicitudes;
SELECT * FROM mascotas;


-- =====================================================
-- 9. CONSULTAS
-- Consulta que muestra las solicitudes con el nombre
-- del solicitante y la mascota.
-- =====================================================

SELECT

m.nombre AS mascota,
u.nombre AS solicitante,
s.estado,
s.fecha

FROM solicitudes s

INNER JOIN mascotas m
ON s.id_mascota = m.id_mascota

INNER JOIN usuarios u
ON s.id_usuario = u.id_usuario;


-- =====================================================
-- 10. VISTA DE MASCOTAS
-- Vista para consultar mascotas con el nombre
-- del propietario.
-- =====================================================

CREATE VIEW vista_mascotas AS

SELECT

m.id_mascota,
m.nombre,
m.especie,
m.raza,
m.edad,
m.sexo,
m.tamano,
m.ubicacion,
m.estado,
u.nombre AS propietario

FROM mascotas m

INNER JOIN usuarios u
ON m.id_usuario = u.id_usuario;

SELECT * FROM vista_mascotas;


-- =====================================================
-- 11. VISTA DE SOLICITUDES
-- Vista para consultar solicitudes junto con el
-- solicitante y la mascota correspondiente.
-- =====================================================

CREATE VIEW vista_solicitudes AS

SELECT

s.id_solicitud,
u.nombre AS solicitante,
m.nombre AS mascota,
s.estado,
s.fecha

FROM solicitudes s

INNER JOIN usuarios u
ON s.id_usuario = u.id_usuario

INNER JOIN mascotas m
ON s.id_mascota = m.id_mascota;

SELECT * FROM vista_solicitudes;

CREATE TABLE password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL,
    token VARCHAR(64) NOT NULL,
    expires_at DATETIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);