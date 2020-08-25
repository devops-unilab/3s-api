<?php
            
/**
 * Customize o controller do objeto TarefaOcorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class TarefaOcorrenciaCustomController  extends TarefaOcorrenciaController {
    

	public function __construct(){
		$this->dao = new TarefaOcorrenciaCustomDAO();
		$this->view = new TarefaOcorrenciaCustomView();
	}


	        
}
?>