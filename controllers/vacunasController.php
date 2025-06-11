<?php
session_start();
require_once __DIR__ . '/../models/BBDD.php';

// Solo el administrador puede acceder
if (!isset($_SESSION['email']) || $_SESSION['email'] !== 'administrador@vacunacion.info') {
    header("Location: /index.php");
    exit;
}

$db = new BBDD();
$conn = $db->getConexion();

// ✅ Añadir vacuna
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'crear') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $codigo = $_POST['codigo'];

    // Validar duplicados por código
    $sqlCheck = "SELECT COUNT(*) FROM vacunas WHERE codigo = :codigo";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->execute(['codigo' => $codigo]);
    $existe = $stmtCheck->fetchColumn();

    if ($existe > 0) {
        header("Location: /views/vacunas_gestion.php?error=duplicado");
        exit;
    }

    // Insertar nueva vacuna
    $sql = "INSERT INTO vacunas (nombre, descripcion, codigo) VALUES (:nombre, :descripcion, :codigo)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'codigo' => $codigo
    ]);
    header("Location: /views/vacunas_gestion.php?ok=creado");
    exit;
}

// ✅ Editar vacuna existente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'editar') {
    $sql = "UPDATE vacunas SET nombre = :nombre, descripcion = :descripcion, codigo = :codigo WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'nombre' => $_POST['nombre'],
        'descripcion' => $_POST['descripcion'],
        'codigo' => $_POST['codigo'],
        'id' => $_POST['id']
    ]);
    header("Location: /views/vacunas_gestion.php?ok=editado");
    exit;
}

// ✅ Eliminar vacuna
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['accion'] === 'eliminar') {
    $sql = "DELETE FROM vacunas WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['id' => $_POST['id']]);
    header("Location: /views/vacunas_gestion.php?ok=eliminado");
    exit;
}

// ✅ Obtener todas las vacunas para mostrarlas en la vista
$sql = "SELECT * FROM vacunas ORDER BY id ASC";
$vacunas = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

