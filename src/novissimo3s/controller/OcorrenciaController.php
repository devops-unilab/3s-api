<?php
            
/**
 * Classe feita para manipulação do objeto OcorrenciaController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\OcorrenciaDAO;


use novissimo3s\dao\AreaResponsavelDAO;



use novissimo3s\dao\ServicoDAO;



use novissimo3s\dao\UsuarioDAO;



use novissimo3s\model\Ocorrencia;
use novissimo3s\view\OcorrenciaView;


class OcorrenciaController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new OcorrenciaDAO();
		$this->view = new OcorrenciaView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new Ocorrencia();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_ocorrencia'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Ocorrencia
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=ocorrencia">';
    }



	public function fetch() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_ocorrencia'])){
            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConnection());
            $listAreaResponsavel = $arearesponsavelDao->fetch();

            $servicoDao = new ServicoDAO($this->dao->getConnection());
            $listServico = $servicoDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showInsertForm($listAreaResponsavel, $listServico, $listUsuario);
		    return;
		}
		if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['patrimonio'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['solucao'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['id_usuario_atendente'] ) && isset ( $_POST ['id_usuario_indicado'] ) && isset ( $_FILES ['anexo'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']) &&  isset($_POST ['usuario_cliente']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
		
        
		$ocorrencia = new Ocorrencia ();
		$ocorrencia->setIdLocal ( $_POST ['id_local'] );
		$ocorrencia->setDescricao ( $_POST ['descricao'] );
		$ocorrencia->setCampus ( $_POST ['campus'] );
		$ocorrencia->setPatrimonio ( $_POST ['patrimonio'] );
		$ocorrencia->setRamal ( $_POST ['ramal'] );
		$ocorrencia->setLocal ( $_POST ['local'] );
		$ocorrencia->setStatus ( $_POST ['status'] );
		$ocorrencia->setSolucao ( $_POST ['solucao'] );
		$ocorrencia->setPrioridade ( $_POST ['prioridade'] );
		$ocorrencia->setAvaliacao ( $_POST ['avaliacao'] );
		$ocorrencia->setEmail ( $_POST ['email'] );
		$ocorrencia->setIdUsuarioAtendente ( $_POST ['id_usuario_atendente'] );
		$ocorrencia->setIdUsuarioIndicado ( $_POST ['id_usuario_indicado'] );

		if(!file_exists('uploads/ocorrencia/anexo/')) {
		    mkdir('uploads/ocorrencia/anexo/', 0777, true);
		}

		if(!move_uploaded_file($_FILES['anexo']['tmp_name'], 'uploads/ocorrencia/anexo/'. $_FILES['anexo']['name']))
		{
		    echo '
                <div class="alert alert-danger" role="alert">
                    Failed to send file.
                </div>
		        
                ';
		    return;
		}
		
		$ocorrencia->setAnexo ( "uploads/ocorrencia/anexo/".$_FILES ['anexo']['name'] );
		$ocorrencia->setLocalSala ( $_POST ['local_sala'] );
		$ocorrencia->getAreaResponsavel()->setId ( $_POST ['area_responsavel'] );
		$ocorrencia->getServico()->setId ( $_POST ['servico'] );
		$ocorrencia->getUsuarioCliente()->setId ( $_POST ['usuario_cliente'] );
            
		if ($this->dao->insert ( $ocorrencia ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Ocorrencia
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Ocorrencia
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=ocorrencia">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_ocorrencia'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['patrimonio'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['solucao'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['id_usuario_atendente'] ) && isset ( $_POST ['id_usuario_indicado'] ) && isset ( $_FILES ['anexo'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']) &&  isset($_POST ['usuario_cliente']))) {
			echo ':incompleto';
			return;
		}
            
		$ocorrencia = new Ocorrencia ();
		$ocorrencia->setIdLocal ( $_POST ['id_local'] );
		$ocorrencia->setDescricao ( $_POST ['descricao'] );
		$ocorrencia->setCampus ( $_POST ['campus'] );
		$ocorrencia->setPatrimonio ( $_POST ['patrimonio'] );
		$ocorrencia->setRamal ( $_POST ['ramal'] );
		$ocorrencia->setLocal ( $_POST ['local'] );
		$ocorrencia->setStatus ( $_POST ['status'] );
		$ocorrencia->setSolucao ( $_POST ['solucao'] );
		$ocorrencia->setPrioridade ( $_POST ['prioridade'] );
		$ocorrencia->setAvaliacao ( $_POST ['avaliacao'] );
		$ocorrencia->setEmail ( $_POST ['email'] );
		$ocorrencia->setIdUsuarioAtendente ( $_POST ['id_usuario_atendente'] );
		$ocorrencia->setIdUsuarioIndicado ( $_POST ['id_usuario_indicado'] );
                    
		if(!file_exists('uploads/ocorrencia/anexo/')) {
		    mkdir('uploads/ocorrencia/anexo/', 0777, true);
		}
		        
		if(!move_uploaded_file($_FILES['anexo']['tmp_name'], 'uploads/ocorrencia/anexo/'. $_FILES['anexo']['name']))
		{
		    echo ':falha';
		    return;
		}
		    
		$ocorrencia->setAnexo ( "uploads/ocorrencia/anexo/".$_FILES ['anexo']['name'] );
		$ocorrencia->setLocalSala ( $_POST ['local_sala'] );
		$ocorrencia->getAreaResponsavel()->setId ( $_POST ['area_responsavel'] );
		$ocorrencia->getServico()->setId ( $_POST ['servico'] );
		$ocorrencia->getUsuarioCliente()->setId ( $_POST ['usuario_cliente'] );
            
		if ($this->dao->insert ( $ocorrencia ))
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
        $selected = new Ocorrencia();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_ocorrencia'])){
            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConnection());
            $listAreaResponsavel = $arearesponsavelDao->fetch();

            $servicoDao = new ServicoDAO($this->dao->getConnection());
            $listServico = $servicoDao->fetch();

            $usuarioDao = new UsuarioDAO($this->dao->getConnection());
            $listUsuario = $usuarioDao->fetch();

            $this->view->showEditForm($listAreaResponsavel, $listServico, $listUsuario, $selected);
            return;
        }
            
		if (! ( isset ( $_POST ['id_local'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['campus'] ) && isset ( $_POST ['patrimonio'] ) && isset ( $_POST ['ramal'] ) && isset ( $_POST ['local'] ) && isset ( $_POST ['status'] ) && isset ( $_POST ['solucao'] ) && isset ( $_POST ['prioridade'] ) && isset ( $_POST ['avaliacao'] ) && isset ( $_POST ['email'] ) && isset ( $_POST ['id_usuario_atendente'] ) && isset ( $_POST ['id_usuario_indicado'] ) && isset ( $_POST ['anexo'] ) && isset ( $_POST ['local_sala'] ) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['servico']) &&  isset($_POST ['usuario_cliente']))) {
			echo "Incompleto";
			return;
		}

		$selected->setIdLocal ( $_POST ['id_local'] );
		$selected->setDescricao ( $_POST ['descricao'] );
		$selected->setCampus ( $_POST ['campus'] );
		$selected->setPatrimonio ( $_POST ['patrimonio'] );
		$selected->setRamal ( $_POST ['ramal'] );
		$selected->setLocal ( $_POST ['local'] );
		$selected->setStatus ( $_POST ['status'] );
		$selected->setSolucao ( $_POST ['solucao'] );
		$selected->setPrioridade ( $_POST ['prioridade'] );
		$selected->setAvaliacao ( $_POST ['avaliacao'] );
		$selected->setEmail ( $_POST ['email'] );
		$selected->setIdUsuarioAtendente ( $_POST ['id_usuario_atendente'] );
		$selected->setIdUsuarioIndicado ( $_POST ['id_usuario_indicado'] );
		$selected->setAnexo ( $_POST ['anexo'] );
		$selected->setLocalSala ( $_POST ['local_sala'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=ocorrencia">';
            
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
        $selected = new Ocorrencia();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>