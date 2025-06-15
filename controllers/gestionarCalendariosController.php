<<?php
require_once __DIR__ . '/../models/BBDD.php';

$db = new BBDD(); 
$mensaje = null;

// ✅ Procesar formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['comunidad_id']) ? (int) $_POST['comunidad_id'] : null;

    // 🗑️ Eliminar imagen
    if (isset($_POST['eliminar']) && $id) {
        $db->eliminarImagenComunidad($id);
        $mensaje = "✅ Imagen eliminada correctamente.";
    }

    // 📤 Subir y actualizar imagen
    if (isset($_POST['actualizar']) && isset($_FILES['nueva_imagen']) && $id) {
        $nombreArchivo = basename($_FILES['nueva_imagen']['name']);
        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
        $extensionesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($extension, $extensionesPermitidas)) {
            $rutaFinal = "bootstrap/img/calendario/" . uniqid('cal_', true) . "." . $extension;
            $rutaFisica = __DIR__ . '/../views/' . $rutaFinal;

            if (move_uploaded_file($_FILES['nueva_imagen']['tmp_name'], $rutaFisica)) {
                $db->actualizarImagenComunidad($id, $rutaFinal);
                $mensaje = "✅ Imagen actualizada con éxito.";
            } else {
                $mensaje = "❌ Error al mover la imagen al servidor.";
            }
        } else {
            $mensaje = "❌ Tipo de archivo no permitido.";
        }
    }
}

// ✅ Obtener comunidades para mostrar
$comunidades = $db->obtenerComunidades();
