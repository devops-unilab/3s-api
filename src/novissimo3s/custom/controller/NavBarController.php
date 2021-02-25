<?php 

namespace novissimo3s\custom\controller;
use novissimo3s\util\Sessao;

class NavBarController{
    
    
    public static function main(){
        $sessao = new Sessao();
        if($sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
            return;
        }
        
        echo '

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
        <a class="nav-link" href="?page=ocorrencia&cadastrar=1">Adicionar</a>
      </li>
';
        if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM || $sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
            echo '
                <!--
      <li class="nav-item">
        <a class="nav-link" href="?page=painel">Painel</a>
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

    -->



        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Paineis
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?page=painel_kamban">Kamban</a>
                <a class="dropdown-item" href="?page=painel_tabela">Tabela</a>
<!--              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> -->
            </div>
        </li>




';
        }
        if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
            echo '

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Gerenciamento
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="?page=servico">Serviços</a>
                
<!--              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a> -->
            </div>
        </li>

';
        }

        
        echo '
    </ul>';
        if($sessao->getNivelAcesso() != Sessao::NIVEL_COMUM){
            echo '
                <!--
    <form class="form-inline my-2 my-lg-0">
      <select class="form-control mr-sm-2">
      	<option>Administrador</option>
      	<option>Técnico</option>
      	<option selected>Comum</option>
      </select>
                
    </form>
    -->

';
        }
        
        
        echo '
    <a class="btn btn-outline-success my-2 my-sm-0" href="?sair=1">Sair</a>
  </div>
</nav>


';
    }
    
}

?>