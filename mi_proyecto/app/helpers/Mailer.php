<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function enviarCorreoRecuperacion($destinatario, $token)
    {
        $config = require __DIR__ . '/../../config/mail.php';
        $enlace = "http://localhost/mi_proyecto/app/views/auth/reset_password.php?token=" . $token;

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $config['smtp_host'];
            $mail->SMTPAuth = true;
            $mail->Username = $config['smtp_user'];
            $mail->Password = $config['smtp_pass'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = $config['smtp_port'];

            $mail->setFrom($config['smtp_user'], $config['smtp_from_name']);
            $mail->addAddress($destinatario);

            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de contraseña - PawFinder';
            $mail->Body = "Hacé clic en el siguiente enlace para restablecer tu contraseña:<br><a href='$enlace'>$enlace</a><br>Este enlace expira en 1 hora.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error enviando correo: " . $mail->ErrorInfo);
            return false;
        }
    }
}
