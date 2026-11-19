<?php
/**
 * Control de sesión de usuario
 */
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/** Devuelve true si hay un usuario logueado */
function haySesionIniciada(): bool
{
    return isset($_SESSION['usuario_id']);
}

/** Redirige al login si no hay sesión activa (protege las páginas privadas) */
function exigirSesion(): void
{
    if (!haySesionIniciada()) {
        header('Location: index.php?error=sesion');
        exit;
    }
}

/** Redirige a una URL y corta la ejecución */
function redirigir(string $url): void
{
    header('Location: ' . $url);
    exit;
}
