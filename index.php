<?php
/**
 * INICIO DE SESIÓN
 * Formulario con 2 campos obligatorios: correo y contraseña
 */
require_once __DIR__ . '/includes/auth.php';

// Si ya inició sesión, lo mandamos al panel
if (haySesionIniciada()) {
    redirigir('bienvenida.php');
}

$errores = [
    'campos'       => 'Completá todos los campos.',
    'correo'       => 'Ingresá un correo electrónico válido.',
    'credenciales' => 'El correo o la contraseña no son correctos.',
    'sesion'       => 'Tenés que iniciar sesión para acceder.',
];

$error   = $_GET['error'] ?? '';
$exito   = $_GET['ok'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

  <main class="contenedor">
    <section class="tarjeta">
      <h1 class="titulo">Iniciar sesión</h1>

      <?php if ($exito === 'registro'): ?>
        <div class="alerta alerta-exito">Usuario creado correctamente. Ahora iniciá sesión.</div>
      <?php endif; ?>

      <?php if (isset($errores[$error])): ?>
        <div class="alerta alerta-error"><?= htmlspecialchars($errores[$error]) ?></div>
      <?php endif; ?>

      <!-- Formulario de login: validado por HTML (required), JavaScript y PHP -->
      <form id="formLogin" action="validar_login.php" method="POST" autocomplete="off">
        <div class="campo">
          <label for="correo">Correo electrónico</label>
          <input
            type="email"
            id="correo"
            name="correo"
            placeholder="Correo @gmail.com"
            data-error-vacio="Email @gmail.com obligatorio"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <div class="campo">
          <label for="password">Contraseña</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Contraseña"
            data-error-vacio="La contraseña es obligatoria (mín 8)"
            minlength="8"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <button type="submit" class="btn-principal">Ingresar</button>
      </form>

      <div class="opciones">
        <p><a href="registro.php">¿No tenés cuenta? Crear una</a></p>
        <p><a href="recuperar.php">¿Olvidaste la contraseña?</a></p>
      </div>
    </section>
  </main>

  <script src="js/validaciones.js"></script>
</body>
</html>
