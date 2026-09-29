CREATE DATABASE IF NOT EXISTS tickets_db;
USE tickets_db;

CREATE TABLE IF NOT EXISTS ticket (
    id          INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo      VARCHAR(150) NOT NULL,
    descripcion TEXT         NOT NULL,
    estado      VARCHAR(20)  NOT NULL DEFAULT 'pendiente'
);

INSERT INTO ticket (titulo, descripcion, estado) VALUES
('Error al iniciar sesión', 'El usuario no puede ingresar con su clave.', 'pendiente'),
('Impresora sin conexión', 'La impresora del piso 2 no responde.', 'pendiente');
