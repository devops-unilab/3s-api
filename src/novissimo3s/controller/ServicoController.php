<?php
            
/**
 * Classe feita para manipulação do objeto ServicoController
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\controller;

use novissimo3s\dao\ServicoDAO;


use novissimo3s\dao\TipoAtividadeDAO;



use novissimo3s\dao\AreaResponsavelDAO;



use novissimo3s\dao\GrupoServicoDAO;



use novissimo3s\model\Servico;
use novissimo3s\view\ServicoView;


class ServicoController {

	protected  $view;
    protected $dao;

	public function __construct(){
		$this->dao = new ServicoDAO();
		$this->view = new ServicoView();
	}


    public function delete(){
	    if(!isset($_GET['delete'])){
	        return;
	    }
        $selected = new Servico();
	    $selected->setId($_GET['delete']);
        if(!isset($_POST['delete_servico'])){
            $this->view->confirmDelete($selected);
            return;
        }
        if($this->dao->delete($selected))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao excluir Servico
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar excluir Servico
</div>

';
		}
    	echo '<META HTTP-EQUIV="REFRESH" CONTENT="2; URL=index.php?page=servico">';
    }



	public function list() 
    {
		$list = $this->dao->fetch();
		$this->view->showList($list);
	}


	public function add() {
            
        if(!isset($_POST['enviar_servico'])){
            $tipoatividadeDao = new TipoAtividadeDAO($this->dao->getConnection());
            $listTipoAtividade = $tipoatividadeDao->fetch();

            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConnection());
            $listAreaResponsavel = $arearesponsavelDao->fetch();

            $gruposervicoDao = new GrupoServicoDAO($this->dao->getConnection());
            $listGrupoServico = $gruposervicoDao->fetch();

            $this->view->showInsertForm($listTipoAtividade, $listAreaResponsavel, $listGrupoServico);
		    return;
		}
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['tempo_sla'] ) && isset ( $_POST ['visao'] ) &&  isset($_POST ['tipo_atividade']) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['grupo_servico']))) {
			echo '
                <div class="alert alert-danger" role="alert">
                    Failed to register. Some field must be missing. 
                </div>

                ';
			return;
		}
            
		$servico = new Servico ();
		$servico->setNome ( $_POST ['nome'] );
		$servico->setDescricao ( $_POST ['descricao'] );
		$servico->setTempoSla ( $_POST ['tempo_sla'] );
		$servico->setVisao ( $_POST ['visao'] );
		$servico->getTipoAtividade()->setId ( $_POST ['tipo_atividade'] );
		$servico->getAreaResponsavel()->setId ( $_POST ['area_responsavel'] );
		$servico->getGrupoServico()->setId ( $_POST ['grupo_servico'] );
            
		if ($this->dao->insert ( $servico ))
        {
			echo '

<div class="alert alert-success" role="alert">
  Sucesso ao inserir Servico
</div>

';
		} else {
			echo '

<div class="alert alert-danger" role="alert">
  Falha ao tentar Inserir Servico
</div>

';
		}
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=servico">';
	}



            
	public function addAjax() {
            
        if(!isset($_POST['enviar_servico'])){
            return;    
        }
        
		    
		
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['tempo_sla'] ) && isset ( $_POST ['visao'] ) &&  isset($_POST ['tipo_atividade']) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['grupo_servico']))) {
			echo ':incompleto';
			return;
		}
            
		$servico = new Servico ();
		$servico->setNome ( $_POST ['nome'] );
		$servico->setDescricao ( $_POST ['descricao'] );
		$servico->setTempoSla ( $_POST ['tempo_sla'] );
		$servico->setVisao ( $_POST ['visao'] );
		$servico->getTipoAtividade()->setId ( $_POST ['tipo_atividade'] );
		$servico->getAreaResponsavel()->setId ( $_POST ['area_responsavel'] );
		$servico->getGrupoServico()->setId ( $_POST ['grupo_servico'] );
            
		if ($this->dao->insert ( $servico ))
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
        $selected = new Servico();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	        
        if(!isset($_POST['edit_servico'])){
            $tipoatividadeDao = new TipoAtividadeDAO($this->dao->getConnection());
            $listTipoAtividade = $tipoatividadeDao->fetch();

            $arearesponsavelDao = new AreaResponsavelDAO($this->dao->getConnection());
            $listAreaResponsavel = $arearesponsavelDao->fetch();

            $gruposervicoDao = new GrupoServicoDAO($this->dao->getConnection());
            $listGrupoServico = $gruposervicoDao->fetch();

            $this->view->showEditForm($listTipoAtividade, $listAreaResponsavel, $listGrupoServico, $selected);
            return;
        }
            
		if (! ( isset ( $_POST ['nome'] ) && isset ( $_POST ['descricao'] ) && isset ( $_POST ['tempo_sla'] ) && isset ( $_POST ['visao'] ) &&  isset($_POST ['tipo_atividade']) &&  isset($_POST ['area_responsavel']) &&  isset($_POST ['grupo_servico']))) {
			echo "Incompleto";
			return;
		}

		$selected->setNome ( $_POST ['nome'] );
		$selected->setDescricao ( $_POST ['descricao'] );
		$selected->setTempoSla ( $_POST ['tempo_sla'] );
		$selected->setVisao ( $_POST ['visao'] );
            
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
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="3; URL=index.php?page=servico">';
            
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
        $selected = new Servico();
	    $selected->setId($_GET['select']);
	        
        $this->dao->fillById($selected);
            
        echo '<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">';
	    $this->view->showSelected($selected);
        echo '</div>';
            

            
    }
}
?>