<?php 

use novissimo3s\dao\DAO;
use SimplesAdminPG\AdminPG;
use novissimo3s\util\Sessao;
include_once "SimplesAdminPG/AdminPG.php";
define("DB_AUTENTICACAO", "../../../3s/3s_autenticacao_bd.ini");
define("DB_INI", "../../../3s/3s_bd.ini");
function autoload($classe) {
    
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

$sessao = new Sessao();
if($sessao->getLoginUsuario() == 'jefponte'){
    if(isset($_GET['tipo'])){
        $dao = new DAO(null, DB_AUTENTICACAO);
    }else{
        $dao = new DAO();
    }
    $conexao = $dao->getConnection();
    AdminPG::main($conexao);
    
}

?>