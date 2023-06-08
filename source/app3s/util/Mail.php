<?php



namespace app3s\util;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PhpMailer\Exception;

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
                    "NULO MANUAL".'; MAIL_PASSWORD: '.
                    "Nulo Manual".'; MAIL_FROM_ADDRESS: '.
                    env('MAIL_FROM_ADDRESS').'; MAIL_FROM_NAME: '.
                    "MANUAL 3s - homo";
        $this->addLog($textLog);

        $retorno = false;
        $mail = new PHPMailer();

        try{

            $mail->IsSMTP();
            $mail->SMTPDebug = 0;
            $mail->SMTPAuth = true;
            $mail->Host = env('MAIL_HOST');
            $mail->Port =  env('MAIL_PORT');
            $mail->Username = "";
            $mail->Password = "";
            $mail->From = env('MAIL_FROM_ADDRESS');
            $mail->FromName = "3s - Homologacao";

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
