<?php
            
/**
 * Classe feita para manipulação do objeto TarefaOcorrenciaController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\TarefaOcorrenciaDAO;


use novissimo3s\dao\OcorrenciaDAO;



use novissimo3s\dao\UsuarioDAO;



use novissimo3s\model\TarefaOcorrencia;
use novissimo3s\view\TarefaOcorrenciaView;


class TarefaOcorrenciaController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new TarefaOcorrenciaDAO();
		$this->view = new TarefaOcorrenciaView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new TarefaOcorrencia();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_tarefa_ocorrencia'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Tarefa Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Tarefa Ocorrencia
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=tarefa_ocorrencia">';
    }



	public function list() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_tarefa_ocorrencia'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
            $listOcorrencia = $ocorrenciaDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showInsertForm($listOcorrencia, $listUsuario);
		    return;
		}
		if (! ( isset ( $_POST ['tarefa'] ) && isset ( $_POST ['data_inclusao'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
            
		$tarefaOcorrencia = new TarefaOcorrencia ();
		$tarefaOcorrencia->setTarefa ( $_POST ['tarefa'] );
		$tarefaOcorrencia->setDataInclusao ( $_POST ['data_inclusao'] );
		$tarefaOcorrencia->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$tarefaOcorrencia->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->insert ( $tarefaOcorrencia ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Tarefa Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Tarefa Ocorrencia
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=tarefa_ocorrencia">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_tarefa_ocorrencia'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['tarefa'] ) && isset ( $_POST ['data_inclusao'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo ':incompleto';
			return;
		}
            
		$tarefaOcorrencia = new TarefaOcorrencia ();
		$tarefaOcorrencia->setTarefa ( $_POST ['tarefa'] );
		$tarefaOcorrencia->setDataInclusao ( $_POST ['data_inclusao'] );
		$tarefaOcorrencia->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$tarefaOcorrencia->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->insert ( $tarefaOcorrencia ))
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
        $selected = new TarefaOcorrencia();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_tarefa_ocorrencia'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
            $listOcorrencia = $ocorrenciaDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showEditForm($listOcorrencia, $listUsuario, $selected);
            return;
        }
            
		if (! ( isset ( $_POST ['tarefa'] ) && isset ( $_POST ['data_inclusao'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

		$selected->setTarefa ( $_POST ['tarefa'] );
		$selected->setDataInclusao ( $_POST ['data_inclusao'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=tarefa_ocorrencia">';
            
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
        $selected = new TarefaOcorrencia();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>