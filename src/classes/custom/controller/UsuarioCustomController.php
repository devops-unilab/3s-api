<?php
            
/**
 * Customize o controller do objeto Usuario aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class UsuarioCustomController  extends UsuarioController {
    

	public function __construct(){
		$this->dao = new UsuarioCustomDAO();
		$this->view = new UsuarioCustomView();
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
	        $sessao->criaSessao($usuario->getId(), $usuario->getNivel(), $usuario->getLogin(), $usuario->getNome(), $usuario->getEmail(), "Teste", "teste");
	        
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
	        
<div class="card mb-4">
    <div class="card-body">';
	    $this->fazerLogin();
	    $this->view->formLogin();
	    echo '<br><br><br><br><br><br><br><br><br>
    </div>
</div>';
	}
	        
}
?>