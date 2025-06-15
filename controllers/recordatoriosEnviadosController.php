<?php
require_once '../models/BBDD.php';

if (session_status() === PHP_SESSION_NONE) session_start();

// Solo permitir acceso si es administrador
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'administrador@vacunacion.info') {
    header("Location: /TFG/views/home.php");
    exit;
}

$db = new BBDD();
$conn = $db->getConexion();

$sql = "SELECT re.*, h.fecha_nacimiento, u.nombre AS nombre_usuario, u.email
        FROM recordatorios_enviados re
        JOIN hijos h ON re.hijo_id = h.id
        JOIN usuarios u ON h.usuario_id = u.id
        ORDER BY re.fecha_envio DESC";

$recordatorios = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
