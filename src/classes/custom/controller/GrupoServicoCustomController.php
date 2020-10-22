<?php
            
/**
 * Customize o controller do objeto GrupoServico aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class GrupoServicoCustomController  extends GrupoServicoController {
    

	public function __construct(){
		$this->dao = new GrupoServicoCustomDAO();
		$this->view = new GrupoServicoCustomView();
	}


	        
}
?>