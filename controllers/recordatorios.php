<?php


// recordatorios.php

// Ubicación esperada: /opt/bitnami/apache2/htdocs/TFG/controllers/recordatorios.php


// ----------------------------------------------------------------------

// 1. Inclusión de Autoloader de Composer y Clases de Base de Datos

//    Asegúrate de que la ruta a 'autoload.php' sea correcta desde este archivo.

//    Desde /controllers/, '../' te lleva a la raíz /TFG/, donde debería estar 'vendor/'.

// ----------------------------------------------------------------------

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../models/BBDD.php'; // Tu clase de conexión a la BBDD


// ----------------------------------------------------------------------

// 2. Este script está diseñado para ejecutarse como un cron job.

//    Por lo tanto, no necesita iniciar una sesión PHP ni realizar verificaciones de autenticación de usuario.

//    El código relacionado con sesiones y autenticación ha sido eliminado o comentado.

// ----------------------------------------------------------------------



// ----------------------------------------------------------------------

// 3. Inicialización y Lógica Principal para Buscar Recordatorios

// ----------------------------------------------------------------------

$db = new BBDD();

$diasRecordatorio = [30, 14, 7]; // Días antes de la fecha de la vacuna para enviar el recordatorio

$hoy = new DateTime(); // Fecha actual para comparar


// Mensaje inicial en el log para indicar que el script se ha iniciado

file_put_contents(

    __DIR__ . '/recordatorios_cron.log',

    "\n--- " . date('Y-m-d H:i:s') . " --- Iniciando proceso de recordatorios ---\n",

    FILE_APPEND

);

echo "������ Buscando recordatorios para vacunas futuras...\n"; // Mensaje para la salida de la terminal/log


// Obtener hijos con usuarios y sus comunidades

$sql = "SELECT u.email, u.nombre AS nombre_padre, h.id AS hijo_id, h.fecha_nacimiento, h.usuario_id, u.comunidad_id

        FROM hijos h

        JOIN usuarios u ON h.usuario_id = u.id";

$hijos = $db->getConexion()->query($sql)->fetchAll(PDO::FETCH_ASSOC);


// Recorre cada hijo para verificar vacunas pendientes de recordatorio

