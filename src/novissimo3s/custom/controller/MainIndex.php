<?php 

namespace novissimo3s\custom\controller;


use novissimo3s\util\Sessao;

class MainIndex{
    
    public function main(){
        $sessao = new Sessao();
        if (isset($_GET["sair"])) {
            $sessao->mataSessao();
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=index.php">';
            
        }
        if(isset($_GET['ajax'])){
            $mainAjax = new MainAjax();
            $mainAjax->main();
            exit(0);
        }
        $this->pagina();
    }

    public function pagina(){
        $sessao = new Sessao();
        echo '

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
         <p class="blog-header-logo text-white font-weight-bold">'.$sessao->getNome().'</p>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
        <a class="text-muted" href="#"><img src="img/logo-unilab-branco.png" alt="Logo Unilab" /></a>
      </div>
    </div>
  </header>';
        
NavBarController::main();

echo '  

  
</div>

<main role="main" class="container">

';


$principal = new MainContent();
$principal->main();

echo '

</main><!-- /.container -->

<footer class="blog-footer">
  <p>Desenvolvido pela Diretoria de Tecnologia da Informação &copy; DTI / Unilab<a href="https://dti.unilab.edu.br/"> dti.unilab.edu.br</a>.</p>
  <p>
    <a href="http://unilab.edu.br">unilab.edu.br</a>
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

<script src="js/barra_2.0.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/selectize.js"></script>
<script src="js/painel3s.js"></script>
<script src="js/ocorrencia.js"></script>
<script src="js/status_ocorrencia.js"></script>
<script src="js/mensagem_forum.js"></script>
<script src="js/ocorrencia_selectize.js"></script>
<script src="js/contador.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>

';
    }
}

?>