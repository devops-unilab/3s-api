<?php
            
/**
 * Customize o controller do objeto Usuario aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\UsuarioController;
use novissimo3s\custom\dao\UsuarioCustomDAO;
use novissimo3s\custom\view\UsuarioCustomView;
use novissimo3s\util\Sessao;
use novissimo3s\model\Usuario;

class UsuarioCustomController  extends UsuarioController {
    

	public function __construct(){
		$this->dao = new UsuarioCustomDAO();
		$this->view = new UsuarioCustomView();
	}
	
	public function mudarNivel(){
		print_r($_POST);
		$sessao = new Sessao();
		if($sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
			$sessao->setNivelDeAcesso($_POST['nivel']);
			echo ':sucess:';
			return;
		}
		if($sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
			if(intval($_POST['nivel']) == Sessao::NIVEL_COMUM){
				$sessao->setNivelDeAcesso($_POST['nivel']);
			}
			echo ':sucess:';
			return;
		}
		echo ':falha:';
	}
	public function ajaxLogin(){
	    if (!isset($_POST['logar'])) {
	        return ":falha";
	    }
	    $usuario = new Usuario();
	    $usuario->setLogin($_POST['usuario']);
	    $usuario->setSenha(md5($_POST['senha']));
	    
	    if ($this->dao->autenticar($usuario)) {
	        
	        $sessao = new Sessao();
	        $sessao->criaSessao($usuario->getId(), $usuario->getNivel(), $usuario->getLogin(), $usuario->getNome(), $usuario->getEmail());
	        
	        $idUnidade = $this->dao->getIdUnidade($usuario);
	        if(count($idUnidade) > 0){
	            foreach($idUnidade as $id => $sigla){
	                $sessao->setIDUnidade($id);
	                $sessao->setUnidade($sigla );
	            }
	        }
	        
	        
	        echo ":sucesso";
	    }else{
	        echo ":falha";
	    }
	}
	public function fazerLogin(){
	    if (!isset($_POST['logar'])) {
	        return;
	    }
	    
	    $usuario = new Usuario();
	    $usuario->setLogin($_POST['usuario']);
	    $usuario->setSenha(md5($_POST['senha']));
	    
	    if ($this->dao->autenticar($usuario)) {
	        
	        $sessao = new Sessao();
	        $sessao->criaSessao($usuario->getId(), $usuario->getNivel(), $usuario->getLogin(), $usuario->getNome(), $usuario->getEmail());
	        
	        echo '
<div class="alert alert-success" role="alert">
  Login realizado com Sucesso
</div>
';
	        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php">';
	    } else {
	        echo '
<div class="alert alert-danger" role="alert">
  Você errou a senha! Tente novamente!
</div>
	            
';
	    }
	}
	public function telaLogin(){
	    echo '
<div class="container">
    <div class="row">
        <div class="card mb-4">
            <div class="card-body">';
	    $this->fazerLogin();
	    $this->view->formLogin();
	    echo '
            </div>
        </div>

    </div>
</div>
';
	}

	        
}
?>