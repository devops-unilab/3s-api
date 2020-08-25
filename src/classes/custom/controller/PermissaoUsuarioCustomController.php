<?php
            
/**
 * Customize o controller do objeto PermissaoUsuario aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class PermissaoUsuarioCustomController  extends PermissaoUsuarioController {
    

	public function __construct(){
		$this->dao = new PermissaoUsuarioCustomDAO();
		$this->view = new PermissaoUsuarioCustomView();
	}


	        
}
?>