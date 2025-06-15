<?php

require_once __DIR__ . '/../models/BBDD.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $token = $_POST['token'] ?? '';

    $nueva = $_POST['nueva_contrasena'] ?? '';

    $confirmar = $_POST['confirmar_contrasena'] ?? '';


    if (empty($token) || empty($nueva) || empty($confirmar)) {

        header("Location: /index.php?error=campos_vacios#loginOverlay");

        exit();

    }


    if ($nueva !== $confirmar) {

        header("Location: /index.php?error=contrasenas_no_coinciden#loginOverlay");

        exit();

    }


    $db = new BBDD();

    $conn = $db->getConexion();


    // Verificar token válido

    $stmt = $conn->prepare("SELECT user_id, expires_at FROM password_resets WHERE token = ? AND used IS NULL");

    $stmt->execute([$token]);

    $reset = $stmt->fetch(PDO::FETCH_ASSOC);


    if (!$reset || new DateTime() > new DateTime($reset['expires_at'])) {

        header("Location: /index.php?error=token_invalido#loginOverlay");

        exit();

    }


    // Encriptar y actualizar contraseña

    $hash = password_hash($nueva, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("UPDATE usuarios SET password = ? WHERE id = ?");

    $stmt->execute([$hash, $reset['user_id']]);


    // Marcar token como usado

    $stmt = $conn->prepare("UPDATE password_resets SET used = 1 WHERE token = ?");

    $stmt->execute([$token]);


    header("Location: /index.php?info=contrasena_actualizada#loginOverlay");

    exit();

}


// Si accede por GET

header("Location: /index.php");

exit();

