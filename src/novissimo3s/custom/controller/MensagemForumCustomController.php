<?php
            
/**
 * Customize o controller do objeto MensagemForum aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\MensagemForumController;
use novissimo3s\custom\dao\MensagemForumCustomDAO;
use novissimo3s\custom\view\MensagemForumCustomView;

class MensagemForumCustomController  extends MensagemForumController {
    

	public function __construct(){
		$this->dao = new MensagemForumCustomDAO();
		$this->view = new MensagemForumCustomView();
	}


	        
}
?>