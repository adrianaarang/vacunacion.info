<?php
// Inicia la sesión
session_start();

// Incluye la clase de conexión a la base de datos
require_once '../models/BBDD.php';

// Comprueba que se han enviado el email y la contraseña
if (
    isset($_POST["email"], $_POST["password"]) &&
    !empty(trim($_POST["email"])) &&
    !empty(trim($_POST["password"]))
) {
    $emailUsuario = trim($_POST["email"]);
    $passwordUsuario = trim($_POST["password"]);
} else {
    // Si no se han rellenado los campos, guarda el error y redirige
    $_SESSION['error_login'] = "Debes introducir tu correo y contraseña.";
    header("Location: ../views/home.php");
    exit;
}

// Conexión a la base de datos
$db = new BBDD();

// Busca el usuario por email
$usuario = $db->getUsuarioPorEmail($emailUsuario);

if ($usuario) {
    // Comprueba si es el administrador
    $esAdmin = ($usuario["email"] === 'administrador@vacunacion.info');

    // Si es admin, se compara en plano (sin hash), si no, se verifica con password_verify
    if ($esAdmin && $passwordUsuario === $usuario["password"]) {
        $_SESSION["rol"] = 'admin';
    } elseif (!$esAdmin && password_verify($passwordUsuario, $usuario["password"])) {
        $_SESSION["rol"] = 'usuario';
    } else {
        // Si la contraseña no coincide
        $_SESSION['error_login'] = "Correo o contraseña incorrectos.";
        header("Location: ../views/home.php");
        exit;
    }

    // Guarda los datos del usuario en la sesión
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["id"] = $usuario["id"];

    // Redirige según el tipo de usuario
    header("Location: ../views/" . ($_SESSION["rol"] === 'admin' ? 'panel_admin.php' : 'panel_usuario.php'));
    exit;
} else {
    // Si el email no está registrado
    $_SESSION['error_login'] = "El usuario no existe.";
    header("Location: ../views/home.php");
    exit;
}
