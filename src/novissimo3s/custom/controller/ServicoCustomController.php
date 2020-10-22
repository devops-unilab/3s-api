<?php
            
/**
 * Customize o controller do objeto Servico aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\ServicoController;
use novissimo3s\custom\dao\ServicoCustomDAO;
use novissimo3s\custom\view\ServicoCustomView;

class ServicoCustomController  extends ServicoController {
    

	public function __construct(){
		$this->dao = new ServicoCustomDAO();
		$this->view = new ServicoCustomView();
	}


	        
}
?>