foreach ($hijos as $hijo) {

    $fechaNacimiento = new DateTime($hijo['fecha_nacimiento']);


    // Evalúa edades desde 0 hasta 216 meses (18 años)

    for ($edadMeses = 0; $edadMeses <= 216; $edadMeses++) {

        $fechaVacuna = clone $fechaNacimiento;

        // Calcula la fecha en la que el hijo cumplirá esta edad en meses

        $fechaVacuna->modify("+$edadMeses months");


        foreach ($diasRecordatorio as $diasAntes) {

            $fechaObjetivo = clone $fechaVacuna;

            // Calcula la fecha en la que se debe enviar el recordatorio

            $fechaObjetivo->modify("-$diasAntes days");


            // Si la fecha objetivo no es HOY, salta a la siguiente iteración

            if ($hoy->format('Y-m-d') !== $fechaObjetivo->format('Y-m-d')) {

                continue;

            }


            // Obtener vacunas correspondientes a la edad y comunidad

            $vacunas = $db->obtenerVacunasPorEdadYComunidad($hijo['comunidad_id'], $edadMeses);


            if (empty($vacunas)) {

                continue; // No hay vacunas para esta edad y comunidad

            }


            // --- Lógica para NO enviar si TODAS las vacunas de ese grupo YA se enviaron ---

            $vacunasAEnviar = [];

            foreach ($vacunas as $vacuna) {

                if (!$db->yaSeEnvioRecordatorio($hijo['hijo_id'], $vacuna['nombre'], $edadMeses, $diasAntes)) {

                    $vacunasAEnviar[] = $vacuna; // Solo añadimos las que NO se han enviado

                }

            }


            if (empty($vacunasAEnviar)) {

                // Todas las vacunas para este grupo y día ya se enviaron, no hay nada que hacer.

                file_put_contents(

                    __DIR__ . '/recordatorios_cron.log',

                    date('Y-m-d H:i:s') . " | Info: Todas las vacunas para {$hijo['email']} (Edad: {$edadMeses}m, Días antes: {$diasAntes}) ya han sido enviadas.\n",

                    FILE_APPEND

                );

                continue;

            }


            // Construye el mensaje HTML del email

            $listaVacunasHTML = '<ul>';

            foreach ($vacunasAEnviar as $vacuna) {

                $listaVacunasHTML .= "<li><strong>{$vacuna['nombre']}</strong>: {$vacuna['descripcion']}</li>";

            }

            $listaVacunasHTML .= '</ul>';


            $asunto = "⏰ Recordatorio de Vacunas para tu hijo/a - " . $diasAntes . " días antes de los " . $edadMeses . " meses";

            $mensajeHTML = "

                <p>Hola {$hijo['nombre_padre']},</p>

                <p>Este es un recordatorio importante de Vacunacion.info.</p>

                <p>Dentro de <strong>$diasAntes días</strong>, tu hijo/a cumplirá <strong>{$edadMeses} meses</strong>.</p>

                <p>Según el calendario de vacunación de tu comunidad, estas son las vacunas recomendadas para esa edad:</p>

                $listaVacunasHTML

                <p>Por favor, consulta con tu centro de salud para planificar la vacunación.</p>

                <p>Para más información, visita nuestra web o revisa el calendario oficial de tu comunidad.</p>

                <p>— El equipo de Vacunacion.info</p>

                <p style='font-size: 0.8em; color: #888;'>Este es un mensaje automático. Por favor, no respondas a este correo.</p>

            ";


            // ----------------------------------------------------------------------

            // 4. Llamada a la Función de Envío con la SDK de Brevo

            // ----------------------------------------------------------------------

            if (enviarCorreoBrevo($hijo['email'], $hijo['nombre_padre'], $asunto, $mensajeHTML)) {

                // Si el correo se envió con éxito, registra CADA vacuna de este grupo que fue enviada

                foreach ($vacunasAEnviar as $vacuna) {

                    try {

                        $db->registrarRecordatorioEnviado($hijo['hijo_id'], $vacuna['nombre'], $edadMeses, $diasAntes);

                        // Loguea el éxito en un archivo de log

                        file_put_contents(

                            __DIR__ . '/recordatorios_cron.log',

                            date('Y-m-d H:i:s') . " | ✅ Recordatorio enviado y registrado: {$hijo['email']} | Vacuna: {$vacuna['nombre']} | Edad: {$edadMeses}m | Días antes: {$diasAntes}\n",

                            FILE_APPEND

                        );

                    } catch (Exception $e) {

                        // Loguea errores de registro en la BBDD

                        file_put_contents(

                            __DIR__ . '/recordatorios_cron.log',

                            date('Y-m-d H:i:s') . " | ❌ Error al registrar recordatorio para {$hijo['email']} (Vacuna: {$vacuna['nombre']}): " . $e->getMessage() . "\n",

                            FILE_APPEND

                        );

                    }

                }

                echo "✅ Recordatorio procesado para {$hijo['email']} (edad {$edadMeses} meses, {$diasAntes} días antes)\n";

            } else {

                echo "❌ Fallo al enviar recordatorio a {$hijo['email']} (ver log para detalles).\n";

                file_put_contents(

                    __DIR__ . '/recordatorios_cron.log',

                    date('Y-m-d H:i:s') . " | ❌ Fallo el envío general para {$hijo['email']}.\n",

                    FILE_APPEND

                );

            }

        }

    }

}


// Mensaje final en el log

file_put_contents(

    __DIR__ . '/recordatorios_cron.log',

    "--- " . date('Y-m-d H:i:s') . " --- Proceso de recordatorios finalizado ---\n\n",

    FILE_APPEND

);

