<?php



namespace app3s\util;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail
{

    public function enviarEmail($destinatario, $nome, $assunto, $corpo)
    {

        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Host = env('MAIL_HOST');
        $mail->Port =  env('MAIL_PORT');
        $mail->Username = env('MAIL_USERNAME');
        $mail->Password = env('MAIL_PASSWORD');
        $mail->From = env('MAIL_FROM_ADDRESS');
        $mail->FromName = env('MAIL_FROM_NAME');

        $mail->AddAddress($destinatario, $nome);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $assunto;
        $mail->Body = $corpo;

        $retorno = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        return $retorno;
    }
}
