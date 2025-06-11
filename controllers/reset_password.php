<?php

require_once __DIR__ . '/../models/BBDD.php';


$token = $_GET['token'] ?? '';

$db = new BBDD();

$conn = $db->getConexion();


$stmt = $conn->prepare("SELECT user_id, expires_at FROM password_resets WHERE token = ? AND used IS NULL");

$stmt->execute([$token]);

$reset = $stmt->fetch(PDO::FETCH_ASSOC);


if (!$reset || new DateTime() > new DateTime($reset['expires_at'])) {

    $error = "El enlace de restablecimiento es inválido o ha expirado.";

}


require_once __DIR__ . '/../views/reset_password_view.php';

