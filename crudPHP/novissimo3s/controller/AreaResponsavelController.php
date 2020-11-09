<?php
            
/**
 * Classe feita para manipulação do objeto AreaResponsavelController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\AreaResponsavelDAO;


use novissimo3s\model\AreaResponsavel;
use novissimo3s\view\AreaResponsavelView;


class AreaResponsavelController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new AreaResponsavelDAO();
		$this->view = new AreaResponsavelView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new AreaResponsavel();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_area_responsavel'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Area Responsavel
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Area Responsavel
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=area_responsavel">';
    }



	public function list() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_area_responsavel'])){
            $this->view->showInsertForm();
		    return;
		}
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['email'] ))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		
        
		$areaResponsavel = new AreaResponsavel ();
		$areaResponsavel->setNome ( $_POST ['nome'] );
		$areaResponsavel->setDescricao ( $_POST ['descricao'] );
		$areaResponsavel->setEmail ( $_POST ['email'] );
            
		if ($this->dao->insert ( $areaResponsavel ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Area Responsavel
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Area Responsavel
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=area_responsavel">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_area_responsavel'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['email'] ))) {
			echo ':incompleto';
			return;
		}
            
		$areaResponsavel = new AreaResponsavel ();
		$areaResponsavel->setNome ( $_POST ['nome'] );
		$areaResponsavel->setDescricao ( $_POST ['descricao'] );
		$areaResponsavel->setEmail ( $_POST ['email'] );
            
		if ($this->dao->insert ( $areaResponsavel ))
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
        $selected = new AreaResponsavel();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_area_responsavel'])){
            $this->view->showEditForm($selected);
            return;
        }
            
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['email'] ))) {
			echo "Incompleto";
			return;
		}

		$selected->setNome ( $_POST ['nome'] );
		$selected->setDescricao ( $_POST ['descricao'] );
		$selected->setEmail ( $_POST ['email'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=area_responsavel">';
            
    }
        

    public function main(){
        
        if (isset($_GET['select'])){
            echo '<div class="row justify-content-center">';
                $this->select();
            echo '</div>';
            return;
        }
        echo '
		<div class="row justify-content-center">';
        echo '<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">';
        
        if(isset($_GET['edit'])){
            $this->edit();
        }else if(isset($_GET['delete'])){
            $this->delete();
	    }else{
            $this->add();
        }
        $this->list();
        
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
        $selected = new AreaResponsavel();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>