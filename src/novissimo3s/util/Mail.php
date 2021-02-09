<?php 



namespace novissimo3s\util;

use PHPMailer;

class Mail{
    
    public function __construct(){
        $config = parse_ini_file(EMAIL_CONFIG);
        define("HOST_MAIL", $config['host_mail']);
        define("PORT_MAIL", $config['port_mail']);
        define("USER_MAIL", $config['user_mail']);
        define("PASS_MAIL", $config['pass_mail']);
        
    }
    public function enviarEmail($destinatario, $nome, $assunto, $corpo)
    {
        $host_mail = HOST_MAIL;
        $port_mail = PORT_MAIL;
        $user_mail = USER_MAIL;
        $pass_mail = PASS_MAIL;
        $from_mail = "3s@noreply.unilab.edu.br";
        $fromname_mail = "3S/DTI/UNILAB";
        
        $mail = new PHPMailer();
        
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = false;
        // $mail->SMTPSecure = 'ssl';
        $mail->Host = $host_mail;
        $mail->Port = $port_mail;
        $mail->Username = $user_mail;
        $mail->Password = $pass_mail;
        $mail->From = $from_mail;
        $mail->FromName = $fromname_mail;
        
        $mail->AddAddress($destinatario, $nome);
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $assunto;
        $mail->Body = $corpo;
        // Define os anexos (opcional)
        // $mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf"); // Insere um anexo
        
        $mail->Send();
        
        // Limpa os destinatÃ¡rios e os anexos
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
    }
    
}


?>