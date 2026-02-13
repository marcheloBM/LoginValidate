-- Crear la base de datos
CREATE DATABASE loginejemplo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE loginejemplo;

-- Tabla de usuarios
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL, -- aquí se guarda el hash con password_hash()
  telefono VARCHAR(20),
  avatar VARCHAR(255),
  status TINYINT DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de roles (opcional, si quieres manejar permisos)
CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(50) NOT NULL
);

-- Relación opcional entre usuarios y roles
ALTER TABLE usuarios
  ADD COLUMN rol_id INT NULL,
  ADD CONSTRAINT fk_usuario_rol FOREIGN KEY (rol_id) REFERENCES roles(id);