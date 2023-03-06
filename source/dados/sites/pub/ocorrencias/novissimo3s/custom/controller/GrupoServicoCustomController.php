<?php
            
/**
 * Customize o controller do objeto GrupoServico aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\GrupoServicoController;
use novissimo3s\custom\dao\GrupoServicoCustomDAO;
use novissimo3s\custom\view\GrupoServicoCustomView;

class GrupoServicoCustomController  extends GrupoServicoController {
    

	public function __construct(){
		$this->dao = new GrupoServicoCustomDAO();
		$this->view = new GrupoServicoCustomView();
	}


	        
}
?>