echo "Proceso de recordatorios finalizado.\n";



// ----------------------------------------------------------------------

// 5. Función de Envío de Correo Usando la SDK de Brevo

// ----------------------------------------------------------------------

function enviarCorreoBrevo($destinatario, $nombreDestinatario, $asunto, $contenidoHTML) {

    // Obtener la clave API de una variable de entorno.

    // Esto es CRÍTICO para seguridad en producción en AWS.

    $brevoApiKey = getenv('BREVO_API_KEY');


    if (!$brevoApiKey) {

        // En lugar de echo, solo loguea para el cron job

        error_log("❌ ERROR: La clave API de Brevo (BREVO_API_KEY) no está definida como variable de entorno.");

        return false;

    }


    // Configurar la instancia de la API de Brevo con tu clave API

    $config = Brevo\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $brevoApiKey);

    $apiInstance = new Brevo\Client\Api\TransactionalEmailsApi(

        new GuzzleHttp\Client(), // El cliente HTTP que usará la SDK (GuzzleHttp es una dependencia de Brevo SDK)

        $config

    );


    // Crear el objeto del email a enviar

    $sendSmtpEmail = new \Brevo\Client\Model\SendSmtpEmail([

        'subject'     => $asunto,

        'sender'      => ['name' => 'Vacunacion.info', 'email' => 'administrador@vacunacion.info'],

        'to'          => [

            ['email' => $destinatario, 'name' => $nombreDestinatario]

        ],

        'htmlContent' => $contenidoHTML,

        // Si tienes una plantilla de Brevo, puedes usar 'templateId' y 'params' en su lugar:

        // 'templateId' => ID_DE_TU_PLANTILLA_EN_BREVO, // Reemplaza con el ID de tu plantilla

        // 'params' => [

        //     'nombre_padre' => $nombreDestinatario,

        //     // Asegúrate de que los nombres de las variables aquí coincidan con los de tu plantilla en Brevo

        //     'asunto_email' => $asunto

        // ]

    ]);


    try {

        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);

        // La respuesta contiene el ID del mensaje, útil para seguimiento en Brevo

        // Puedes loguear el MessageId para un seguimiento más granular

        file_put_contents(

            __DIR__ . '/recordatorios_cron.log',

            date('Y-m-d H:i:s') . " | Info Brevo: Email enviado con Message ID: " . $result->getMessageId() . " a {$destinatario}\n",

            FILE_APPEND

        );

        return true; // Éxito en el envío

    } catch (Exception $e) {

        // Captura y loguea cualquier excepción de la API de Brevo

        $errorMessage = $e->getMessage();

        // Intenta decodificar el mensaje de error de Brevo si es JSON

        $errorDetails = '';

        if (strpos($errorMessage, '{') !== false) {

            $errorResponse = json_decode($errorMessage, true);

            if (json_last_error() === JSON_ERROR_NONE) { // Asegurarse de que es un JSON válido

                $errorDetails = isset($errorResponse['message']) ? $errorResponse['message'] : 'Desconocido';

                if (isset($errorResponse['code'])) {

                     $errorDetails .= " (Code: " . $errorResponse['code'] . ")";

                }

            } else {

                $errorDetails = $errorMessage; // Si no es un JSON válido, usa el mensaje original

            }

        } else {

            $errorDetails = $errorMessage; // Si no es JSON, usa el mensaje original

        }


        // Loguea el error en el archivo de log del cron job

        file_put_contents(

            __DIR__ . '/recordatorios_cron.log',

            date('Y-m-d H:i:s') . " | ❌ ERROR Brevo SDK al enviar email a {$destinatario}: " . $errorDetails . "\n",

            FILE_APPEND

        );

        error_log('❌ ERROR Brevo SDK (PHP error_log): ' . $errorDetails); // También al log general de PHP

        return false; // Fallo en el envío

    }

}


?>
