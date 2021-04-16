<?php 

namespace novissimo3s\custom\controller;


use novissimo3s\util\Sessao;

class MainIndex{
    
    public function main(){
        $sessao = new Sessao();
        if(isset($_GET['ajax'])){
            $mainAjax = new MainAjax();
            $mainAjax->main();
            exit(0);
        }
        if(isset($_REQUEST['api'])){
            $mainApi = new MainApi();
            $mainApi->main();
            exit(0);
        }
        if (isset($_GET["sair"])) {
            $sessao->mataSessao();
            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0; URL=index.php">';
        }
        
        $this->pagina();
    }

    public function pagina(){
        $sessao = new Sessao();
        echo '<!doctype html>
<html lang="pt-br">
<head>
<meta name="Cache-Control" content="no-cache">
<link rel="icon" type="image/x-icon" href="img/favicon.ico">
<meta charset="utf-8">
<title>3s | Sistema de Solicitação de Ocorrências</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="vendor/bootstrap-4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css?a=123" />
<link rel="stylesheet" type="text/css" href="css/style_kamban.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<link rel="stylesheet" type="text/css" href="css/chat.css" />
<link rel="stylesheet" type="text/css" href="css/selectize.default.css" />
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="css/style_form_login.css" rel="stylesheet">
<!-- Desenvolvido por Jefferson Uchôa Ponte-->
<style>

</style>
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


 <div id="cabecalho" class="container">
  <header>
    <div class="row d-flex justify-content-end">
        <div class="">
            <button class="btn btn-light m-4" href="#altocontraste" id="altocontraste" accesskey="3" onclick="window.toggleContrast()" onkeydown="window.toggleContrast()" class=" text-white ">
                <i class="fa fa-adjust"></i>
            </button>
        </div>
    </div>
    <div class="row">
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12  d-flex justify-content-center">
        <a class="text-muted" href="#"><img src="img/logo-header.png" alt="Logo 3s" /></a>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex align-items-end  justify-content-center">
         <p class="blog-header-logo text-white font-weight-bold"></p>
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
  <p>Desenvolvido pela <a href="https://dti.unilab.edu.br/"> Diretoria de Tecnologia da Informação DTI </a> / <a href="http://unilab.edu.br">Unilab</a></p>

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
</div>';
    $this->mainJS();
    
echo '



</body>
</html>

';
    }
    
    public function mainJS(){
        echo '
<script src="js/barra_2.0.js"></script>
<script src="js/jquery-3.5.1.min.js"></script>
<script src="vendor/popper.min.js"></script>
<script src="vendor/bootstrap-4.6.0//js/bootstrap.min.js"></script>
 
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="js/demo/datatables-demo.js"></script>
<script src="js/selectize.js"></script>
<script src="js/login_load.js"></script>
<script src="js/mudar_nivel.js?a=1"></script>
<script src="js/change-contraste.js?a=1"></script>
';
        $this->pageJS();
        
    }
    
    public function pageJS(){
        if(isset($_GET['page'])){
            switch ($_GET['page'])
            {
                case 'ocorrencia':
                    
                    echo '
<script src="js/status_ocorrencia.js"></script>
<script src="js/ocorrencia_selectize.js"></script>
<script src="js/jquery.easyPaginate.js?a=1"></script>
<script src="js/ocorrencia.js?a=1"></script>



<script src="js/status_ocorrencia.js"></script>';
                    if(isset($_GET['selecionar'])){
                        echo '
<script src="js/contador.js"></script>
<script src="js/mensagem_forum.js?a=14"></script>';
                    }
                    
                    break;
                case 'painel_kamban':
                    echo '
<script src="js/painel_kamban.js"></script>';
                    break;
                case 'painel_tabela':
                    echo '
<script src="js/painel_tabela.js"></script>';
                    break;
                default:
                    break;
            }
        }else{
            echo '
<script src="js/ocorrencia_selectize.js"></script>
<script src="js/jquery.easyPaginate.js?a=1"></script>
<script src="js/ocorrencia.js?a=1"></script>

';
            if(isset($_GET['selecionar'])){
                echo '
<script src="js/contador.js"></script>
<script src="js/mensagem_forum.js?a=14"></script>';
            }
            
        }
    }
    
    
}

?>