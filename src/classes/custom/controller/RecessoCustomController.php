<?php
            
/**
 * Customize o controller do objeto Recesso aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class RecessoCustomController  extends RecessoController {
    

	public function __construct(){
		$this->dao = new RecessoCustomDAO();
		$this->view = new RecessoCustomView();
	}


	        
}
?>