<?php
session_start();
require_once __DIR__ . '/../models/BBDD.php';

// ✅ Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
    header("Location: /views/home.php");
    exit;
}

$db = new BBDD();

// ✅ Solo procesa si llega por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoNombre = trim($_POST['nombre'] ?? '');
    $nuevoEmail = trim($_POST['email'] ?? '');
    $nuevaPassword = trim($_POST['nueva_password'] ?? '');

    if ($nuevoNombre && $nuevoEmail) {
        $actualizado = $db->actualizarUsuario(
            $_SESSION['id'],
            $nuevoNombre,
            $nuevoEmail,
            $nuevaPassword ?: null
        );

        if ($actualizado) {
            $_SESSION['nombre'] = $nuevoNombre;
            $_SESSION['email'] = $nuevoEmail;
            header("Location: /views/editar_perfil.php?actualizado=1");
            exit;
        } else {
            header("Location: /views/editar_perfil.php?actualizado=0");
            exit;
        }
    } else {
        header("Location: /views/editar_perfil.php?actualizado=0");
        exit;
    }
}
