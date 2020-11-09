<?php
            
/**
 * Classe feita para manipulação do objeto TipoAtividadeController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\TipoAtividadeDAO;


use novissimo3s\model\TipoAtividade;
use novissimo3s\view\TipoAtividadeView;


class TipoAtividadeController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new TipoAtividadeDAO();
		$this->view = new TipoAtividadeView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new TipoAtividade();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_tipo_atividade'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Tipo Atividade
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Tipo Atividade
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=tipo_atividade">';
    }



	public function list() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_tipo_atividade'])){
            $this->view->showInsertForm();
		    return;
		}
		if (! ( isset ( $_POST ['nome'] ))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		
        
		$tipoAtividade = new TipoAtividade ();
		$tipoAtividade->setNome ( $_POST ['nome'] );
            
		if ($this->dao->insert ( $tipoAtividade ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Tipo Atividade
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Tipo Atividade
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=tipo_atividade">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_tipo_atividade'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['nome'] ))) {
			echo ':incompleto';
			return;
		}
            
		$tipoAtividade = new TipoAtividade ();
		$tipoAtividade->setNome ( $_POST ['nome'] );
            
		if ($this->dao->insert ( $tipoAtividade ))
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
        $selected = new TipoAtividade();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_tipo_atividade'])){
            $this->view->showEditForm($selected);
            return;
        }
            
		if (! ( isset ( $_POST ['nome'] ))) {
			echo "Incompleto";
			return;
		}

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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=tipo_atividade">';
            
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
        $selected = new TipoAtividade();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>