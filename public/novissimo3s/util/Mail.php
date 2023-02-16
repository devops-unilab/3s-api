<?php 



namespace novissimo3s\util;

use PHPMailer;

class Mail{
    private $host;
    private $port;
    private $user;
    private $pass;
    
    public function __construct(){
        $config = parse_ini_file(EMAIL_CONFIG);
        $this->host = $config['host_mail'];
        $this->port = $config['port_mail'];
        $this->user = $config['user_mail'];
        $this->pass =  $config['pass_mail'];
        
    }
    public function enviarEmail($destinatario, $nome, $assunto, $corpo)
    {
        $host_mail = $this->host;
        $port_mail = $this->port;
        $user_mail = $this->user;
        $pass_mail = $this->pass;
        $from_mail = "3s@noreply.unilab.edu.br";
        $fromname_mail = "3S/DTI/UNILAB";
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = false;
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
        
        $retorno = $mail->Send();
        $mail->ClearAllRecipients();
        $mail->ClearAttachments();
        return $retorno;
        
    }
    
}


?>