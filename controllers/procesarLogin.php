<?php
session_start();
require_once '../models/BBDD.php';

if (
    isset($_POST["email"], $_POST["password"]) &&
    !empty(trim($_POST["email"])) &&
    !empty(trim($_POST["password"]))
) {
    $emailUsuario = trim($_POST["email"]);
    $passwordUsuario = trim($_POST["password"]);
} else {
    $_SESSION['error_login'] = "Debes introducir tu correo y contraseña.";
    header("Location: ../views/home.php");
    exit;
}

$db = new BBDD();
$usuario = $db->getUsuarioPorEmail($emailUsuario);

if ($usuario) {
    $esAdmin = ($usuario["email"] === 'administrador@vacunacion.info');

    if ($esAdmin && $passwordUsuario === $usuario["password"]) {
        $_SESSION["rol"] = 'admin';
    } elseif (!$esAdmin && password_verify($passwordUsuario, $usuario["password"])) {
        $_SESSION["rol"] = 'usuario';
    } else {
        $_SESSION['error_login'] = "Correo o contraseña incorrectos.";
        header("Location: ../views/home.php");
        exit;
    }

    $_SESSION["email"] = $usuario["email"];
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["id"] = $usuario["id"];

    // Redirige según el rol
    header("Location: ../views/" . ($_SESSION["rol"] === 'admin' ? 'panel_admin.php' : 'panel_usuario.php'));
    exit;
} else {
    $_SESSION['error_login'] = "El usuario no existe.";
    header("Location: ../views/home.php");
    exit;
}
