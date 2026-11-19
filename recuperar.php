<?php
/**
 * RECUPERAR CONTRASEÑA (simulado)
 * En un proyecto real aquí se enviaría un correo con un enlace
 */
require_once __DIR__ . '/includes/auth.php';

$enviado = false;
$correo  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = trim($_POST['correo'] ?? '');
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $enviado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recuperar contraseña</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>

  <main class="contenedor">
    <section class="tarjeta">
      <h1 class="titulo">Recuperar contraseña</h1>

      <?php if ($enviado): ?>
        <div class="alerta alerta-exito">
          Si el correo <strong><?= htmlspecialchars($correo) ?></strong> está registrado,
          recibirías un enlace para restablecer tu contraseña.
        </div>
      <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <div class="alerta alerta-error">Ingresá un correo electrónico válido.</div>
      <?php endif; ?>

      <form action="recuperar.php" method="POST" autocomplete="off">
        <div class="campo">
          <label for="correo">Correo electrónico</label>
          <input
            type="email"
            id="correo"
            name="correo"
            placeholder="Correo @gmail.com"
            data-error-vacio="Email @gmail.com obligatorio"
            value="<?= htmlspecialchars($correo) ?>"
            required>
          <span class="mensaje-error" aria-live="polite"></span>
        </div>

        <button type="submit" class="btn-principal">Recuperar</button>
      </form>

      <div class="opciones">
        <p><a href="index.php">Volver al inicio de sesión</a></p>
      </div>
    </section>
  </main>

  <script src="js/validaciones.js"></script>
</body>
</html>
