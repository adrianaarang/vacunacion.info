<?php


require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoload para Brevo SDK

require_once __DIR__ . '/../models/BBDD.php';     // Clase de conexi√≥n a la base de datos


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST['email'] ?? '');


    if (empty($email)) {

        header("Location: /index.php?error=email_vacio#loginOverlay");

        exit();

    }


    $db = new BBDD();

    $conn = $db->getConexion();


    // Buscar usuario por email

    $stmt = $conn->prepare("SELECT id, nombre FROM usuarios WHERE email = ?");

    $stmt->execute([$email]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($usuario) {

        $token = bin2hex(random_bytes(32));

        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));


        // Insertar solicitud de reseteo

        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)");

        $stmt->execute([$usuario['id'], $token, $expira]);


        // URL con token

        $resetLink = 'https://vacunacion.info/controllers/reset_password.php?token=' . $token;


        // Contenido del correo

        $asunto = 'Restablecer Contrase√±a de Vacunacion.info';

        $mensajeHTML = "

            <p>Hola {$usuario['nombre']},</p>

            <p>Has solicitado restablecer tu contrase√±a. Haz clic en el siguiente enlace:</p>

            <p><a href='$resetLink'>$resetLink</a></p>

            <p>Este enlace expirar√° en 1 hora.</p>

            <p>Si no solicitaste esto, ignora este correo.</p>

            <p style='font-size: 0.8em; color: #888;'>Este es un mensaje autom√°tico. No respondas a este correo.</p>

        ";


        // Enviar correo

        if (enviarCorreoBrevo($email, $usuario['nombre'], $asunto, $mensajeHTML)) {

            header("Location: /index.php?info=reset_email_sent#loginOverlay");

            exit();

        } else {

            error_log("‚ùå ERROR al enviar el correo de recuperaci√≥n a $email");

            header("Location: /index.php?error=email_send_failed#loginOverlay");

            exit();

        }

    } else {

        // No mostrar que el usuario no existe

        header("Location: /index.php?info=reset_request_processed#loginOverlay");

        exit();

    }

}


// Si accede por GET, redirige

header("Location: /index.php");

exit();



// ‚úÖ Funci√≥n de env√≠o de correo con Brevo (con logs detallados)

function enviarCorreoBrevo($destinatario, $nombreDestinatario, $asunto, $contenidoHTML) {

    $apiKey = getenv('BREVO_API_KEY'); // misma clave que en recordatorios.php


    if (!$apiKey) {

        error_log("‚ùå No se encontr√≥ la clave API de Brevo.");

        file_put_contents(__DIR__ . '/../logs/error_envio_reset.log', "‚ùå Clave API no encontrada\n", FILE_APPEND);

        return false;

    }


    error_log("Ì†æÌ∑™ Enviando a: $destinatario");

    error_log("Ì†ΩÌ¥ë API Key (inicio): " . substr($apiKey, 0, 10) . '...');


    $config = Brevo\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);

    $apiInstance = new Brevo\Client\Api\TransactionalEmailsApi(new GuzzleHttp\Client(), $config);


    $sendSmtpEmail = new Brevo\Client\Model\SendSmtpEmail([

        'subject'     => $asunto,

        'sender'      => ['name' => 'Vacunacion.info', 'email' => 'administrador@vacunacion.info'],

        'to'          => [[ 'email' => $destinatario, 'name' => $nombreDestinatario ]],

        'htmlContent' => $contenidoHTML

    ]);


    try {

        $apiInstance->sendTransacEmail($sendSmtpEmail);

        file_put_contents(__DIR__ . '/../logs/error_envio_reset.log', "‚úÖ Correo enviado correctamente a $destinatario\n", FILE_APPEND);

        return true;

    } catch (Exception $e) {

        $error = $e->getMessage();

        $log = "‚ùå Error Brevo al enviar a $destinatario:\n" . $error . "\n\n";

        file_put_contents(__DIR__ . '/../logs/error_envio_reset.log', $log, FILE_APPEND);

        error_log($log);

        return false;

    }

}

