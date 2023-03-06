<?php
            
/**
 * Customize o controller do objeto AreaResponsavel aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\AreaResponsavelController;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\custom\view\AreaResponsavelCustomView;

class AreaResponsavelCustomController  extends AreaResponsavelController {
    

	public function __construct(){
		$this->dao = new AreaResponsavelCustomDAO();
		$this->view = new AreaResponsavelCustomView();
	}


	        
}
?>