<?php
            
/**
 * Customize o controller do objeto Servico aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\ServicoController;
use novissimo3s\custom\dao\ServicoCustomDAO;
use novissimo3s\custom\view\ServicoCustomView;
use novissimo3s\model\Servico;
use novissimo3s\dao\TipoAtividadeDAO;
use novissimo3s\dao\AreaResponsavelDAO;
use novissimo3s\custom\dao\TipoAtividadeCustomDAO;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\custom\dao\GrupoServicoCustomDAO;

class ServicoCustomController  extends ServicoController {
    

	public function __construct(){
		$this->dao = new ServicoCustomDAO();
		$this->view = new ServicoCustomView();
	}

	
	public function main(){
	    echo '
	        
        <div class="card mb-4">
            <div class="card-body">

';

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
	    
	    echo '</div></div>';
	    
	    
	    
	    
	    
	}
	
	public function edit(){
	    if(!isset($_GET['edit'])){
	        return;
	    }
	    $selected = new Servico();
	    $selected->setId($_GET['edit']);
	    $this->dao->fillById($selected);
	    
	    if(!isset($_POST['edit_servico'])){
	        $tipoatividadeDao = new TipoAtividadeCustomDAO($this->dao->getConnection());
	        $listTipoAtividade = $tipoatividadeDao->fetch();
	        
	        $arearesponsavelDao = new AreaResponsavelCustomDAO($this->dao->getConnection());
	        $listAreaResponsavel = $arearesponsavelDao->fetch();
	        
	        $gruposervicoDao = new GrupoServicoCustomDAO($this->dao->getConnection());
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
	    $selected->getTipoAtividade()->setId($_POST['tipo_atividade']);
	    $selected->setTempoSla ( $_POST ['tempo_sla'] );
	    $selected->setVisao ( $_POST ['visao'] );
	    $selected->getAreaResponsavel()->setId($_POST['area_responsavel']);
	    $selected->getGrupoServico()->setId($_POST['grupo_servico']);
	    
	    
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
	
	
	public function fetch()
	{
	    $list = $this->dao->fetch();
	    $this->view->showList($list);
	}
	
	const VISAO_INATIVO = 0;
	const VISAO_COMUM = 1;
	const VISAO_TECNICO = 2;
	const VISAO_ADMIN = 3;
	
	/**
	 * 
	 * @param int $visao
	 * @return string
	 */
	public static function toStringVisao($visao){
	    $str = "Valor inválido";
	    switch($visao){
	        case self::VISAO_INATIVO:
	            $str = "Inativo";
	            break;
	        case self::VISAO_COMUM:
	            $str = "Comum";
	            break;
	        case self::VISAO_TECNICO:
	            $str = "Técnico";
	            break;
	        case self::VISAO_ADMIN:
	            $str = "Administrador";
	            break;
	        default:
	            $str = "Valor inválido";
	            break;
	    }
	    return $str;
	}
}
?>