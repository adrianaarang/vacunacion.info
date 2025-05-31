<?php
// ✅ Incluye el modelo de base de datos
require_once __DIR__ . '/../models/BBDD.php';

// ✅ Crea instancia de base de datos y conexión directa
$db = new BBDD();
$conn = $db->getConexion();

// ⏱️ Intervalo de ejecución en segundos
$intervalo = 10;

echo "🧪 Iniciando recordatorios cada $intervalo segundos...\n";

// 🔁 Bucle infinito para ejecución continua
while (true) {
    $hoy = new DateTime();
    echo "⏰ Ejecutando: " . $hoy->format('Y-m-d H:i:s') . "\n";

    // ✅ Consulta hijos junto con nombre del padre/madre y su comunidad
    $sql = "SELECT u.email, u.nombre AS nombre_padre, h.id AS hijo_id, h.fecha_nacimiento, h.usuario_id, u.comunidad_id
            FROM hijos h
            JOIN usuarios u ON h.usuario_id = u.id";
    $hijos = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // 🔁 Recorre cada hijo
    foreach ($hijos as $hijo) {
        echo "🧒 Revisando vacunas para {$hijo['nombre_padre']} ({$hijo['email']})\n";
        $fechaNacimiento = new DateTime($hijo['fecha_nacimiento']);

        $proximaVacuna = null;

        // 🔁 Recorre edades desde 0 hasta 24 meses (puedes ampliar hasta 216 si quieres 18 años)
        for ($meses = 0; $meses <= 24; $meses++) {
            // ✅ Obtiene las vacunas programadas para esa edad y comunidad
            $vacunas = $db->obtenerVacunasPorEdadYComunidad($hijo['comunidad_id'], $meses);

            if (!empty($vacunas)) {
                // ✅ Calcula la fecha en que el hijo cumple esos meses
                $fechaVacuna = clone $fechaNacimiento;
                $fechaVacuna->modify("+$meses months");

                // ✅ Calcula cuántos días faltan desde hoy
                $diasFaltan = $hoy->diff($fechaVacuna)->days;

                // Si ya ha pasado, ignora
                if ($hoy > $fechaVacuna) continue;

                // ✅ Guarda la primera vacuna como próxima
                $proximaVacuna = [
                    'dias' => $diasFaltan,
                    'edad_meses' => $meses,
                    'fecha' => $fechaVacuna->format('Y-m-d'),
                    'vacuna' => $vacunas[0] // 👈 solo la primera (puedes agrupar si lo deseas)
                ];
                break; // 👈 sale del bucle al encontrar la primera futura
            }
        }

        // ✅ Si se encontró una vacuna futura, construye y envía correo
        if ($proximaVacuna) {
            $asunto = "⏳ Quedan {$proximaVacuna['dias']} días para la próxima vacuna";

            $mensajeHTML = "
                <p>Hola {$hijo['nombre_padre']},</p>
                <p>Dentro de <strong>{$proximaVacuna['dias']} días</strong>, tu hijo/a cumplirá <strong>{$proximaVacuna['edad_meses']} meses</strong> (el día <strong>{$proximaVacuna['fecha']}</strong>).</p>
                <p>Le corresponde la vacuna: <strong>{$proximaVacuna['vacuna']['nombre']}</strong></p>
                <p><em>{$proximaVacuna['vacuna']['descripcion']}</em></p>
                <p>Consulta con tu centro de salud para más detalles.</p>
                <p>— Equipo de vacunacion.info</p>
            ";

            // ✅ Envío real del correo
            enviarCorreoBrevo($hijo['email'], $hijo['nombre_padre'], $asunto, $mensajeHTML);

            // ✅ Registro en archivo log.txt
            file_put_contents(__DIR__ . '/log.txt', date('Y-m-d H:i:s') . " | Recordatorio enviado a {$hijo['email']} para vacuna {$proximaVacuna['vacuna']['nombre']}\n", FILE_APPEND);
        } else {
            echo "📭 No hay vacunas programadas futuras para este hijo/a.\n";
        }
    }

    echo "✅ Esperando $intervalo segundos...\n";
    sleep($intervalo); // 🕐 Espera antes de volver a ejecutar
}


// --- ENVÍO BREVO ---
function enviarCorreoBrevo($destinatario, $nombreDestinatario, $asunto, $contenidoHTML) {
    $data = [
        "sender" => [
            "name" => "Vacunacion.info",
            "email" => "adriaranguez89@gmail.com"
        ],
        "to" => [
            ["email" => $destinatario, "name" => $nombreDestinatario]
        ],
        "subject" => $asunto,
        "htmlContent" => $contenidoHTML
    ];

    $apiKey = "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";

    $options = [
        "http" => [
            "header"  => "Content-type: application/json\r\n" .
                         "api-key: $apiKey\r\n",
            "method"  => "POST",
            "content" => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents("https://api.brevo.com/v3/smtp/email", false, $context);

    if ($result === FALSE) {
        echo "❌ Error al enviar a $destinatario\n";
        return false;
    } else {
        echo "✅ Correo enviado a $destinatario\n";
        return true;
    }
}

