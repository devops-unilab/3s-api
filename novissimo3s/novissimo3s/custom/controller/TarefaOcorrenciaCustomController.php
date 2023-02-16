<?php
            
/**
 * Customize o controller do objeto TarefaOcorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\TarefaOcorrenciaController;
use novissimo3s\custom\dao\TarefaOcorrenciaCustomDAO;
use novissimo3s\custom\view\TarefaOcorrenciaCustomView;

class TarefaOcorrenciaCustomController  extends TarefaOcorrenciaController {
    

	public function __construct(){
		$this->dao = new TarefaOcorrenciaCustomDAO();
		$this->view = new TarefaOcorrenciaCustomView();
	}


	        
}
?>