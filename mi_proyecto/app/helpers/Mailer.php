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
            $mail->Body = $this->plantillaRecuperacion($enlace);
            $mail->AltBody = "Recibimos una solicitud para restablecer tu contraseña en PawFinder.\n\n"
                . "Copiá y pegá este enlace en tu navegador para continuar:\n$enlace\n\n"
                . "Este enlace expira en 1 hora. Si no solicitaste este cambio, podés ignorar este correo.";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error enviando correo: " . $mail->ErrorInfo);
            return false;
        }
    }

    // Plantilla HTML del correo de recuperación de contraseña, con los
    // colores de la marca PawFinder (ver public/css/styles.css)
    private function plantillaRecuperacion($enlace)
    {
        return <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Recuperación de contraseña</title>
</head>
<body style="margin:0; padding:0; background-color:#EFE9DC; font-family: Arial, Helvetica, sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#EFE9DC; padding:32px 16px;">
  <tr>
    <td align="center">
      <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:480px; background-color:#F7F2E9; border-radius:12px; overflow:hidden; box-shadow:0 2px 10px rgba(16,49,43,0.15);">

        <tr>
          <td style="background-color:#10312B; padding:28px 32px; text-align:center;">
            <span style="color:#E8A33D; font-size:14px; letter-spacing:2px; text-transform:uppercase; font-weight:bold;">PawFinder</span>
            <h1 style="color:#F7F2E9; font-size:22px; margin:8px 0 0;">Recuperá tu contraseña</h1>
          </td>
        </tr>

        <tr>
          <td style="padding:32px;">
            <p style="color:#1A2420; font-size:15px; line-height:1.6; margin:0 0 16px;">
              Hola 👋
            </p>
            <p style="color:#1A2420; font-size:15px; line-height:1.6; margin:0 0 24px;">
              Recibimos una solicitud para restablecer la contraseña de tu cuenta en <strong>PawFinder</strong>.
              Hacé clic en el siguiente botón para crear una nueva contraseña:
            </p>

            <table role="presentation" cellpadding="0" cellspacing="0" style="margin:0 auto 24px;">
              <tr>
                <td align="center" style="border-radius:8px; background-color:#2E7D6B;">
                  <a href="{$enlace}" target="_blank"
                     style="display:inline-block; padding:14px 32px; font-size:15px; font-weight:bold; color:#ffffff; text-decoration:none; border-radius:8px;">
                    Restablecer contraseña
                  </a>
                </td>
              </tr>
            </table>

            <p style="color:#6E7D75; font-size:13px; line-height:1.6; margin:0 0 8px;">
              Si el botón no funciona, copiá y pegá este enlace en tu navegador:
            </p>
            <p style="font-size:13px; word-break:break-all; margin:0 0 24px;">
              <a href="{$enlace}" style="color:#2E7D6B;">{$enlace}</a>
            </p>

            <p style="color:#6E7D75; font-size:13px; line-height:1.6; margin:0;">
              Este enlace expira en <strong>1 hora</strong>. Si vos no solicitaste este cambio, podés ignorar este correo — tu contraseña seguirá siendo la misma.
            </p>
          </td>
        </tr>

        <tr>
          <td style="background-color:#10312B; padding:18px 32px; text-align:center;">
            <p style="color:rgba(247,242,233,0.7); font-size:12px; margin:0;">
              &copy; PawFinder &middot; Este es un correo automático, por favor no respondas a este mensaje.
            </p>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
</body>
</html>
HTML;
    }
}
