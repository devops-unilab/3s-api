<?php
            
/**
 * Classe feita para manipulação do objeto StatusController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\controller;
use app3s\dao\StatusDAO;
use app3s\model\Status;
use app3s\view\StatusView;


class StatusController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new StatusDAO();
		$this->view = new StatusView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new Status();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_status'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Status
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Status
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=?page=status">';
    }



	public function fetch() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_status'])){
            $this->view->showInsertForm();
		    return;
		}
		if (! ( isset ( $_POST ['sigla'] ) && isset ( $_POST ['nome'] ))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		$status = new Status ();
		$status->setSigla ( $_POST ['sigla'] );
		$status->setNome ( $_POST ['nome'] );
            
		if ($this->dao->insert ($status ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Status
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Status
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=status">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_status'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['sigla'] ) && isset ( $_POST ['nome'] ))) {
			echo ':incompleto';
			return;
		}
            
		$status = new Status ();
		$status->setSigla ( $_POST ['sigla'] );
		$status->setNome ( $_POST ['nome'] );
            
		if ($this->dao->insert ( $status ))
        {
			$id = $this->dao->getConnection()->lastInsertId();
            echo ':sucesso:'.$id;
            
		} else {
			 echo ':falha';
		}
	}
            
            

            
    public function edit(){
	    if(!isset($_GET['edit'])){
	        return;
	    }
        $selected = new Status();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_status'])){
            $this->view->showEditForm($selected);
            return;
        }
            
		if (! ( isset ( $_POST ['sigla'] ) && isset ( $_POST ['nome'] ))) {
			echo "Incompleto";
			return;
		}

		$selected->setSigla ( $_POST ['sigla'] );
		$selected->setNome ( $_POST ['nome'] );
            
		if ($this->dao->update ($selected ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso 
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha 
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=?page=status">';
            
    }
        

    public function main(){
        
        if (isset($_GET['select'])){
            echo '<div class="row">';
                $this->select();
            echo '</div>';
            return;
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
            
    }
    public function mainAjax(){

        $this->addAjax();
        
            
    }


            
    public function select(){
	    if(!isset($_GET['select'])){
	        return;
	    }
        $selected = new Status();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);

        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>