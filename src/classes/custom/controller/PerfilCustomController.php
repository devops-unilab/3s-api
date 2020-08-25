<?php
            
/**
 * Customize o controller do objeto Perfil aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class PerfilCustomController  extends PerfilController {
    

	public function __construct(){
		$this->dao = new PerfilCustomDAO();
		$this->view = new PerfilCustomView();
	}


	        
}
?>