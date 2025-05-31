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
    header("Location: ../views/home.php?login=error");
    exit;
}

$db = new BBDD();
$usuario = $db->getUsuarioPorEmail($emailUsuario);

if ($usuario) {
    $esAdmin = ($usuario["email"] === 'administrador@vacunacion.info');

    // ✅ Si es admin, compara en texto plano
    if ($esAdmin && $passwordUsuario === $usuario["password"]) {
        $_SESSION["rol"] = 'admin';
    }
    // ✅ Si no es admin, verifica con password_hash
    elseif (!$esAdmin && password_verify($passwordUsuario, $usuario["password"])) {
        $_SESSION["rol"] = 'usuario';
    }
    else {
        header("Location: ../views/home.php?login=fallido");
        exit;
    }

    // Datos comunes para ambos
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["id"] = $usuario["id"];

    // Redirección según el rol
    if ($_SESSION["rol"] === 'admin') {
        header("Location: ../views/panel_admin.php");
    } else {
        header("Location: ../views/panel_usuario.php");
    }
    exit;
} else {
    header("Location: ../views/home.php?login=fallido");
    exit;
}
