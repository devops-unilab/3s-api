<?php
            
/**
 * Customize o controller do objeto Status aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class StatusCustomController  extends StatusController {
    

	public function __construct(){
		$this->dao = new StatusCustomDAO();
		$this->view = new StatusCustomView();
	}


	        
}
?>