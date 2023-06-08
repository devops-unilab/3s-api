<?php



namespace app3s\util;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PhpMailer\Exception;

class Mail
{

    public function enviarEmail($destinatario, $nome, $assunto, $corpo)
    {

        $retorno = false;
        $mail = new PHPMailer();

        try{

            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAutoTLS = false;
            $mail->SMTPAuth = (env('MAIL_ENCRYPTION') == null) ? false : true;
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


            //TReste teste
            $retorno = $mail->Send();
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        } catch(Exception $e) {
            echo $e->errorMessage();
        }
        return $retorno;
    }
}
