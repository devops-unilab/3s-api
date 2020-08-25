<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL);

function autoload($classe)
{
    if (file_exists('classes/dao/' . $classe . '.php')) {
        include_once 'classes/dao/' . $classe . '.php';
    } else if (file_exists('classes/model/' . $classe . '.php')) {
        include_once 'classes/model/' . $classe . '.php';
    } else if (file_exists('classes/controller/' . $classe . '.php')) {
        include_once 'classes/controller/' . $classe . '.php';
    } else if (file_exists('classes/util/' . $classe . '.php')) {
        include_once 'classes/util/' . $classe . '.php';
    } else if (file_exists('classes/view/' . $classe . '.php')) {
        include_once 'classes/view/' . $classe . '.php';
    }
}
spl_autoload_register('autoload');
if (!isset($_SESSION)){
    session_start();
}
if(!isset($_SESSION['perfil'])){
    echo "Acesso Negado, faça login no 3s. ";
    exit(0);
}
if($_SESSION['perfil'] != 'a' && $_SESSION['perfil'] != 't')
{
    echo "Acesso Negado, nivel:".$_SESSION['perfil'];
    exit(0);
}
if(isset($_GET['ajax'])){
    if($_GET['ajax'] == 'tabela'){
        $controller = new ChamadoController();
        $controller->tabelaChamados();
        exit(0);
    }else if($_GET['ajax'] == 'quadro'){
        $controller = new ChamadoController();
        $setor = null;
        $data1 = null;
        $data2 = null;
        
        if(isset($_GET['setor'])){
            $setor = $_GET['setor'];
        }
        if(isset($_GET['data1']) && isset($_GET['data2'])){
            $data1 = $_GET['data1'];
            $data2 = $_GET['data2'];
        }
        $controller->quadroKanban($setor, $data1, $data2);
        exit(0);
    }
   
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="img/favicon.ico" />

<title>3s</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->

<link rel="stylesheet" type="text/css" href="css/selectize.default.css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>3s de treinamento | Sistema de Solicitação de Serviços</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />


<link rel="stylesheet" href="css/stylesheet.css">
<link rel="stylesheet" href="css/bootstrap.min.css" >
</head>
<body>


<?php 

ChamadoController::main();

?>



<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/selectize.js"></script>
<script>

$('#select-setores').selectize({
    create: false,
    sortField: 'text'
});

$('#select-tabela').selectize({
    maxItems: 50
});



$("#select-tabela").change(function(){
	$("#hidden-tabela").val($("#select-tabela").val());
});
<?php 

if(isset($_GET['pagina'])){
    if($_GET['pagina'] == "tabela"){
        echo '
setInterval (function () {
	$.ajax({
		type: \'GET\',';
        
        $url = "index.php?ajax=tabela";
        if(isset($_GET['setores'])){
            $url .= '&setores='.$_GET['setores'];
            
        }
       
        echo '
            url: \''.$url.'\',';
        echo '
            success: function (response){$(\'#tabela-chamados\').html(response);
		}
	});
}, 2000);
            
';
        
        
    }else if($_GET['pagina'] == 'quadro'){
        echo '
setInterval (function () {
	$.ajax({
		type: \'GET\',';

		$url = "index.php?ajax=quadro";
		if(isset($_GET['setor'])){    
		    $url .= '&setor='.$_GET['setor'];
		    
		}
		if(isset($_GET['data1']) && isset($_GET['data2'])){

		    $url .= '&data1='.$_GET['data1'].'&data2='.$_GET['data2'];
		}
		
		echo 'url: \''.$url.'\',';
		echo '
		success: function (response){$(\'#quadro-kanban\').html(response);
		}
	});
}, 2000);

';
       
    }
}



?>
	
</script>



<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>