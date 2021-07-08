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
use novissimo3s\dao\OcorrenciaDAO;
use novissimo3s\model\StatusOcorrencia;
use novissimo3s\model\Status;
use novissimo3s\dao\StatusDAO;
use novissimo3s\custom\dao\UsuarioCustomDAO;
use novissimo3s\model\Usuario;
use novissimo3s\dao\UsuarioDAO;
use novissimo3s\custom\dao\OcorrenciaCustomDAO;
use novissimo3s\dao\ServicoDAO;
use novissimo3s\custom\dao\ServicoCustomDAO;
use novissimo3s\model\Servico;
use novissimo3s\util\Mail;
use novissimo3s\custom\dao\AreaResponsavelCustomDAO;
use novissimo3s\custom\view\OcorrenciaCustomView;
use novissimo3s\model\AreaResponsavel;

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
	        return false;
	    }
	    if($_POST['status_acao'] != 'atender'){
	        return false;
	    }
	    if(!isset($_POST['id_ocorrencia'])){
	        return false;
	    }
	    if(!isset($_POST['senha'])){
	        return false;
	    }
	    
	    if(!$this->possoAtender()){
	        echo ':falha:Não é possível atender este chamado.';
	        return false;
	    }
	    
	    $this->sessao = new Sessao();
	    $this->ocorrencia = new Ocorrencia();
	    $this->ocorrencia->setId($_POST['id_ocorrencia']);
	    
	    
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $ocorrenciaDao->fillById($this->ocorrencia);
	    
	    
	    $usuario = new Usuario();
	    $usuario->setId($this->sessao->getIdUsuario());
	    
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuarioDao->fillById($usuario);
	    $this->ocorrencia->getAreaResponsavel()->setId($usuario->getIdSetor());
	    
	    $this->ocorrencia->setIdUsuarioAtendente($this->sessao->getIdUsuario());

	    
	    $this->ocorrencia->setStatus(self::STATUS_ATENDIMENTO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_ATENDIMENTO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem("Ocorrência em atendimento");
	    
	    
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuario = new Usuario();
	    $usuario->setId($this->sessao->getIdUsuario());
	    $usuarioDao->fillById($usuario);
	    
	    $this->ocorrencia->getAreaResponsavel()->setId($usuario->getIdSetor());
	    
	    if($this->ocorrencia->getDataAtendimento() == null){
	        $this->ocorrencia->setDataAtendimento(date("Y-m-d H:i:s"));
	    }
        
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Chamado am atendimento!';
	    return true;
	    
	    
	}
	public function ajaxCancelar(){
	    if(!isset($_POST['status_acao'])){
	        return false;
	    }
	    if($_POST['status_acao'] != 'cancelar'){
	        return false;
	    }
	    if(!isset($_POST['id_ocorrencia'])){
	        return false;
	    }
	    if(!isset($_POST['senha'])){
	        return false;
	    }
	    
	    
	    
	    if(!$this->possoCancelar()){
	        echo ":falha:Este chamado não pode ser cancelado.";
	        return false;
	    }
	    
	    
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_CANCELADO);

	    $status = new Status();
	    $status->setSigla(self::STATUS_CANCELADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem("Ocorrência cancelada pelo usuário");
	
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Chamado cancelado com sucesso!';
	    return true;
	    
	}
	public function getTecnicos(){
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuario = new Usuario();
	    $usuario->setNivel(Sessao::NIVEL_TECNICO);
	    $listaUsuarios = $usuarioDao->fetchByNivel($usuario);
	    $usuario->setNivel(Sessao::NIVEL_ADM);
	    return array_merge($listaUsuarios, $usuarioDao->fetchByNivel($usuario));
	    
	}
	public function getServicos(){
	    $listaServicos = array();
	    
	    $servicoDao = new ServicoCustomDAO($this->dao->getConnection());
	    $servico = new Servico();
	    $servico->setVisao(1);
	    
	    $listaServicos = $servicoDao->fetchByVisao($servico);
	    $servico->setVisao(2);
	    $lista2 = $servicoDao->fetchByVisao($servico);
	    $listaServicos = array_merge($listaServicos, $lista2);
	    
	    
	    return $listaServicos;
	}
	
	public function painelStatus(Ocorrencia $ocorrencia){
	    
	    $this->ocorrencia = $ocorrencia;
	    $this->sessao = new Sessao();



	    
	    $listaUsuarios = array();
	    $listaServicos = array();
	    $listaAreas = array();
	    if($this->possoEditarServico($this->ocorrencia)){
	        $listaServicos = $this->getServicos();
	    }
	    if($this->possoReservar())
	    {
	        $listaUsuarios = $this->getTecnicos();
	    }
	    
	    if($this->possoEditarAreaResponsavel($this->ocorrencia))
	    {
	        $areaDao = new AreaResponsavelCustomDAO($this->dao->getConnection());
	        $listaAreas = $areaDao->fetch();
	        
	    }
	    
	    
	    $this->view->modalFormStatus($this->ocorrencia, $listaUsuarios, $listaServicos, $listaAreas);
	    
	    

	    
	    echo '
<!-- Large button groups (default and split) -->
<div class="btn-group">
  <button class="btn btn-light btn-lg dropdown-toggle mb-3" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   Chamado '.$this->ocorrencia->getId().'
  </button>
  <div class="dropdown-menu">


      
';
	    
	    
	    $possoCancelar = $this->possoCancelar();
	    $this->view->botaoCancelar($possoCancelar);

	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM ||$this->sessao->getNivelAcesso() == Sessao::NIVEL_TECNICO){
	        $possoAtender = $this->possoAtender();
	        $this->view->botaoAtender($possoAtender);
	    }
	    
        
        $possoFechar = $this->possoFechar();
        $this->view->botaoFechar($possoFechar);
        
        $possoAvaliar = $this->possoAvaliar();
        $this->view->botaoAvaliar($possoAvaliar);
	    
        
        $possoAvaliar = $this->possoReabrir();
        $this->view->botaoReabrir($possoAvaliar);
        
	    if($this->possoReservar()){
	        $this->view->botaoReservar();
	    }
	    
	    if($this->possoLiberar()){
	        $this->view->botaoLiberar();
	    }

	    $possoAguardarAtivo = $this->possoAguardarAtivos();
	    $possoAguardarUsuario = $this->possoAguardarUsuario();
	    
	    if($possoAguardarAtivo || $possoAguardarUsuario){
	        echo '<div class="dropdown-divider"></div>';
	        $this->view->botaoAguardarUsuario();
	        $this->view->botaoAguardarAtivos();
	    }
	    
        
	    
	    
	    echo '

  </div>
