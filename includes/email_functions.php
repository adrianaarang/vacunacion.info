<?php


/**

 * Archivo: includes/email_functions.php

 * Contiene funciones para el envío de correos electrónicos utilizando la SDK de Brevo.

 * Se espera que 'vendor/autoload.php' ya haya sido incluido en el script principal

 * que llama a estas funciones (ej. controllers/recordatorios.php o controllers/reset_password_request.php).

 */



/**

 * Función para enviar correos electrónicos utilizando la SDK de Brevo (anteriormente Sendinblue).

 * Requiere que la clave API de Brevo esté definida como una variable de entorno 'BREVO_API_KEY'.

 * Requiere que las dependencias de Composer (incluyendo Brevo\Client y GuzzleHttp) estén instaladas.

 *

 * @param string $destinatario El email del destinatario.

 * @param string $nombreDestinatario El nombre del destinatario.

 * @param string $asunto El asunto del correo.

 * @param string $contenidoHTML El contenido del correo en formato HTML.

 * @return bool True si el envío fue exitoso, false en caso de error.

 */

function enviarCorreoBrevo($destinatario, $nombreDestinatario, $asunto, $contenidoHTML) {

    // ######################################################################

    // ###          ¡¡¡ ESTA ES LA ÚNICA LÍNEA QUE DEBES CAMBIAR !!!        ###

    // ######################################################################


    // TU CLAVE API DE BREVO (Sendinblue)

    // Encuéntrala en tu cuenta de Brevo (SMTP & API -> Claves API)

    // ESTA CLAVE NO PUEDO PROPORCIONÁRTELA.

    $brevoApiKey = getenv('BREVO_API_KEY'); 


    // ######################################################################

    // ###  FIN DE LA LÍNEA QUE DEBES CAMBIAR. EL RESTO YA USA LOS DATOS DE RECORDATORIOS.  ###

    // ######################################################################


    // CONFIGURACIÓN DEL REMITENTE - Usando los datos de tu archivo recordatorios.php

    // ¡ASEGÚRATE DE QUE EL EMAIL 'administrador@vacunacion.info' ESTÁ VERIFICADO EN TU CUENTA DE BREVO!

    $senderEmail = 'administrador@vacunacion.info'; 

    $senderName = 'Vacunacion.info';      


    // Si la clave API no está definida como variable de entorno, fallamos.

    if (!$brevoApiKey) {

        error_log(date('Y-m-d H:i:s') . " | ❌ ERROR: La clave API de Brevo (BREVO_API_KEY) no está definida como variable de entorno.");

        return false;

    }


    // Configurar la instancia de la API de Brevo con tu clave API

    // Asegúrate de que la SDK de Brevo y GuzzleHttp estén disponibles via Composer autoload.

    try {

        $config = Brevo\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $brevoApiKey);

        $apiInstance = new Brevo\Client\Api\TransactionalEmailsApi(

            new GuzzleHttp\Client(), // El cliente HTTP que usará la SDK (GuzzleHttp es una dependencia de Brevo SDK)

            $config

        );

    } catch (Exception $e) {

        error_log(date('Y-m-d H:i:s') . " | ❌ ERROR al inicializar la API de Brevo para {$destinatario}: " . $e->getMessage());

        return false;

    }



    // Crear el objeto del email a enviar

    $sendSmtpEmail = new \Brevo\Client\Model\SendSmtpEmail([

        'subject'     => $asunto,

        // Remitente del correo

        'sender'      => ['name' => $senderName, 'email' => $senderEmail], 

        'to'          => [ // Destinatario(s)

            ['email' => $destinatario, 'name' => $nombreDestinatario]

        ],

        'htmlContent' => $contenidoHTML, // Contenido del correo en HTML

    ]);


    try {

        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);

        error_log(date('Y-m-d H:i:s') . " | ✅ Info Brevo: Email enviado con Message ID: " . $result->getMessageId() . " a {$destinatario}");

        return true; // Éxito en el envío

    } catch (Exception $e) {

        $errorMessage = $e->getMessage();

        $errorDetails = '';

        if (strpos($errorMessage, '{') !== false) {

            $errorResponse = json_decode($errorMessage, true);

            if (json_last_error() === JSON_ERROR_NONE) {

                $errorDetails = isset($errorResponse['message']) ? $errorResponse['message'] : 'Desconocido';

                if (isset($errorResponse['code'])) {

                    $errorDetails .= " (Code: " . $errorResponse['code'] . ")";

                }

            } else {

                $errorDetails = $errorMessage;

            }

        } else {

            $errorDetails = $errorMessage;

        }


        error_log(date('Y-m-d H:i:s') . " | ❌ ERROR Brevo SDK al enviar email a {$destinatario}: " . $errorDetails);

        return false; // Fallo en el envío

    }

}

