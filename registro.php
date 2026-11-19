<?php
/**
 * ALTA DE NUEVO USUARIO
 * Formulario: nombre, apellido, correo, contraseña y confirmación
 */
require_once __DIR__ . '/includes/auth.php';

// Si ya inició sesión, lo mandamos al panel
if (haySesionIniciada()) {
    redirigir('bienvenida.php');
}

$errores = [
    'campos'     => 'Completá todos los campos.',
    'correo'     => 'Ingresá un correo electrónico válido.',
    'corta'      => 'La contraseña debe tener mínimo 8 caracteres.',
    'coinciden'  => 'Las contraseñas no coinciden.',
    'existente'  => 'Ese correo ya está registrado. Iniciá sesión.',
    'guardar'    => 'No se pudo guardar el usuario. Probá de nuevo.',
];

$error = $_GET['error'] ?? '';
$exito = $_GET['ok'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear cuenta</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

  <main class="contenedor">
    <section class="tarjeta">
      <h1 class="titulo">Crear cuenta</h1>
      <p class="subtitulo">Completá el formulario para registrarte</p>

      <?php if ($exito === '1'): ?>
        <div class="alerta alerta-exito">Usuario creado correctamente. Ya podés iniciar sesión.</div>
      <?php endif; ?>

      <?php if (isset($errores[$error])): ?>
        <div class="alerta alerta-error"><?= htmlspecialchars($errores[$error]) ?></div>
      <?php endif; ?>

      <!-- Formulario de registro: validado por HTML, JavaScript y PHP -->
      <form id="formRegistro" action="guardar_usuario.php" method="POST" autocomplete="off">
        <div class="campo">
          <label for="nombre">Nombre</label>
          <input
            type="text"
            id="nombre"
            name="nombre"
            placeholder="Nombre"
            data-error-vacio="El nombre es obligatorio"
            maxlength="50"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <div class="campo">
          <label for="apellido">Apellido</label>
          <input
            type="text"
            id="apellido"
            name="apellido"
            placeholder="Apellido"
            data-error-vacio="El apellido es obligatorio"
            maxlength="50"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <div class="campo">
          <label for="correo">Correo electrónico</label>
          <input
            type="email"
            id="correo"
            name="correo"
            placeholder="Correo @gmail.com"
            data-error-vacio="Email @gmail.com obligatorio"
            maxlength="100"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <div class="campo">
          <label for="password">Contraseña</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Contraseña (mín 8)"
            data-error-vacio="La contraseña es obligatoria (mín 8)"
            minlength="8"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <div class="campo">
          <label for="confirmar_password">Confirmar contraseña</label>
          <input
            type="password"
            id="confirmar_password"
            name="confirmar_password"
            placeholder="Repetí la contraseña"
            data-error-vacio="Confirmá la contraseña"
            minlength="8"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <button type="submit" class="btn-principal">Registrarme</button>
      </form>

      <div class="opciones">
        <p><a href="index.php">¿Ya tenés cuenta? Iniciar sesión</a></p>
      </div>
    </section>
  </main>

  <script src="js/validaciones.js"></script>
</body>
</html>
