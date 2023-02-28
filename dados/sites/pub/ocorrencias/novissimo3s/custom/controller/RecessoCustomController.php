<?php
            
/**
 * Customize o controller do objeto Recesso aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\RecessoController;
use novissimo3s\custom\dao\RecessoCustomDAO;
use novissimo3s\custom\view\RecessoCustomView;

class RecessoCustomController  extends RecessoController {
    

	public function __construct(){
		$this->dao = new RecessoCustomDAO();
		$this->view = new RecessoCustomView();
	}


	        
}
?>