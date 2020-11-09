<?php
            
/**
 * Classe feita para manipulação do objeto GrupoServicoController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\GrupoServicoDAO;


use novissimo3s\model\GrupoServico;
use novissimo3s\view\GrupoServicoView;


class GrupoServicoController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new GrupoServicoDAO();
		$this->view = new GrupoServicoView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new GrupoServico();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_grupo_servico'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Grupo Servico
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Grupo Servico
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=grupo_servico">';
    }



	public function list() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_grupo_servico'])){
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
		
        
		$grupoServico = new GrupoServico ();
		$grupoServico->setNome ( $_POST ['nome'] );
            
		if ($this->dao->insert ( $grupoServico ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Grupo Servico
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Grupo Servico
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=grupo_servico">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_grupo_servico'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['nome'] ))) {
			echo ':incompleto';
			return;
		}
            
		$grupoServico = new GrupoServico ();
		$grupoServico->setNome ( $_POST ['nome'] );
            
		if ($this->dao->insert ( $grupoServico ))
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
        $selected = new GrupoServico();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_grupo_servico'])){
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=grupo_servico">';
            
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
        $selected = new GrupoServico();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>