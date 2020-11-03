<?php
            
/**
 * Customize o controller do objeto Ocorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\OcorrenciaController;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\custom\view\OcorrenciaCustomView;

class OcorrenciaCustomController  extends OcorrenciaController {
    

	public function __construct(){
		$this->dao = new OcorrenciaCustomDAO();
		$this->view = new OcorrenciaCustomView();
	}


	        
}
?>