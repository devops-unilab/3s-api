<?php
            
/**
 * Classe feita para manipulação do objeto MensagemForumController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;
use novissimo3s\dao\MensagemForumDAO;
use novissimo3s\dao\OcorrenciaDAO;
use novissimo3s\dao\UsuarioDAO;
use novissimo3s\model\MensagemForum;
use novissimo3s\view\MensagemForumView;


class MensagemForumController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new MensagemForumDAO();
		$this->view = new MensagemForumView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new MensagemForum();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_mensagem_forum'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Mensagem Forum
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Mensagem Forum
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=mensagem_forum">';
    }



	public function fetch() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_mensagem_forum'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
            $listOcorrencia = $ocorrenciaDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showInsertForm($listOcorrencia, $listUsuario);
		    return;
		}
		if (! ( isset ( $_POST ['tipo'] ) && isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_envio'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		$mensagemForum = new MensagemForum ();
		$mensagemForum->setTipo ( $_POST ['tipo'] );
		$mensagemForum->setMensagem ( $_POST ['mensagem'] );
		$mensagemForum->setDataEnvio ( $_POST ['data_envio'] );
		$mensagemForum->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$mensagemForum->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->insert ($mensagemForum ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Mensagem Forum
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Mensagem Forum
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=mensagem_forum">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_mensagem_forum'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['tipo'] ) && isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_envio'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo ':incompleto';
			return;
		}
            
		$mensagemForum = new MensagemForum ();
		$mensagemForum->setTipo ( $_POST ['tipo'] );
		$mensagemForum->setMensagem ( $_POST ['mensagem'] );
		$mensagemForum->setDataEnvio ( $_POST ['data_envio'] );
		$mensagemForum->getOcorrencia()->setId ( $_POST ['ocorrencia'] );
		$mensagemForum->getUsuario()->setId ( $_POST ['usuario'] );
            
		if ($this->dao->insert ( $mensagemForum ))
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
        $selected = new MensagemForum();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_mensagem_forum'])){
            $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
            $listOcorrencia = $ocorrenciaDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showEditForm($listOcorrencia, $listUsuario, $selected);
            return;
        }
            
		if (! ( isset ( $_POST ['tipo'] ) && isset ( $_POST ['mensagem'] ) && isset ( $_POST ['data_envio'] ) &&  isset($_POST ['ocorrencia']) &&  isset($_POST ['usuario']))) {
			echo "Incompleto";
			return;
		}

		$selected->setTipo ( $_POST ['tipo'] );
		$selected->setMensagem ( $_POST ['mensagem'] );
		$selected->setDataEnvio ( $_POST ['data_envio'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=mensagem_forum">';
            
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
        $selected = new MensagemForum();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);

        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>