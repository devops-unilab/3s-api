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
        $this->view->formCancelar();
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
	    print_r($_POST);
	    echo "Vamos testar";
	    
	    
	}
	        
}
?>