</div>';
	    

	}
	public function possoAguardarUsuario(){
	    
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() != self::STATUS_ATENDIMENTO){
	        return false;
	    }
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getIdUsuarioAtendente()){
	        return false;
	    }
	    return true;
	}
	public function possoAguardarAtivos(){
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() != self::STATUS_ATENDIMENTO){
	        return false;
	    }
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getIdUsuarioAtendente()){
	        return false;
	    }
	    return true;
	}
	public function possoEditarServico(Ocorrencia $ocorrencia){
	    $this->ocorrencia = $ocorrencia;
	    $this->sessao = new Sessao();
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO){
	       return false;    
	    }
	    if($this->ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_FECHADO_CONFIRMADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_CANCELADO){
	        return false;
	    }
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_ADM){
            return true;
	    }
	    if($this->ocorrencia->getStatus() != self::STATUS_ATENDIMENTO){
	        return false;
	    }
	    
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getIdUsuarioAtendente()){
	        return false;
	    }
	    return true;
	    
	}
	public function possoEditarAreaResponsavel(Ocorrencia $ocorrencia){
	    

	    
	    $this->ocorrencia = $ocorrencia;
	    $this->sessao = new Sessao();
	    if($this->sessao->getNivelAcesso() != Sessao::NIVEL_ADM){
            return false;
	    }
	    
	    if($this->ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_ABERTO){
	        return true;
	    }
	    if($this->ocorrencia->getStatus() == StatusOcorrenciaCustomController::STATUS_REABERTO){
	        return true;
	    }	    
	    return false;
	}
	
	
	public function possoEditarSolucao(Ocorrencia $ocorrencia){
	    $this->ocorrencia = $ocorrencia;
	    $this->sessao = new Sessao();
	    if($this->sessao->getNivelAcesso() == Sessao::NIVEL_COMUM || $this->sessao->getNivelAcesso() == Sessao::NIVEL_DESLOGADO){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() != self::STATUS_ATENDIMENTO){
	        return false;
	    }
	    if($this->sessao->getIdUsuario() != $this->ocorrencia->getIdUsuarioAtendente()){
	        return false;
	    }
	    return true;
	    
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
	public function possoReabrir(){
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
	    if(trim($this->ocorrencia->getSolucao()) == ""){
	        return false;
	    }
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
	        return false;
	    }
	    
	    $usuario = new Usuario();
	    $usuario->setId($this->sessao->getIdUsuario());
	    
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuarioDao->fillById($usuario);
	    $this->ocorrencia->getAreaResponsavel()->setId($usuario->getIdSetor());
	    
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_FECHADO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_FECHADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem("Ocorrência fechada pelo atendente");
	    
	    
        $this->ocorrencia->setDataFechamento(date("Y-m-d H:i:s"));
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Chamado fechado com sucesso!';
	    
	    return true;
	    
	}
	public function ajaxAvaliar(){
	    if(!isset($_POST['avaliacao'])){
	        echo ':falha:Faça uma avaliação';
	        return false;
	    }
	    if(!$this->possoAvaliar()){
	        return false;
	    }
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_FECHADO_CONFIRMADO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_FECHADO_CONFIRMADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem("Atendimento avaliado pelo cliente");
	    
	    $this->ocorrencia->setDataFechamentoConfirmado(date("Y-m-d H:i:s"));
	    $this->ocorrencia->setAvaliacao($_POST['avaliacao']);
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Atendimento avaliado com sucesso!';
	    return true;
	}
	public function ajaxReabrir()
	{
	    if(!$this->possoReabrir()){
	        return false;
	    }
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_REABERTO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_REABERTO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem("Ocorrência Reaberta pelo cliente");
	    if(isset($_POST['mensagem-status'])){
	        $this->statusOcorrencia->setMensagem($_POST['mensagem-status']);
	    }
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Atendimento reaberto com sucesso!';
	    return true;
	}
	
	public function ajaxReservar(){
	    if(!isset($_POST['tecnico'])){
	        echo ':falha:Técnico especificado';
	        return false;
	    }
	    if(!$this->possoReservar()){
	        echo ':falha:Você não pode reservar esse chamado.';
	        return false;
	    }
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $ocorrenciaDao->fillById($this->ocorrencia);
	    
	    $usuario = new Usuario();
	    $usuario->setId($_POST['tecnico']);
	    
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    $usuarioDao->fillById($usuario);
	    
	    $this->ocorrencia->getAreaResponsavel()->setId($usuario->getIdSetor());
	    $this->ocorrencia->setStatus(self::STATUS_RESERVADO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_RESERVADO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem('Atendimento reservado para '.$usuario->getNome());
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    $this->ocorrencia->setIdUsuarioIndicado($usuario->getId());
	    $this->ocorrencia->getAreaResponsavel()->setId($usuario->getIdSetor());
	    
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Reservado com sucesso!';
	    return true;
	    
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
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $ocorrenciaDao->fillById($this->ocorrencia);
	    $status = false;
	    $mensagem = "";
	    switch($_POST['status_acao']){
	        case 'cancelar':
	            $status = $this->ajaxCancelar();
	            $mensagem = '<p>Chamado cancelado</p>';
	            break;
	        case 'atender':
	            $status = $this->ajaxAtender();
	            $mensagem = '<p>Chamado em atendimento</p>';
	            break;
	        case 'fechar':
	            $status = $this->ajaxFechar();
	            $mensagem = '<p>Chamado fechado</p>';
	            break;
	        case 'reservar':
	            $status = $this->ajaxReservar();
	            $mensagem = '<p>Chamado reservado</p>';
	            break;
	        case 'liberar_atendimento':
	            $status = $this->ajaxLiberar();
	            $mensagem = '<p>Chamado Liberado para atendimento</p>';
	            break;
	        case 'avaliar':
	            $status = $this->ajaxAvaliar();
	            $mensagem = '<p>Chamado avaliado</p>';
	            break;
	        case 'reabrir':
	            $status = $this->ajaxReabrir();
	            $mensagem = '<p>Chamado reaberto</p>';
	            break;
	        case 'editar_servico':
	            $status = $this->ajaxEditarServico();
	            $mensagem = '<p>Serviço alterado</p>';
	            break;
	        case 'editar_solucao':
	            $status = $this->ajaxEditarSolucao();
	            $mensagem = '<p>Solução editada</p>';
	            break;
	        case 'editar_area':
	            $status = $this->ajaxEditarArea();
	            $mensagem = '<p>Área Editada Com Sucesso</p>';
	            break;
	        case 'aguardar_ativos':
	            $status = $this->ajaxAguardandoAtivo();
	            $mensagem = '<p>Aguardando ativo de TI</p>';
	            break;
	        case 'aguardar_usuario':
	            $status = $this->ajaxAguardandoUsuario();
	            $mensagem = '<p>Aguardando resposta do cliente</p>';
	            break;
	        default:
	            echo ':falha:Ação não encontrada';
	            
	            break;
	    }
	    if($status){
	        $this->enviarEmail($mensagem);
	    }
	    
	}

	public function enviarEmail($mensagem = ""){
	    $mail = new Mail();
	    $assunto = "[3S] - Chamado Nº ".$this->statusOcorrencia->getOcorrencia()->getId();
	    

	    
	    $saldacao =  '<p>Prezado(a) ' . $this->statusOcorrencia->getUsuario()->getNome().' ,</p>';
	    
	    $corpo = '<p>Avisamos que houve uma mudança no status da solicitação Nº'.$this->statusOcorrencia->getOcorrencia()->getId().'</p>';
	    $corpo .= $mensagem;
	    $corpo .= '<ul>
                        <li>Serviço Solicitado: '. $this->statusOcorrencia->getOcorrencia()->getServico()->getNome().'</li>
                        <li>Descrição do Problema: '.$this->statusOcorrencia->getOcorrencia()->getDescricao().'</li>
                        <li>Setor Responsável: '. $this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getNome().' -
                        '.$this->statusOcorrencia->getOcorrencia()->getAreaResponsavel()->getDescricao().'</li>
                        <li>Cliente: '.$this->ocorrencia->getUsuarioCliente()->getNome().'</li>
                </ul><br><p>Mensagem enviada pelo sistema 3S. Favor não responder.</p>';
	    
	    
	    $destinatario = $this->statusOcorrencia->getOcorrencia()->getEmail();
	    $nome = $this->statusOcorrencia->getOcorrencia()->getUsuarioCliente()->getNome();
	    $mail->enviarEmail($destinatario, $nome, $assunto, $saldacao.$corpo);
	    
	    $usuarioDao = new UsuarioDAO($this->dao->getConnection());
	    
	    if($this->statusOcorrencia->getOcorrencia()->getIdUsuarioAtendente() != null){
	        
	        $atendente = new Usuario();
	        $atendente->setId($this->statusOcorrencia->getOcorrencia()->getIdUsuarioAtendente());
	        $usuarioDao->fillById($atendente);
	        $destinatario = $atendente->getEmail();
	        $nome = $atendente->getNome();
	        
	        $saldacao =  '<p>Prezado(a) ' . $nome.' ,</p>';
	        $mail->enviarEmail($destinatario, $nome, $assunto, $saldacao.$corpo);
	        
	    }
	    else if($this->statusOcorrencia->getOcorrencia()->getIdUsuarioIndicado() != null)
	    {
	        
	        $indicado = new Usuario();
	        $indicado->setId($this->statusOcorrencia->getOcorrencia()->getIdUsuarioIndicado());
	        $usuarioDao->fillById($indicado);
	        $destinatario = $indicado->getEmail();
	        $nome = $indicado->getNome();
	        
	        $saldacao =  '<p>Prezado(a) ' . $nome.' ,</p>';
	        $mail->enviarEmail($destinatario, $nome, $assunto, $saldacao.$corpo);
	    }
	    
	}
	private $statusOcorrencia; 
	public function ajaxAguardandoAtivo(){
	    
	    if(!$this->possoEditarSolucao($this->ocorrencia)){
	        echo ':falha:Esta solução não pode ser editada.';
	        return false;
	    }
	    
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_AGUARDANDO_ATIVO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_AGUARDANDO_ATIVO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem("Aguardando ativo de TI");
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Alterado para aguardando ativo de ti!';
	    return true;
	    
	}
	public function ajaxAguardandoUsuario(){
	    if(!$this->possoEditarSolucao($this->ocorrencia)){
	        echo ':falha:Esta solução não pode ser editada.';
	        return false;
	    }
	    $ocorrenciaDao = new OcorrenciaDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_AGUARDANDO_USUARIO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_AGUARDANDO_USUARIO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem("Aguardando Usuário");
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    echo ':sucesso:'.$this->ocorrencia->getId().':Alterado para aguardando usuário!';
	    return true;
	    
	}
	
	public function ajaxEditarSolucao(){
	    if(!$this->possoEditarSolucao($this->ocorrencia)){
	        echo ':falha:Esta solução não pode ser editada.';
	        return false;
	    }
	    if(!isset($_POST['solucao'])){
	        echo ':falha:Digite uma solução.';
	        return false;
	    }
	    if(trim($_POST['solucao']) == ""){
	        echo ':falha:Digite uma solução.';
	        return false;
	    }
	    
	   
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $status = new Status();
	    $status->setSigla($this->ocorrencia->getStatus());
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem('Técnico editou a solução. ');
	    
	    $this->ocorrencia->setSolucao(strip_tags($_POST['solucao']));
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Solução editada com sucesso!';
	    return true;
	    
	}
	public function ajaxEditarArea(){
	    if(!$this->possoEditarAreaResponsavel($this->ocorrencia)){
	        echo ':falha:Você não pode editar a área responsável.';
	        return false;
	    }
	    
	    if(!isset($_POST['area_responsavel'])){
	        echo ':falha:Selecione um serviço.';
	        return false;
	    }
	    $areaResponsavel = new AreaResponsavel();
	    $areaResponsavel->setId($_POST['area_responsavel']);
	    $areaResponsavelDao = new AreaResponsavelCustomDAO($this->dao->getConnection());
	    $areaResponsavelDao->fillById($areaResponsavel);
	    
	    $this->ocorrencia->setAreaResponsavel($areaResponsavel);
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    
	    $status = new Status();
	    $status->setSigla(StatusOcorrenciaCustomController::STATUS_ABERTO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem('Administrador Editou a Área Responsável');
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Área Responsável Editada Com Sucesso!';
	    return true;
	    
	}
	public function ajaxEditarServico(){
	    if(!$this->possoEditarServico($this->ocorrencia)){
	        echo ':falha:Este serviço não pode ser editado.';
	        return false;
	    }
	    
	    if(!isset($_POST['id_servico'])){
	        echo ':falha:Selecione um serviço.';
	        return false;
	    }
	    
	    
	    $servico = new Servico();
	    $servico->setId($_POST['id_servico']);
	    
	    $servicoDao = new ServicoCustomDAO($this->dao->getConnection());
	    $servicoDao->fillById($servico);
	    
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());

	    
	    $status = new Status();
	    $status->setSigla($this->ocorrencia->getStatus());
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem('Técnico editou o serviço ');
	    
	    $this->ocorrencia->getAreaResponsavel()->setId($servico->getAreaResponsavel()->getId());
	    $this->ocorrencia->getServico()->setId($servico->getId());
	    
	   
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    
	    
	    
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Serviço editado com sucesso!';
	    return true;
	    
	}
	public function possoLiberar(){
	    if($this->sessao->getNivelAcesso() != Sessao::NIVEL_ADM){
	        return false;
	    }
	    if($this->ocorrencia->getStatus() == self::STATUS_REABERTO){
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
	    if($this->ocorrencia->getStatus() == self::STATUS_ABERTO){
	        return false;
	    }
	    return true;
	}
	public function ajaxLiberar(){
	    if(!$this->possoLiberar()){
	        echo ':falha:Não é possível liberar esse atendimento.';
	        return false;
	    }
	    
	    $ocorrenciaDao = new OcorrenciaCustomDAO($this->dao->getConnection());
	    $this->ocorrencia->setStatus(self::STATUS_ABERTO);
	    
	    $status = new Status();
	    $status->setSigla(self::STATUS_ABERTO);
	    
	    $statusDao = new StatusDAO($this->dao->getConnection());
	    $statusDao->fillBySigla($status);
	    
	    $this->statusOcorrencia = new StatusOcorrencia();
	    $this->statusOcorrencia->setOcorrencia($this->ocorrencia);
	    $this->statusOcorrencia->setStatus($status);
	    $this->statusOcorrencia->setDataMudanca(date("Y-m-d G:i:s"));
	    $this->statusOcorrencia->getUsuario()->setId($this->sessao->getIdUsuario());
	    $this->statusOcorrencia->setMensagem('Liberado para atendimento');
	    
	    
	    $ocorrenciaDao->getConnection()->beginTransaction();
	    $this->ocorrencia->setIdUsuarioIndicado(null);
	    $this->ocorrencia->setIdUsuarioAtendente(null);
	    
	    $servicoDao = new ServicoDAO($this->dao->getConnection());
	    $servicoDao->fillById($this->ocorrencia->getServico());
	    
	    
	    $this->ocorrencia->getAreaResponsavel()->setId($this->ocorrencia->getServico()->getAreaResponsavel()->getId());
	    
	    if(!$ocorrenciaDao->update($this->ocorrencia)){
	        echo ':falha:Falha na alteração do status da ocorrência.';
	        $ocorrenciaDao->getConnection()->rollBack();
	        return false;
	    }
	    
	    if(!$this->dao->insert($this->statusOcorrencia)){
	        echo ':falha:Falha ao tentar inserir histórico.';
	        return false;
	    }
	    $ocorrenciaDao->getConnection()->commit();
	    
	    echo ':sucesso:'.$this->ocorrencia->getId().':Liberado com sucesso!';
	    
	    return true;
	}
	        
}
?>