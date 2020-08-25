<?php
            
/**
 * Customize o controller do objeto TipoAtividade aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */



class TipoAtividadeCustomController  extends TipoAtividadeController {
    

	public function __construct(){
		$this->dao = new TipoAtividadeCustomDAO();
		$this->view = new TipoAtividadeCustomView();
	}


	        
}
?>