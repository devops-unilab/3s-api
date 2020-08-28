<?php

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

?>
            
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>3sDTI</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/list.css" />
<link rel="stylesheet" type="text/css" href="css/selectize.bootstrap3.css" />
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
.btn-circle.btn-lg {
  width: 50px;
  height: 50px;
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.33;
  border-radius: 25px;
}
.btn-circle.btn-xl {
  width: 70px;
  height: 70px;
  padding: 10px 16px;
  font-size: 24px;
  line-height: 1.33;
  border-radius: 35px;
}

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


 <div class="container">
  <header>
    <div class="row">
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12  d-flex justify-content-center">
        <a class="text-muted" href="#"><img src="img/logo-header.png" alt="Logo 3s" /></a>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex align-items-end  justify-content-center"">
        <a class="blog-header-logo text-dark" href="#">JEFFERSON UCHOA PONTE</a>
      </div>
      <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center">
        <a class="text-muted" href="#"><img src="img/logo-unilab-branco.png" alt="Logo Unilab" /></a>
      </div>
    </div>
  </header>

<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href=".">Início<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?pagina=ocorrencia&cadastrar=1">Adicionar</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Painel</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Relatórios
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configurações
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <select class="form-control mr-sm-2">
      	<option>Administrador</option>
      	<option>Técnico</option>
      	<option>Comum</option>
      </select>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Sair</button>
    </form>
  </div>
</nav>

  

  
</div>

<main role="main" class="container">



<?php
Principal::main();	    
?>
            

      

		


</main><!-- /.container -->

<footer class="blog-footer">
  <p>Desenvolvido pela Diretoria de Tecnologia da Informação &copy; DTI /
			Unilab<a href="https://dti.unilab.edu.br/"> dti.unilab.edu.br</a>.</p>
  <p>
    <a href="#">Voltar ao Topo</a>
  </p>
</footer>
            
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/selectize.js"></script>
<script>
$('#select-servicos').selectize({
    create: false,
    sortField: 'text'
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="js/barra_2.0.js"></script>
</body>
</html>