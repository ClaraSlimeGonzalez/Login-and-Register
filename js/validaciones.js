/* =====================================================
   Proyecto Login / Registro - Validaciones en JavaScript
   - Verifica campos vacíos (complementando el required de HTML)
   - Verifica el formato del correo
   - Verifica la longitud mínima de la contraseña (8)
   - Verifica que las contraseñas coincidan en el registro
   ===================================================== */

document.addEventListener('DOMContentLoaded', function () {

  /** Muestra el mensaje de error debajo del campo */
  function mostrarError(input, mensaje) {
    input.classList.add('input-error');
    var etiqueta = input.parentElement.querySelector('.mensaje-error');
    if (etiqueta) {
      etiqueta.textContent = mensaje;
      etiqueta.classList.add('visible');
    }
  }

  /** Limpia el mensaje de error del campo */
  function limpiarError(input) {
    input.classList.remove('input-error');
    var etiqueta = input.parentElement.querySelector('.mensaje-error');
    if (etiqueta) {
      etiqueta.textContent = '';
      etiqueta.classList.remove('visible');
    }
  }

  /* -------------------------------------------------
     1) Validación de los campos (vacíos, correo, mínimo 8)
     Se dispara cuando falla la validación nativa de HTML
     y se muestra nuestro propio mensaje en rojo.
     ------------------------------------------------- */
  document.querySelectorAll('form input[required]').forEach(function (input) {

    input.addEventListener('invalid', function (evento) {
      evento.preventDefault(); // evita la burbuja predeterminada del navegador

      var mensaje = input.getAttribute('data-error-vacio') || 'Este campo es obligatorio';

      if (input.validity.typeMismatch) {
        mensaje = 'Ingresá un correo electrónico válido';
      } else if (input.validity.tooShort) {
        mensaje = 'La contraseña debe tener mínimo 8 caracteres';
      }

      mostrarError(input, mensaje);
    });

    // Al volver a escribir se limpia el error
    input.addEventListener('input', function () {
      limpiarError(input);
    });
  });

  /* -------------------------------------------------
     2) Verificación de que las contraseñas coincidan
        (solo en el formulario de registro)
     ------------------------------------------------- */
  var formRegistro = document.getElementById('formRegistro');

  if (formRegistro) {
    formRegistro.addEventListener('submit', function (evento) {
      var password = document.getElementById('password');
      var confirmar = document.getElementById('confirmar_password');

      if (password.value !== confirmar.value) {
        evento.preventDefault(); // no deja enviar el formulario
        mostrarError(confirmar, 'Las contraseñas no coinciden');
        confirmar.focus();
      }
    });
  }
});
