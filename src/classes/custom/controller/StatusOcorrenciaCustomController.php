<?php
            
/**
 * Customize o controller do objeto StatusOcorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class StatusOcorrenciaCustomController  extends StatusOcorrenciaController {
    

	public function __construct(){
		$this->dao = new StatusOcorrenciaCustomDAO();
		$this->view = new StatusOcorrenciaCustomView();
	}


	        
}
?>