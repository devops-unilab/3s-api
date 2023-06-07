<?php



namespace app3s\util;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mail
{


    public function addLog($mensagem) {
        $path = './log.txt';
        $content = "Nova mensagem de LOG: \n";
        $content .= $mensagem."\n";

        if (!file_exists($path)) {
            touch($path);
        }
        $handle = fopen($path, 'a');
        fwrite($handle, $content);
        fclose($handle);
    }
    public function enviarEmail($destinatario, $nome, $assunto, $corpo)
    {

        $this->addLog("Tentar enviar e-mail");
        $textLog =  'MAIL_HOST: '.
                    env('MAIL_HOST').'; MAIL_PORT: '.
                    env('MAIL_PORT').'; MAIL_USERNAME: '.
                    env('MAIL_USERNAME').'; MAIL_PASSWORD: '.
                    env('MAIL_PASSWORD').'; MAIL_FROM_ADDRESS: '.
                    env('MAIL_FROM_ADDRESS').'; MAIL_FROM_NAME: '.
                    env('MAIL_FROM_NAME');
        $this->addLog($textLog);

        $retorno = false;
        $mail = new PHPMailer();

        try{

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

        } catch(Exception $e) {
            $this->addLog('Erro ao enviar o e-mail: ' . $mail->ErrorInfo);

        }

        return $retorno;
    }
}
