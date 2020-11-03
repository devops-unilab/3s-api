<?php
            
define("DB_INI", "../novissimo3s_db.ini");
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
    if (file_exists($file)) {
        require $file;
    }

}
spl_autoload_register('autoload');

use novissimo3s\custom\controller\TarefaOcorrenciaCustomController;
use novissimo3s\custom\controller\AreaResponsavelCustomController;
use novissimo3s\custom\controller\GrupoServicoCustomController;
use novissimo3s\custom\controller\MensagemForumCustomController;
use novissimo3s\custom\controller\OcorrenciaCustomController;
use novissimo3s\custom\controller\RecessoCustomController;
use novissimo3s\custom\controller\ServicoCustomController;
use novissimo3s\custom\controller\StatusCustomController;
use novissimo3s\custom\controller\StatusOcorrenciaCustomController;
use novissimo3s\custom\controller\TipoAtividadeCustomController;
use novissimo3s\custom\controller\UsuarioCustomController;
if(isset($_GET['ajax'])){
    switch ($_GET['ajax']){
		case 'tarefa_ocorrencia':
            $controller = new TarefaOcorrenciaCustomController();
		    $controller->mainAjax();
			break;
		case 'area_responsavel':
            $controller = new AreaResponsavelCustomController();
		    $controller->mainAjax();
			break;
		case 'grupo_servico':
            $controller = new GrupoServicoCustomController();
		    $controller->mainAjax();
			break;
		case 'mensagem_forum':
            $controller = new MensagemForumCustomController();
		    $controller->mainAjax();
			break;
		case 'ocorrencia':
            $controller = new OcorrenciaCustomController();
		    $controller->mainAjax();
			break;
		case 'recesso':
            $controller = new RecessoCustomController();
		    $controller->mainAjax();
			break;
		case 'servico':
            $controller = new ServicoCustomController();
		    $controller->mainAjax();
			break;
		case 'status':
            $controller = new StatusCustomController();
		    $controller->mainAjax();
			break;
		case 'status_ocorrencia':
            $controller = new StatusOcorrenciaCustomController();
		    $controller->mainAjax();
			break;
		case 'tipo_atividade':
            $controller = new TipoAtividadeCustomController();
		    $controller->mainAjax();
			break;
		case 'usuario':
            $controller = new UsuarioCustomController();
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
<meta charset="utf-8">
<title>novissimo3s</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">novissimo3s</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav"><a class="nav-item nav-link" href="?page=tarefa_ocorrencia">Tarefa Ocorrencia</a><a class="nav-item nav-link" href="?page=area_responsavel">Area Responsavel</a><a class="nav-item nav-link" href="?page=grupo_servico">Grupo Servico</a><a class="nav-item nav-link" href="?page=mensagem_forum">Mensagem Forum</a><a class="nav-item nav-link" href="?page=ocorrencia">Ocorrencia</a><a class="nav-item nav-link" href="?page=recesso">Recesso</a><a class="nav-item nav-link" href="?page=servico">Servico</a><a class="nav-item nav-link" href="?page=status">Status</a><a class="nav-item nav-link" href="?page=status_ocorrencia">Status Ocorrencia</a><a class="nav-item nav-link" href="?page=tipo_atividade">Tipo Atividade</a><a class="nav-item nav-link" href="?page=usuario">Usuario</a>
            
    </div>
  </div>
</nav>
	<main role="main">
            
      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">novissimo3s</h1>
              
        </div>
      </section>
              
        <div class="album py-5 bg-light">
            <div class="container">
            
            
            
<?php
if(isset($_GET['page'])){
	switch ($_GET['page']){
    	case 'tarefa_ocorrencia':
            $controller = new TarefaOcorrenciaCustomController();
    	    $controller->main();
    		break;
    	case 'area_responsavel':
            $controller = new AreaResponsavelCustomController();
    	    $controller->main();
    		break;
    	case 'grupo_servico':
            $controller = new GrupoServicoCustomController();
    	    $controller->main();
    		break;
    	case 'mensagem_forum':
            $controller = new MensagemForumCustomController();
    	    $controller->main();
    		break;
    	case 'ocorrencia':
            $controller = new OcorrenciaCustomController();
    	    $controller->main();
    		break;
    	case 'recesso':
            $controller = new RecessoCustomController();
    	    $controller->main();
    		break;
    	case 'servico':
            $controller = new ServicoCustomController();
    	    $controller->main();
    		break;
    	case 'status':
            $controller = new StatusCustomController();
    	    $controller->main();
    		break;
    	case 'status_ocorrencia':
            $controller = new StatusOcorrenciaCustomController();
    	    $controller->main();
    		break;
    	case 'tipo_atividade':
            $controller = new TipoAtividadeCustomController();
    	    $controller->main();
    		break;
    	case 'usuario':
            $controller = new UsuarioCustomController();
    	    $controller->main();
    		break;
		default:
			echo '<p>Página solicitada não encontrada.</p>';
			break;
	}
}else{
    $controller = new UsuarioCustomController();
	$controller->main();
}
					    
?>
            
            
              </div>
            
            </div>
            
     </main>
            
            
    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Voltar ao topo</a>
        </p>
        <p>Este é um software desenvolvido automaticamente pelo escritor de Software.</p>
        <p>Novo no Escritor De Software? Acesse <a href="https://getcrudbyuml.com">GetCrudbyUml.com</a>.</p>
      </div>
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



        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="js/tarefa_ocorrencia.js" ></script>
        <script src="js/area_responsavel.js" ></script>
        <script src="js/grupo_servico.js" ></script>
        <script src="js/mensagem_forum.js" ></script>
        <script src="js/ocorrencia.js" ></script>
        <script src="js/recesso.js" ></script>
        <script src="js/servico.js" ></script>
        <script src="js/status.js" ></script>
        <script src="js/status_ocorrencia.js" ></script>
        <script src="js/tipo_atividade.js" ></script>
        <script src="js/usuario.js" ></script>
	</body>
</html>