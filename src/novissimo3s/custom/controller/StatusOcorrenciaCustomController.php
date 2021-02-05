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
use novissimo3s\custom\dao\UsuarioCustomDAO;
use novissimo3s\model\Usuario;
use novissimo3s\dao\UsuarioDAO;

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
	

	public function possoAtender(){
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO
	        || $this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM)
	    {
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_ATENDIMENTO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_CANCELADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_FECHADO || $this->ocorrencia->getStatus() == self::STATUS_FECHADO_CONFIRMADO )
	    {
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_RESERVADO)
	    {
	        if($this->sessao->getIdUsuario() != $this->ocorrencia->getIdUsuarioIndicado())
	        {
	            return false;
	        }
	    }
	    if(
	        $this->ocorrencia->getStatus() == self::STATUS_AGUARDANDO_ATIVO
	        || $this->ocorrencia->getStatus() == self::STATUS_AGUARDANDO_USUARIO
	        || $this->ocorrencia->getStatus() == self::STATUS_EM_ESPERA
	        )
	    {
	        if($this->sessao->getIdUsuario() != $this->ocorrencia->getIdUsuarioAtendente()){
	            return false;
	        }
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_ABERTO || $this->ocorrencia->getStatus() == self::STATUS_REABERTO){
	        return true;
	    }
	    
	    return true;
	}
	public function possoCancelar(){
	    if($this->sessao == null){
	        $this->sessao = new Sessao();
	    }
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getUsuarioCliente()->getId()){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_FECHADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_CANCELADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_FECHADO_CONFIRMADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_REABERTO){
	        return false;
	    }
	    return true;
	}

	public function verificarSenha(){
	    $this->sessao = new Sessao();
	    if(!isset($_POST['senha'])){
	        return false;
	    }
	    $usuario = new Usuario();
	    $usuario->setSenha(md5($_POST['senha']));
	    $usuario->setLogin($this->sessao->getLoginUsuario());
	    
	    $usuarioDao = new UsuarioCustomDAO($this->dao->getConnection());
	    if(!$usuarioDao->autenticar($usuario)){
	        
	        return false;
	    }
	    if($usuario->getId() != $this->sessao->getIdUsuario()){
	        echo ":falha:Senha Incorreta.";
	        return false;
	    }
	    
	    return true;
	}
	public function ajaxAtender(){
	    if(!isset($_POST['status_acao'])){
	        return;
	    }
	    if($_POST['status_acao'] != 'atender'){
	        return;
	    }
	    if(!isset($_POST['id_ocorrencia'])){
	        return;
	    }
	    if(!isset($_POST['senha'])){
	        return;
	    }
	    
	    if(!$this->possoAtender()){
	        echo ':falha:Não é possível atender este chamado.';
	        return;
	    }
	    
	    $this->sessao = new Sessao();
	    $this->ocorrencia = new Ocorrencia();
	    $this->ocorrencia->setId($_POST['id_ocorrencia']);
	    
	    
	    
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $ocorrenciaDao->fillById($this->ocorrencia);
	    
	    $this->ocorrencia->setIdUsuarioAtendente($this->sessao->getIdUsuario());
	    
	    $this->ocorrencia->setStatus(self::STATUS_ATENDIMENTO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_ATENDIMENTO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $statusOcorrencia = new StatusOcorrencia();
	    $statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $statusOcorrencia->setStatus($status);
	    $statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $statusOcorrencia->setMensagem("Ocorrência em atendimento");
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return;
	    }
	    
	    if(!$this->dao->insert($statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return;
	    }
	    
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Chamado am atendimento!';
	    
	    
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
	    if(!isset($_POST['senha'])){
	        return;
	    }
	    
	    
	    
	    if(!$this->possoCancelar()){
	        echo ":falha:Este chamado não pode ser cancelado.";
	        return;
	    }
	    
	    
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_CANCELADO);

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
	
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return;
	    }
	    
	    if(!$this->dao->insert($statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Chamado cancelado com sucesso!';
	    
	}
	public function getTecnicos(){
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuario = new Usuario();
	    $usuario->setNivel(Sessao::NIVEL_TECNICO);
	    $listaUsuarios = $usuarioDao->fetchByNivel($usuario);
	    $usuario->setNivel(Sessao::NIVEL_ADM);
	    return array_merge($listaUsuarios, $usuarioDao->fetchByNivel($usuario));
	    
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
	    
	    $listaUsuarios = array();
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
	        $listaUsuarios = $this->getTecnicos();
	    }
	    
	    $this->view->modalFormStatus($this->ocorrencia, $listaUsuarios);
	    
	    
	    if($this->possoCancelar()){
	        $this->view->botaoCancelar($this->ocorrencia);
	    }
	    if($this->possoAtender()){
	        $this->view->botaoAtender($this->ocorrencia);
	    }
	    if($this->possoAvaliar()){
	        $this->view->botaoAvaliar();
	    }
	    
	    if($this->possoReservar()){
	        $this->view->botaoReservar();
	    }
	    if($this->possoFechar()){
	        $this->view->botaoFechar();
	    }
	    
	    echo '
  </div>
</div>
	        
	        
	        
	        
	        
';
	}
	
	
	public function possoAvaliar(){
	    //Só permitir isso se o usuário for cliente do chamado
	    //O chamado deve estar fechado.
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getUsuarioCliente()->getId()){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() != self::STATUS_FECHADO){
	        return false;
	    }
	    return true;
	}
	
	public function possoFechar(){
	    
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM){
	        return false;
	    }
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
	        return false;
	    }
	    
	    if($this->ocorrencia->getStatus() == Self::STATUS_ATENDIMENTO){
	        if($this->sessao->getIdUsuario() == $this->ocorrencia->getIdUsuarioAtendente()){
	            return true;
	        }
	        
	        
	    }

	    return false;
	}
	public function possoReservar(){
	    if($this->sessao->getNivelAcesso() != Sessao::NIVEL_ADM){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == Self::STATUS_FECHADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == Self::STATUS_FECHADO_CONFIRMADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == Self::STATUS_CANCELADO){
	        return false;
	    }
	    
	    return true;
	}
	public function ajaxFechar(){
	    if(!$this->possoFechar()){
	        echo ':falha:Não é possível fechar este chamado.';
	        return;
	    }
	    
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_FECHADO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_FECHADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $statusOcorrencia = new StatusOcorrencia();
	    $statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $statusOcorrencia->setStatus($status);
	    $statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $statusOcorrencia->setMensagem("Ocorrência fechada pelo atendente");
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return;
	    }
	    
	    if(!$this->dao->insert($statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Chamado fechado com sucesso!';
	    
	    
	    
	}
	public function ajaxAvaliar(){
	    if(!isset($_POST['avaliacao'])){
	        echo ':falha:Faça uma avaliação';
	        return;
	    }
	    if(!$this->possoAvaliar()){
	        return;
	    }
	    
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_FECHADO_CONFIRMADO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_FECHADO_CONFIRMADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $statusOcorrencia = new StatusOcorrencia();
	    $statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $statusOcorrencia->setStatus($status);
	    $statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $statusOcorrencia->setMensagem("Atendimento avaliado pelo cliente");
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    $this->ocorrencia->setAvaliacao($_POST['avaliacao']);
	    
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return;
	    }
	    
	    if(!$this->dao->insert($statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Atendimento avaliado com sucesso!';
	}
	public function ajaxReservar(){
	    if(!isset($_POST['tecnico'])){
	        echo ':falha:Técnico especificado';
	        return;
	    }
	    if(!$this->possoReservar()){
	        echo ':falha:Você não pode reservar esse chamado.';
	        return;
	    }
	    
	    $usuario = new Usuario();
	    $usuario->setId($_POST['tecnico']);
	    
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuarioDao->fillById($usuario);
	    
	    
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_RESERVADO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_RESERVADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $statusOcorrencia = new StatusOcorrencia();
	    $statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $statusOcorrencia->setStatus($status);
	    $statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $statusOcorrencia->setMensagem('Atendimento reservado para '.$usuario->getNome());
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    $this->ocorrencia->setIdUsuarioIndicado($usuario->getId());
	    
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return;
	    }
	    
	    if(!$this->dao->insert($statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Reservado com sucesso!';
	    
	    
	}
	public function mainAjax(){
	    //Verifica-se qual o form que foi submetido. 
	    
	    if(!isset($_POST['status_acao'])){
	        echo ':falha:Ação não especificada';
	        return;
	    }
	    if(!$this->verificarSenha()){
	        echo ':falha:Senha incorreta';
	        return;
	    }

	    $this->sessao = new Sessao();
	    $this->ocorrencia = new Ocorrencia();
	    $this->ocorrencia->setId($_POST['id_ocorrencia']);
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $ocorrenciaDao->fillById($this->ocorrencia);
	    
	    switch($_POST['status_acao']){
	        case 'cancelar':
	            $this->ajaxCancelar();
	            break;
	        case 'atender':
	            $this->ajaxAtender();
	            break;
	        case 'fechar':
	            $this->ajaxFechar();
	            break;
	        case 'reservar':
	            $this->ajaxReservar();
	            break;
	        case 'avaliar':
	            $this->ajaxAvaliar();
	            break;
	        default:
	            echo ':falha:Ação não encontrada';
	            break;
	    }
	}
	        
}
?>