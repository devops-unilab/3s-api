<?php
            
/**
 * Customize o controller do objeto Usuario aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\UsuarioController;
use novissimo3s\custom\dao\UsuarioCustomDAO;
use novissimo3s\custom\view\UsuarioCustomView;

class UsuarioCustomController  extends UsuarioController {
    

	public function __construct(){
		$this->dao = new UsuarioCustomDAO();
		$this->view = new UsuarioCustomView();
	}


	        
}
?>