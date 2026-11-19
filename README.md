# Proyecto Login

Alumno: Kiara Gonzalez
Materia: Analisis de Sistemas
Año de cursada: 2026 5°4°

Descripción

Es un login con registro de usuarios hecho con PHP 8, MySQL, CSS y JavaScript.
Para entrar hay que crear una cuenta y después iniciar sesión con el correo y la contraseña.

Cómo instalarlo

Copiar la carpeta login dentro de C:\xampp\htdocs\
Abrir phpMyAdmin e importar el archivo sql/db_login.sql
Encender Apache y MySQL desde el panel de XAMPP
Entrar a http://localhost/login/

Archivos

index.php es la pantalla del login
registro.php es el formulario para crear usuario
validar_login.php comprueba el login
guardar_usuario.php guarda el usuario nuevo
bienvenida.php es la página que se ve después de iniciar sesión
logout.php cierra la sesión
css/styles.css tiene los estilos
js/validaciones.js tiene la validación de los campos
sql/db_login.sql tiene la base de datos

Datos de la base de datos

Servidor localhost
Usuario root
Contraseña admin.123$
Base de datos db_login

Los datos están configurados en includes/conexion.php.
