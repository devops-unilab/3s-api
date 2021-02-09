<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

date_default_timezone_set('America/Fortaleza');
setlocale(LC_ALL, 'pt_BR');
define("DB_INI", "../../../3s/3s_bd.ini");
define("DB_AUTENTICACAO", "../../../3s/3s_autenticacao_bd.ini");
define("EMAIL_CONFIG", "../../../3s/3s_email.ini");

function autoload($classe) {
    
    
    if($classe == "PHPMailer"){
        include_once "PHPMailer/PHPMailer.class.php";
        return;   
    }
    $prefix = 'novissimo3s';
    $base_dir = 'novissimo3s';
    $len = strlen($prefix);
    if (strncmp($prefix, $classe, $len) !== 0) {
        return;
    }
    $relative_class = substr($classe, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
}

spl_autoload_register('autoload');

use novissimo3s\custom\controller\MainIndex;
use novissimo3s\util\Mail;

$main = new MainIndex();
$main->main();


// $mail = new Mail();
// $mail->enviarEmail("jefponte@gmail.com", "Jefferson Uchoa Ponte", "Teste com autoload", "Terceiro teste.");


?>