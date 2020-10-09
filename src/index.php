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
            
    if (file_exists ( 'classes/dao/' . $classe . '.php' )){
		include_once 'classes/dao/' . $classe . '.php';
        return;
	}
	else if (file_exists ( 'classes/model/' . $classe . '.php' )){
		include_once 'classes/model/' . $classe . '.php';
        return;
	}
	else if (file_exists ( 'classes/controller/' . $classe . '.php' )){
		include_once 'classes/controller/' . $classe . '.php';
        return;
	}
	else if (file_exists ( 'classes/util/' . $classe . '.php' )){
		include_once 'classes/util/' . $classe . '.php';
        return;
	}
	else if (file_exists ( 'classes/view/' . $classe . '.php' )){
		include_once 'classes/view/' . $classe . '.php';
        return;
	}else if (file_exists ( 'classes/custom/controller/' . $classe . '.php' )){
		include_once 'classes/custom/controller/' . $classe . '.php';
        return;
	}
    else if (file_exists ( 'classes/custom/view/' . $classe . '.php' )){
		include_once 'classes/custom/view/' . $classe . '.php';
        return;
	}else if(file_exists ( 'classes/custom/dao/' . $classe . '.php' )){
		include_once 'classes/custom/dao/' . $classe . '.php';
        return;
	}

    $prefix = '3sDTI';
    $base_dir = __DIR__ . '/src/classes/';
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
if (isset($_GET["sair"])) {
    $sessao->mataSessao();
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=index.php">';
    
}

if(isset($_GET['ajax'])){
    switch ($_GET['ajax']){
        case 'ocorrencia':
            $controller = new OcorrenciaCustomController();
            $controller->mainAjax();
            break;
        default:
            echo '<p>Página solicitada não encontrada.</p>';
            break;
    }
    
    exit(0);
}
?>
            
<!doctype html>
<html lang="pt-br">
<head>
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<meta charset="utf-8">
<title>3s | Sistema de Solicitação de Ocorrências</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<link rel="stylesheet" type="text/css" href="css/selectize.default.css" />
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
	<!--     Barra do Governo -->
	<div id="barra-brasil"
		style="background: #7F7F7F; height: 20px; padding: 0 0 0 10px; display: block;">
		<ul id="menu-barra-temp" style="list-style: none;">
			<li
				style="display: inline; float: left; padding-right: 10px; margin-right: 10px; border-right: 1px solid #EDEDED">
				<a href="http://brasil.gov.br"
				style="font-family: sans, sans-serif; text-decoration: none; color: white;">Portal
					do Governo Brasileiro</a>
			</li>
		</ul>
	</div>
	<!--     Fim da Barra do Governo -->


 <div class="container">
  <header>
    <div class="row">
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12  d-flex justify-content-center">
        <a class="text-muted" href="#"><img src="img/logo-header.png" alt="Logo 3s" /></a>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex align-items-end  justify-content-center">
        <?php echo '<p class="blog-header-logo text-white font-weight-bold">'.$sessao->getNome().'</p>'; ?>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
        <a class="text-muted" href="#"><img src="img/logo-unilab-branco.png" alt="Logo Unilab" /></a>
      </div>
    </div>
  </header>

<?php 

NavBarController::main();

?>
  

  
</div>

<main role="main" class="container">



<?php

$principal = new Principal();
$principal->main();

?>
            

      

		


</main><!-- /.container -->

<footer class="blog-footer">
  <p>Desenvolvido pela Diretoria de Tecnologia da Informação &copy; DTI / Unilab<a href="https://dti.unilab.edu.br/"> dti.unilab.edu.br</a>.</p>
  <p>
    <a href="#">Voltar ao Topo</a>
  </p>
</footer>
            
            
            
<!-- Modal -->
<div class="modal fade" id="modalResposta" tabindex="-1" role="dialog" aria-labelledby="labelModalResposta" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelModalResposta">Resposta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <span id="textoModalResposta"></span>
      </div>
      <div class="modal-footer">
        <button type="button" id="botao-modal-resposta" class="btn btn-primary" data-dismiss="modal">Continuar</button>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/selectize.js"></script>
<script src="js/painel3s.js"></script>
<script src="js/ocorrencia.js"></script>
<script src="js/contador.js?12"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/barra_2.0.js"></script>
</body>
</html>