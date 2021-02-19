<?php
            
/**
 * Customize o controller do objeto Servico aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\ServicoController;
use novissimo3s\custom\dao\ServicoCustomDAO;
use novissimo3s\custom\view\ServicoCustomView;

class ServicoCustomController  extends ServicoController {
    

	public function __construct(){
		$this->dao = new ServicoCustomDAO();
		$this->view = new ServicoCustomView();
	}

	
	public function main(){
	    echo '
	        
        <div class="card mb-4">
            <div class="card-body">';
	    if (isset($_GET['select'])){
	        echo '<div class="row">';
	        $this->select();
	        echo '</div>';
	        
	    }
	    echo '
		<div class="row">';
	    echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
	    
	    if(isset($_GET['edit'])){
	        $this->edit();
	    }else if(isset($_GET['delete'])){
	        $this->delete();
	    }else{
	        $this->add();
	    }
	    $this->fetch();
	    
	    echo '</div>';
	    echo '</div>';
	    
	    echo '</div></div>';
	    
	    
	    
	    
	    
	}
	        
}
?>