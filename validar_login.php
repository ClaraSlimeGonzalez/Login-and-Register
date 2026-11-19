<?php
/**
 * PROCESA EL LOGIN
 * Verifica el correo y la contraseña contra la base de datos
 */
declare(strict_types=1);

require_once __DIR__ . '/includes/conexion.php';
require_once __DIR__ . '/includes/auth.php';

// Solo se puede llegar por el formulario (POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirigir('index.php');
}

$correo   = trim($_POST['correo'] ?? '');
$password = $_POST['password'] ?? '';

// 1) Verificación de campos vacíos (también lo hacen HTML y JavaScript)
if ($correo === '' || $password === '') {
    redirigir('index.php?error=campos');
}

// 2) Formato de correo
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    redirigir('index.php?error=correo');
}

// 3) Buscamos el usuario en la base de datos (consulta preparada = seguro)
$consulta = $pdo->prepare(
    'SELECT id, nombre, apellido, correo, password
       FROM usuarios
      WHERE correo = :correo
      LIMIT 1'
);
$consulta->execute([':correo' => $correo]);
$usuario = $consulta->fetch();

// 4) Verificamos la contraseña con password_verify()
if (!$usuario || !password_verify($password, $usuario['password'])) {
    redirigir('index.php?error=credenciales');
}

// 5) Todo bien: creamos la sesión
session_regenerate_id(true); // por seguridad
$_SESSION['usuario_id'] = (int) $usuario['id'];
$_SESSION['nombre']     = $usuario['nombre'];
$_SESSION['apellido']   = $usuario['apellido'];
$_SESSION['correo']     = $usuario['correo'];

redirigir('bienvenida.php');
