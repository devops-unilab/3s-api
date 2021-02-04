<?php
            
/**
 * Customize o controller do objeto StatusOcorrencia aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\StatusOcorrenciaController;
use novissimo3s\custom\dao\StatusOcorrenciaCustomDAO;
use novissimo3s\custom\view\StatusOcorrenciaCustomView;
use novissimo3s\model\Ocorrencia;
use novissimo3s\util\Sessao;
use novissimo3s\custom\view\OcorrenciaCustomView;
use novissimo3s\dao\OcorrenciaDAO;
use novissimo3s\model\StatusOcorrencia;
use novissimo3s\model\Status;
use novissimo3s\dao\StatusDAO;

class StatusOcorrenciaCustomController  extends StatusOcorrenciaController {
    

	public function __construct(){
		$this->dao = new StatusOcorrenciaCustomDAO();
		$this->view = new StatusOcorrenciaCustomView();
	}

	
	private $ocorrencia;
	private $sessao;
	
	
	const STATUS_ABERTO = 'a';
	const STATUS_RESERVADO = 'b';
	const STATUS_EM_ESPERA = 'c';
	const STATUS_AGUARDANDO_USUARIO = 'd';
	const STATUS_ATENDIMENTO = 'e';
	const STATUS_FECHADO = 'f';
	const STATUS_FECHADO_CONFIRMADO = 'g';
	const STATUS_CANCELADO = 'h';
	const STATUS_AGUARDANDO_ATIVO = 'i';
	const STATUS_REABERTO = 'r';
	
	
	public function avaliar(){
	    //Só permitir isso se o usuário for cliente do chamado
	    //O chamado deve estar fechado.
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getUsuarioCliente()->getId()){
	        return;
	    }
	    if($this->ocorrencia->getStatus() != self::STATUS_FECHADO){
	        return;
	    }
	    echo 'Avaliar ocorrência';
	    
	}
	
	public function atender(){
	    //So permitir isso se o usuário for técnico ou administrador
	}
	public function fechar(){
	    
	}
	public function reservar(){
	    //Só permitir isso se o usuário for administrador
	    
	}
	
	
	public function cancelar(){
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getUsuarioCliente()->getId()){
	        return;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_FECHADO){
	        return;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_FECHADO_CONFIRMADO){
	        return;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_REABERTO){
	        return;
	    }
        $this->view->formCancelar($this->ocorrencia);
	}
	
	
	public function ajaxCancelar(){
	    if(!isset($_POST['status_acao'])){
	        return;
	    }
	    if($_POST['status_acao'] != 'cancelar'){
	        return;
	    }
	    if(!isset($_POST['id_ocorrencia'])){
	        return;
	    }
	    //Proceda ao cancelar.
	    
	    $this->sessao = new Sessao();
	    $this->ocorrencia = new Ocorrencia();
	    $this->ocorrencia->setId($_POST['id_ocorrencia']);
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $ocorrenciaDao->fillById($this->ocorrencia);
	    
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getUsuarioCliente()->getId()){
	        return;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_FECHADO){
	        return;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_FECHADO_CONFIRMADO){
	        return;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_REABERTO){
	        return;
	    }
	    $this->ocorrencia->setStatus(self::STATUS_CANCELADO);
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return;
	    }

	    $status = new Status();
	    $status->setSigla(self::STATUS_CANCELADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $statusOcorrencia = new StatusOcorrencia();
	    $statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $statusOcorrencia->setStatus($status);
	    $statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $statusOcorrencia->setMensagem("Ocorrência cancelada pelo usuário");
	    
	    if(!$this->dao->insert($statusOcorrencia)){
	        echo ':falha:';
	        return;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Chamado cancelado com sucesso!';
	    
	}
	public function painelStatus(Ocorrencia $ocorrencia){
	    $this->ocorrencia = $ocorrencia;
	    $this->sessao = new Sessao();
	    $ocorrenciaView = new OcorrenciaCustomView();
	    $strStatus = $ocorrenciaView->getStrStatus($ocorrencia->getStatus());
	    echo '
<div class="card">
    <div class="card-body">
    <div class="alert alert-danger" role="alert">
      Status '.$strStatus.'
    </div>';
	    
	    $this->avaliar();
	    $this->cancelar();
	    $this->reservar();
	    $this->atender();
	    $this->fechar();
	    echo '
  </div>
</div>
	        
	        
	        
	        
	        
';
	}
	public function mainAjax(){
	    //Verifica-se qual o form que foi submetido. 
	    if(!isset($_POST['status_acao'])){
	        return;
	    }
	    switch($_POST['status_acao']){
	        case 'cancelar':
	            $this->ajaxCancelar();
	            break;
	        default:
	            echo ':falha';
	            break;
	    }
	}
	        
}
?>