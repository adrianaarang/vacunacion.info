<?php
require_once '../models/BBDD.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$db = new BBDD();

function limpiarTexto($texto) {
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}

function validarFechaNacimiento($fechaTexto) {
    $fecha = DateTime::createFromFormat('Y-m-d', $fechaTexto);
    $hoy = new DateTime();
    if (!$fecha) return false;
    if ($fecha > $hoy) return false;

    $edad = $hoy->diff($fecha)->y;
    return $edad >= 0 && $edad <= 18;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    error_reporting(E_ALL); // Quitar en producción
    ini_set('display_errors', 1);

    $nombre = limpiarTexto($_POST['nombre'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $passwordPlano = $_POST['password'] ?? '';
    $comunidadId = isset($_POST['comunidad_id']) ? (int)$_POST['comunidad_id'] : null;
    $numHijos = isset($_POST['num_hijos']) ? (int)$_POST['num_hijos'] : 0;

    // Validaciones
    if (!$nombre || strlen($nombre) > 50 || !preg_match('/^[A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+(?: [A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+)?$/', $nombre)) {
        die("Nombre inválido.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email no válido.");
    }

    if (strtolower($email) === 'administrador@vacunacion.info') {
        die("No está permitido registrarse con este correo.");
    }

    if (!$passwordPlano || strlen($passwordPlano) < 8 || strlen($passwordPlano) > 15 ||
        !preg_match('/[A-Z]/', $passwordPlano) ||
        !preg_match('/[a-z]/', $passwordPlano) ||
        !preg_match('/\d/', $passwordPlano) ||
        !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $passwordPlano) ||
        preg_match('/\s/', $passwordPlano)) {
        die("Contraseña inválida.");
    }

    if (!$comunidadId) {
        die("Debe seleccionar una comunidad.");
    }

    if ($numHijos < 1 || $numHijos > 15) {
        die("Número de hijos no válido.");
    }

    $fechasNacimiento = [];
    for ($i = 1; $i <= $numHijos; $i++) {
        $campo = 'fecha_nacimiento_' . $i;
        if (!empty($_POST[$campo]) && validarFechaNacimiento($_POST[$campo])) {
            $fechasNacimiento[] = $_POST[$campo];
        } else {
            die("La fecha de nacimiento del hijo $i no es válida.");
        }
    }

    $passwordHash = password_hash($passwordPlano, PASSWORD_DEFAULT);

    try {
        $db->insertarUsuarioConHijosPlano($nombre, $email, $passwordHash, $fechasNacimiento, $comunidadId);
        header("Location: ../views/registro_exitoso.php");
        exit;
    } catch (Exception $e) {
        echo "Error al registrar: " . htmlspecialchars($e->getMessage());
    }
}
