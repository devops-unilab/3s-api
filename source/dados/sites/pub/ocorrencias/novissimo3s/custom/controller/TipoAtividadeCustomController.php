<?php
            
/**
 * Customize o controller do objeto TipoAtividade aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\TipoAtividadeController;
use novissimo3s\custom\dao\TipoAtividadeCustomDAO;
use novissimo3s\custom\view\TipoAtividadeCustomView;

class TipoAtividadeCustomController  extends TipoAtividadeController {
    

	public function __construct(){
		$this->dao = new TipoAtividadeCustomDAO();
		$this->view = new TipoAtividadeCustomView();
	}


	        
}
?>