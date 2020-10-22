<?php
            
/**
 * Customize o controller do objeto AreaResponsavel aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class AreaResponsavelCustomController  extends AreaResponsavelController {
    

	public function __construct(){
		$this->dao = new AreaResponsavelCustomDAO();
		$this->view = new AreaResponsavelCustomView();
	}


	        
}
?>