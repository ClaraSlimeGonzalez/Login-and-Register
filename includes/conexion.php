<?php
/**
 * Conexión a la base de datos MySQL (XAMPP)
 * PHP 8 - PDO con consultas preparadas
 */
declare(strict_types=1);

const DB_HOST = 'localhost';
const DB_NAME = 'db_login';
const DB_USER = 'root';
const DB_PASS = 'admin.123$'; // contraseña de root del MySQL

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit(
        '<strong>Error al conectar con la base de datos.</strong><br>' .
        'Verificá que XAMPP (Apache y MySQL) esté encendido y que hayas importado ' .
        '<code>sql/db_login.sql</code> en phpMyAdmin.<br>Detalle: ' .
        $e->getMessage()
    );
}
