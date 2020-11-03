<?php
            
/**
 * Customize o controller do objeto Status aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\StatusController;
use novissimo3s\custom\dao\StatusCustomDAO;
use novissimo3s\custom\view\StatusCustomView;

class StatusCustomController  extends StatusController {
    

	public function __construct(){
		$this->dao = new StatusCustomDAO();
		$this->view = new StatusCustomView();
	}


	        
}
?>