<?php
/**
 * PROCESA EL ALTA DE USUARIO
 * Valida los datos y los guarda en la base de datos
 */
declare(strict_types=1);

require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/auth.php';

// Solo se puede llegar por el formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('registro.php');
}

$nombre     = trim($_POST['nombre'] ?? '');
$apellido   = trim($_POST['apellido'] ?? '');
$correo     = trim($_POST['correo'] ?? '');
$password   = $_POST['password'] ?? '';
$confirmar  = $_POST['confirmar_password'] ?? '';

// 1) Campos vacíos (lo verifican HTML y JavaScript, y también el servidor)
if ($nombre === '' || $apellido === '' || $correo === '' || $password === '' || $confirmar === '') {
    redirigir('registro.php?error=campos');
}

// 2) Formato de correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    redirigir('registro.php?error=correo');
}

// 3) Contraseña mínima de 8 caracteres
if (strlen($password) < 8) {
    redirigir('registro.php?error=corta');
}

// 4) Que las contraseñas coincidan
if ($password !== $confirmar) {
    redirigir('registro.php?error=coinciden');
}

// 5) Que el correo no esté ya registrado
$existe = $pdo->prepare('SELECT id FROM usuarios WHERE correo = :correo LIMIT 1');
$existe->execute([':correo' => $correo]);
if ($existe->fetch()) {
    redirigir('registro.php?error=existente');
}

// 6) Guardamos la contraseña encriptada con password_hash()
try {
    $insertar = $pdo->prepare(
        'INSERT INTO usuarios (nombre, apellido, correo, password)
         VALUES (:nombre, :apellido, :correo, :password)'
    );
    $insertar->execute([
        ':nombre'    => $nombre,
        ':apellido'  => $apellido,
        ':correo'    => $correo,
        ':password'  => password_hash($password, PASSWORD_DEFAULT),
    ]);
} catch (PDOException $e) {
    // 1062 = correo duplicado
    if ($e->getCode() === '1062') {
        redirigir('registro.php?error=existente');
    }
    redirigir('registro.php?error=guardar');
}

redirigir('registro.php?ok=1');
