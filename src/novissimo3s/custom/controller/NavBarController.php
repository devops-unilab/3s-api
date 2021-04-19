<?php 

namespace novissimo3s\custom\controller;
use novissimo3s\util\Sessao;
use novissimo3s\model\Usuario;

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
                <a class="dropdown-item" href="?page=painel_kamban">Kanban</a>
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


        
        $primeiroNome = $sessao->getNome();
        $arr = explode(" ", $sessao->getNome());
        if(isset($arr[0])){
            $primeiroNome = $arr[0];
        }
        
        $primeiroNome = ucfirst(strtolower($primeiroNome));
        
        echo '
        
        <form action="" method="get">

        <div class="input-group">
            <input type="hidden" name="page" value="ocorrencia">
          <input type="text" name="selecionar" class="form-control" placeholder="Número do chamado" aria-label="Número do Chamado" aria-describedby="button-addon2">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="form" id="button-addon2">
                <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        </form>

    <div class="btn-group">
        <button class="btn btn-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i> Olá, '.$primeiroNome.'
        </button>
        <div class="dropdown-menu dropright">
            <button type="button"  disabled  class="dropdown-item">
                Setor: '.$sessao->getUnidade().'
            </button>

            
            
            ';

            if($sessao->getNIvelOriginal() == Sessao::NIVEL_ADM)
            {
              $disabled = "";
              if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
                $disabled = "disabled";
              }
              echo '
              <hr>
              <button type="button" nivel="'.Sessao::NIVEL_ADM.'"  '.$disabled.' class="dropdown-item change-level">
                  Perfil Admin
              </button>
              ';
              $disabled = "";
              if($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
                $disabled = "disabled";
              }
              echo '
              <button type="button" nivel="'.Sessao::NIVEL_TECNICO.'"  id="change-to-tec" '.$disabled.' class="dropdown-item change-level">
                  Perfil Técnico
              </button>';
              $disabled = "";
              if($sessao->getNivelAcesso() == Sessao::NIVEL_COMUM){
                $disabled = "disabled";
              }
              echo '
              <button type="button" '.$disabled.'  nivel="'.Sessao::NIVEL_COMUM.'"  id="change-to-default"  class="dropdown-item change-level">
                  Perfil Comum
              </button>
              <hr>';

            }else if($sessao->getNIvelOriginal() == Sessao::NIVEL_TECNICO){
              $disabled = "";
              if($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
                $disabled = "disabled";
              }
              echo '
              <hr>
              <button type="button" id="change-to-tec" nivel="'.Sessao::NIVEL_TECNICO.'" '.$disabled.' class="dropdown-item change-level">
                  Perfil Técnico
              </button>';
              $disabled = "";
              if($sessao->getNivelAcesso() == Sessao::NIVEL_COMUM){
                $disabled = "disabled";
              }
              echo '
              <button type="button" '.$disabled.' nivel="'.Sessao::NIVEL_COMUM.'" id="change-to-default"  class="dropdown-item change-level">
                  Perfil Comum
              </button>
              <hr>';
            }
            

            echo '
            
            

            <a href="?sair=1" id="botao-avaliar" acao="avaliar"  class="dropdown-item">
                Sair
            </a>
    </div>
</div>

  </div>
</nav>


';
    }
    
}

?>