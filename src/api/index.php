<?php
            
use novissimo3s\controller\MensagemForumApiRestController;

define("DB_INI", "../../../../3s/3s_bd.ini");
define("API_INI", "../novissimo3s_api_rest.ini");
             
function autoload($classe) {

    $prefix = 'novissimo3s';
    $base_dir = 'novissimo3s';
    $len = strlen($prefix);
    if (strncmp($prefix, $classe, $len) !== 0) {
        return;
    }
    $relative_class = substr($classe, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists('../'.$file)) {
        require '../'.$file;
    }

}
spl_autoload_register('autoload');


$controller = new MensagemForumApiRestController();
$controller->main();
              
       
?>
      
            
