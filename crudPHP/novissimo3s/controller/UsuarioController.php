<?php
            
/**
 * Classe feita para manipulação do objeto UsuarioController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\UsuarioDAO;


use novissimo3s\model\Usuario;
use novissimo3s\view\UsuarioView;


class UsuarioController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new UsuarioDAO();
		$this->view = new UsuarioView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new Usuario();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_usuario'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Usuario
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Usuario
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=usuario">';
    }



	public function list() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_usuario'])){
            $this->view->showInsertForm();
		    return;
		}
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['login'] ) && isset ( $_POST ['senha'] ) && isset ( $_POST ['nivel'] ) && isset ( $_POST ['id_setor'] ))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		
        
		$usuario = new Usuario ();
		$usuario->setNome ( $_POST ['nome'] );
		$usuario->setEmail ( $_POST ['email'] );
		$usuario->setLogin ( $_POST ['login'] );
		$usuario->setSenha ( $_POST ['senha'] );
		$usuario->setNivel ( $_POST ['nivel'] );
		$usuario->setIdSetor ( $_POST ['id_setor'] );
            
		if ($this->dao->insert ( $usuario ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Usuario
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Usuario
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=usuario">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_usuario'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['login'] ) && isset ( $_POST ['senha'] ) && isset ( $_POST ['nivel'] ) && isset ( $_POST ['id_setor'] ))) {
			echo ':incompleto';
			return;
		}
            
		$usuario = new Usuario ();
		$usuario->setNome ( $_POST ['nome'] );
		$usuario->setEmail ( $_POST ['email'] );
		$usuario->setLogin ( $_POST ['login'] );
		$usuario->setSenha ( $_POST ['senha'] );
		$usuario->setNivel ( $_POST ['nivel'] );
		$usuario->setIdSetor ( $_POST ['id_setor'] );
            
		if ($this->dao->insert ( $usuario ))
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
        $selected = new Usuario();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_usuario'])){
            $this->view->showEditForm($selected);
            return;
        }
            
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['login'] ) && isset ( $_POST ['senha'] ) && isset ( $_POST ['nivel'] ) && isset ( $_POST ['id_setor'] ))) {
			echo "Incompleto";
			return;
		}

		$selected->setNome ( $_POST ['nome'] );
		$selected->setEmail ( $_POST ['email'] );
		$selected->setLogin ( $_POST ['login'] );
		$selected->setSenha ( $_POST ['senha'] );
		$selected->setNivel ( $_POST ['nivel'] );
		$selected->setIdSetor ( $_POST ['id_setor'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=usuario">';
            
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
        $selected = new Usuario();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>