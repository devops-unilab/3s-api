<?php
            
/**
 * Classe feita para manipulação do objeto StatusOcorrenciaController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\StatusOcorrenciaDAO;


use novissimo3s\dao\OcorrenciaDAO;



use novissimo3s\dao\StatusDAO;



use novissimo3s\dao\UsuarioDAO;



use novissimo3s\model\StatusOcorrencia;
use novissimo3s\view\StatusOcorrenciaView;


class StatusOcorrenciaController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new StatusOcorrenciaDAO();
		$this->view = new StatusOcorrenciaView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new StatusOcorrencia();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_status_ocorrencia'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Status Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Status Ocorrencia
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=status_ocorrencia">';
    }



	public function fetch() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_status_ocorrencia'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
            $listOcorrencia = $ocorrenciaDao->fetch();

            $statusDao = new StatusDAO($this->dao->getConnection());
            $listStatus = $statusDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showInsertForm($listOcorrencia, $listStatus, $listUsuario);
		    return;
		}
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_mudanca'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['status']) &&  isset($_POST ['usuario']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		
        
		$statusOcorrencia = new StatusOcorrencia ();
		$statusOcorrencia->setMensagem ( $_POST ['mensagem'] );
		$statusOcorrencia->setDataMudanca ( $_POST ['data_mudanca'] );
		$statusOcorrencia->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$statusOcorrencia->getStatus()->setId ( $_POST ['status'] );
		$statusOcorrencia->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->insert ( $statusOcorrencia ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Status Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Status Ocorrencia
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=status_ocorrencia">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_status_ocorrencia'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_mudanca'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['status']) &&  isset($_POST ['usuario']))) {
			echo ':incompleto';
			return;
		}
            
		$statusOcorrencia = new StatusOcorrencia ();
		$statusOcorrencia->setMensagem ( $_POST ['mensagem'] );
		$statusOcorrencia->setDataMudanca ( $_POST ['data_mudanca'] );
		$statusOcorrencia->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$statusOcorrencia->getStatus()->setId ( $_POST ['status'] );
		$statusOcorrencia->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->insert ( $statusOcorrencia ))
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
        $selected = new StatusOcorrencia();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_status_ocorrencia'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
            $listOcorrencia = $ocorrenciaDao->fetch();

            $statusDao = new StatusDAO($this->dao->getConnection());
            $listStatus = $statusDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showEditForm($listOcorrencia, $listStatus, $listUsuario, $selected);
            return;
        }
            
		if (! ( isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_mudanca'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['status']) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

		$selected->setMensagem ( $_POST ['mensagem'] );
		$selected->setDataMudanca ( $_POST ['data_mudanca'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=status_ocorrencia">';
            
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
        $selected = new StatusOcorrencia();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>