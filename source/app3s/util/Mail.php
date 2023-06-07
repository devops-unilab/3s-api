<?php



namespace app3s\util;

use PHPMailer\PHPMailer\PHPMailer;


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
            $mail->FromName = "3s-homologacao";

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
