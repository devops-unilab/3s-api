<?php
            
/**
 * Customize o controller do objeto Status aqui 
 * @author Jefferson Uchôa Ponte <jefponte@gmail.com>
 */

namespace novissimo3s\custom\controller;
use novissimo3s\controller\StatusController;
use novissimo3s\custom\dao\StatusCustomDAO;
use novissimo3s\custom\view\StatusCustomView;
use novissimo3s\model\Ocorrencia;
use novissimo3s\util\Sessao;

class StatusCustomController  extends StatusController {
    

	public function __construct(){
		$this->dao = new StatusCustomDAO();
		$this->view = new StatusCustomView();
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
	    if($this->sessao->getIdUsuario() != $this->selecionado->getUsuarioCliente()->getId()){
	        return;
	    }
	    if($this->selecionado->getStatus() == self::STATUS_FECHADO){
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
	    if($this->sessao->getIdUsuario() != $this->selecionado->getUsuarioCliente()->getId()){
	        return;
	    }
	    if($this->selecionado->getStatus() == self::STATUS_FECHADO){
	        return;
	    }
	    if($this->selecionado->getStatus() == self::STATUS_FECHADO_CONFIRMADO){
	        return;
	    }
	    if($this->selecionado->getStatus() == self::STATUS_REABERTO){
	        return;
	    }
	    echo '
<!-- Modal -->
<div class="modal fade" id="modalCancelar" tabindex="-1" aria-labelledby="labelModalCancelar" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="labelModalCancelar">Cancelar Ocorrência</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirme Com Sua Senha</label>
            <input type="password" class="form-control" id="exampleInputPassword1">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
        <button type="button" class="btn btn-primary">Confirmar</button>
      </div>
    </div>
  </div>
</div>
	        
	        
	        
<hr>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCancelar">
      Cancelar Ocorrência
    </button>
	        
';
	    
	}
	
	public function painelStatus(Ocorrencia $ocorrencia){
	    $this->ocorrencia = $ocorrencia;
	    $this->sessao = new Sessao();
	    
	    echo '
<div class="card">
    <div class="card-body">
    <div class="alert alert-danger" role="alert">
      Status Aaberto
    </div>';
	    
	    $this->avaliar();
	    $this->cancelar();
	    
	    echo '
	        
	        
  </div>
</div>
	        
	        
	        
	        
	        
';
	}

	        
}
?>