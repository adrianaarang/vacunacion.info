<?php
require_once __DIR__ . '/../models/BBDD.php';

$db = new BBDD();
$diasRecordatorio = [30, 14, 7];
$hoy = new DateTime();

echo "📧 Buscando recordatorios agrupados para vacunas futuras...\n";

// ✅ Obtener hijos con usuarios y comunidades
$sql = "SELECT u.email, u.nombre AS nombre_padre, h.id AS hijo_id, h.fecha_nacimiento, h.usuario_id, u.comunidad_id
        FROM hijos h
        JOIN usuarios u ON h.usuario_id = u.id";
$hijos = $db->getConexion()->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// 🔁 Recorre cada hijo
foreach ($hijos as $hijo) {
    $fechaNacimiento = new DateTime($hijo['fecha_nacimiento']);

    // 🔁 Evalúa edades desde 0 hasta 216 meses (18 años)
    for ($edadMeses = 0; $edadMeses <= 216; $edadMeses++) {
        // Calcula la fecha exacta en que el niño/a cumple esa edad
        $fechaVacuna = clone $fechaNacimiento;
        $fechaVacuna->modify("+$edadMeses months");

        foreach ($diasRecordatorio as $diasAntes) {
            // Calcula la fecha del recordatorio
            $fechaObjetivo = clone $fechaVacuna;
            $fechaObjetivo->modify("-$diasAntes days");

            // Verifica si hoy es esa fecha
            if ($hoy->format('Y-m-d') !== $fechaObjetivo->format('Y-m-d')) continue;

            // ✅ Verifica si ya se envió (vacuna agrupada)
            if ($db->yaSeEnvioRecordatorio($hijo['hijo_id'], 'AGRUPADO', $edadMeses, $diasAntes)) continue;

            // ✅ Obtiene las vacunas reales correspondientes
            $vacunas = $db->obtenerVacunasPorEdadYComunidad($hijo['comunidad_id'], $edadMeses);
            if (empty($vacunas)) continue;

            // 🔧 Construye la lista de vacunas en HTML
            $listaVacunasHTML = '<ul>';
            foreach ($vacunas as $vacuna) {
                $listaVacunasHTML .= "<li><strong>{$vacuna['nombre']}</strong>: {$vacuna['descripcion']}</li>";
            }
            $listaVacunasHTML .= '</ul>';

            // ✅ Construye el mensaje
            $asunto = "📅 Vacunas para tu hijo/a en $diasAntes días (edad {$edadMeses} meses)";
            $mensajeHTML = "
                <p>Hola {$hijo['nombre_padre']},</p>
                <p>Dentro de <strong>$diasAntes días</strong>, tu hijo/a cumplirá <strong>{$edadMeses} meses</strong>.</p>
                <p>Estas son las vacunas que le corresponden según el calendario de tu comunidad:</p>
                $listaVacunasHTML
                <p>Consulta con tu centro de salud para más detalles.</p>
                <p>— El equipo de vacunacion.info</p>
            ";

            // ✅ Envía el correo
            if (enviarCorreoBrevo($hijo['email'], $hijo['nombre_padre'], $asunto, $mensajeHTML)) {
                // ✅ Registra el envío en la base de datos
                $db->registrarRecordatorioEnviado($hijo['hijo_id'], 'AGRUPADO', $edadMeses, $diasAntes);

                // ✅ Registro visual y en log
                echo "✅ Recordatorio AGRUPADO enviado a {$hijo['email']} (edad {$edadMeses} meses, {$diasAntes} días antes)\n";
                file_put_contents(__DIR__ . '/log.txt', date('Y-m-d H:i:s') . " | AGRUPADO: {$hijo['email']} ({$edadMeses} meses, {$diasAntes} días antes)\n", FILE_APPEND);
            }
        }
    }
}


// --- FUNCIÓN DE ENVÍO CON BREVO ---
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

    $apiKey = "insertaAquiContraseña";

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
        echo "📬 Correo enviado a $destinatario\n";
        return true;
    }
}
