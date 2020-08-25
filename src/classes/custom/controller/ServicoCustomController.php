<?php
            
/**
 * Customize o controller do objeto Servico aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class ServicoCustomController  extends ServicoController {
    

	public function __construct(){
		$this->dao = new ServicoCustomDAO();
		$this->view = new ServicoCustomView();
	}


	        
}
?>