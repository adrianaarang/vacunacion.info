<?php

// Incluye el modelo de base de datos

require_once '../models/BBDD.php';


// Inicia la sesión si no está iniciada ya

if (session_status() === PHP_SESSION_NONE) {

    session_start();

}


// Creo la instancia de la clase de base de datos

$db = new BBDD();


// Función para limpiar entradas de texto (evita espacios y caracteres raros)

function limpiarTexto($texto) {

    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');

}


// Función para validar que la fecha esté entre hoy y hace 18 años como máximo

function validarFechaNacimiento($fechaTexto) {

    $fecha = DateTime::createFromFormat('Y-m-d', $fechaTexto);

    $hoy = new DateTime();


    if (!$fecha) return false; // Fecha no válida

    if ($fecha > $hoy) return false; // Fecha futura


    $edad = $hoy->diff($fecha)->y;

    return $edad >= 0 && $edad <= 18;

}


// Si se envía el formulario por POST

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Esto lo dejo activado para ver errores en desarrollo (desactivarlo al subir)

    error_reporting(E_ALL);

    ini_set('display_errors', 1);


    // Recojo y limpio los datos del formulario

    $nombre = limpiarTexto($_POST['nombre'] ?? '');

    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);

    $passwordPlano = $_POST['password'] ?? '';

    $comunidadId = isset($_POST['comunidad_id']) ? (int)$_POST['comunidad_id'] : null;

    $numHijos = isset($_POST['num_hijos']) ? (int)$_POST['num_hijos'] : 0;


    // Validación del nombre

    if (!$nombre || strlen($nombre) > 50 || !preg_match('/^[A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+(?: [A-ZÁÉÍÓÚÜÑa-záéíóúüñ-]+)?$/', $nombre)) {

        die("Nombre inválido.");

    }


    // Validación del email

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        die("Email no válido.");

    }


    // Bloqueo del correo del administrador

    if (strtolower($email) === 'administrador@vacunacion.info') {

        die("No está permitido registrarse con este correo.");

    }


    // Validación de la contraseña

    if (

        !$passwordPlano ||

        strlen($passwordPlano) < 8 ||

        strlen($passwordPlano) > 15 ||

        !preg_match('/[A-Z]/', $passwordPlano) ||

        !preg_match('/[a-z]/', $passwordPlano) ||

        !preg_match('/\d/', $passwordPlano) ||

        !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $passwordPlano) ||

        preg_match('/\s/', $passwordPlano)

    ) {

        die("Contraseña inválida.");

    }


    // Validación de la comunidad

    if (!$comunidadId) {

        die("Debe seleccionar una comunidad.");

    }


    // Validación del número de hijos

    if ($numHijos < 1 || $numHijos > 15) {

        die("Número de hijos no válido.");

    }


    // Recojo las fechas de nacimiento de los hijos

    $fechasNacimiento = [];

    for ($i = 1; $i <= $numHijos; $i++) {

        $campo = 'fecha_nacimiento_' . $i;

        if (!empty($_POST[$campo]) && validarFechaNacimiento($_POST[$campo])) {

            $fechasNacimiento[] = $_POST[$campo];

        } else {

            die("La fecha de nacimiento del hijo $i no es válida.");

        }

    }

// Verificar si el email ya existe en la base de datos

    try {

        $conexion = $db->getConexion();

        $stmt = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");

        $stmt->execute([$email]);

        $existe = $stmt->fetchColumn();


        if ($existe > 0) {

            // El email ya está registrado

            header("Location: ../views/errorEmailDuplicado.php");

            exit;

        }

    } catch (Exception $e) {

        die("Error al verificar el email: " . htmlspecialchars($e->getMessage()));

    }


    // Encripto la contraseña

    $passwordHash = password_hash($passwordPlano, PASSWORD_DEFAULT);


    // Intento insertar el usuario y redirigir si todo va bien

    try {

        $db->insertarUsuarioConHijosPlano($nombre, $email, $passwordHash, $fechasNacimiento, $comunidadId);

        header("Location: ../views/registro_exitoso.php");

        exit;

    } catch (Exception $e) {

        echo "Error al registrar: " . htmlspecialchars($e->getMessage());

    }

}

