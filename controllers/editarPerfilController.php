<?php
// ✅ Controlador para actualizar los datos del perfil del usuario logueado

// Inicia sesión para acceder a variables de sesión (como el ID del usuario)
session_start();

// Carga la clase de acceso a la base de datos
require_once '../models/BBDD.php';

// ✅ Si el usuario no ha iniciado sesión, redirige al home
if (!isset($_SESSION['id'])) {
    header("Location: ../views/home.php");
    exit;
}

// Crea una instancia de la base de datos
$db = new BBDD();

// ✅ Verifica que el formulario se haya enviado por método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoge y limpia los datos del formulario (nombre, email y nueva contraseña)
    $nuevoNombre = trim($_POST['nombre'] ?? '');
    $nuevoEmail = trim($_POST['email'] ?? '');
    $nuevaPassword = trim($_POST['nueva_password'] ?? ''); // nota: campo debe llamarse "nueva_password"

    // ✅ Si el nombre y el email no están vacíos
    if ($nuevoNombre && $nuevoEmail) {
        // Llama al método del modelo para actualizar el usuario
        // Si no hay nueva contraseña, se envía null
        $actualizado = $db->actualizarUsuario(
            $_SESSION['id'],         // ID del usuario
            $nuevoNombre,            // Nuevo nombre
            $nuevoEmail,             // Nuevo email
            $nuevaPassword ?: null   // Nueva contraseña (si se ha escrito)
        );

        // ✅ Si la actualización fue exitosa
        if ($actualizado) {
            // Actualiza los datos en la sesión
            $_SESSION['nombre'] = $nuevoNombre;
            $_SESSION['email'] = $nuevoEmail;

            // Redirige a la vista con mensaje de éxito
            header("Location: ../views/editar_perfil.php?actualizado=1");
            exit;

        // ❌ Si la actualización falló
        } else {
            header("Location: ../views/editar_perfil.php?actualizado=0");
            exit;
        }

    // ❌ Si faltan nombre o email
    } else {
        header("Location: ../views/editar_perfil.php?actualizado=0");
        exit;
    }
}
