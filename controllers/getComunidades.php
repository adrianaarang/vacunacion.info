<?php
// Indicamos que vamos a devolver contenido en formato JSON
header('Content-Type: application/json');

// Incluimos la clase BBDD para poder acceder a la base de datos
require_once __DIR__ . '/../models/BBDD.php';

try {
    // Creamos una instancia de conexión
    $db = new BBDD();

    // Obtenemos todas las comunidades desde la base de datos
    $comunidades = $db->obtenerComunidades();

    // Enviamos la respuesta como JSON
    echo json_encode($comunidades);
} catch (Exception $e) {
    // Si hay un error, devolvemos un código de error y un mensaje JSON
    http_response_code(500);
    echo json_encode(['error' => 'No se pudieron obtener las comunidades', 'mensaje' => $e->getMessage()]);
}
