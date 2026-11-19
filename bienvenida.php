<?php
/**
 * PANEL DE BIENVENIDA
 * Página protegida: solo se ve con sesión activa
 */
require_once __DIR__ . '/includes/auth.php';

exigirSesion(); // si no hay sesión, vuelve al login
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bienvenido</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

  <main class="contenedor">
    <section class="tarjeta">
      <h1 class="titulo">¡Hola, <?= htmlspecialchars($_SESSION['nombre']) ?>!</h1>
      <p class="subtitulo">Has iniciado sesión correctamente</p>

      <ul class="panel-datos">
        <li>
          <span>Nombre</span>
          <span><?= htmlspecialchars($_SESSION['nombre']) ?></span>
        </li>
        <li>
          <span>Apellido</span>
          <span><?= htmlspecialchars($_SESSION['apellido']) ?></span>
        </li>
        <li>
          <span>Correo</span>
          <span><?= htmlspecialchars($_SESSION['correo']) ?></span>
        </li>
        <li>
          <span>ID de usuario</span>
          <span><?= (int) $_SESSION['usuario_id'] ?></span>
        </li>
      </ul>

      <a href="logout.php" class="btn-salir">Cerrar sesión</a>
    </section>
  </main>

</body>
</html>
