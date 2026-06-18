<?php defined('BORDAMEX') || exit;

/**
 *=======================================================
 *  BORDAMEX Project
 *-------------------------------------------------------
 * @author Gilmer Franco <gil2017.com@gmail.com>
 *=======================================================
 *
 * @Description Este modelo incluye funciones variadas con utilización frecuente
 *
 * NOTA: ESTA CLASE NO ES UNICA; SE PARTICIONARÁ
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{

  /**
   * Envía un correo electrónico utilizando PHPMailer
   *
   * @param string $template
   * @param string $email
   * @param array  $params
   * @param string $subject
   * @param string $content
   * @return boolean
   */
  function sendEmail($template = 'normal', $email = NULL, $params = array(), $subject = null, $content = null)
  {
    global $config;

    // INCLUIR PLANTILLA
    require BG_INC . 'templates' . DS . 'mail' . DS . $template . '.mail.php';

    // Inicializa PHPMailer
    $mail = new PHPMailer(true);

    try
    {
      $resend = Resend::client($_ENV['RESEND_API_KEY']);

      $resend->emails->send([
        'from' => $_ENV['MAIL_NOREPLY'],
        'to' => $email,
        'subject' => $subject,
        'html' => $content
      ]);

      // Envía el correo
      return true;
    }
    catch (Exception $e)
    {
      // Manejo de errores
      error_log("No se pudo enviar el correo. Error: {$mail->ErrorInfo}");
      return false;
    }
  }
}
