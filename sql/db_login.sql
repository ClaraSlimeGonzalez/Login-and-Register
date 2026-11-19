-- =====================================================
-- Proyecto Login / Registro - Base de datos
-- Importar desde phpMyAdmin: Importar > Seleccionar archivo
-- =====================================================

CREATE DATABASE IF NOT EXISTS `db_login`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `db_login`;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id`        INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre`    VARCHAR(50)  NOT NULL,
  `apellido`  VARCHAR(50)  NOT NULL,
  `correo`    VARCHAR(100) NOT NULL,
  `password`  VARCHAR(255) NOT NULL, -- contraseña encriptada con password_hash()
  `creado_en` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_correo` (`correo`)
) ENGINE=InnoDB;
