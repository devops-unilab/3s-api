<?php
            
/**
 * Classe feita para manipulação do objeto Ocorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\model;

class Ocorrencia {
	private $id;
	private $areaResponsavel;
	private $servico;
	private $idLocal;
	private $usuarioCliente;
	private $descricao;
	private $campus;
	private $patrimonio;
	private $ramal;
	private $local;
	private $status;
	private $solucao;
	private $prioridade;
	private $avaliacao;
	private $email;
	private $idUsuarioAtendente;
	private $idUsuarioIndicado;
	private $anexo;
	private $localSala;
    public function __construct(){

        $this->areaResponsavel = new AreaResponsavel();
        $this->servico = new Servico();
        $this->usuarioCliente = new Usuario();
    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setAreaResponsavel(AreaResponsavel $areaResponsavel) {
		$this->areaResponsavel = $areaResponsavel;
	}
		    
	public function getAreaResponsavel() {
		return $this->areaResponsavel;
	}
	public function setServico(Servico $servico) {
		$this->servico = $servico;
	}
		    
	public function getServico() {
		return $this->servico;
	}
	public function setIdLocal($idLocal) {
		$this->idLocal = $idLocal;
	}
		    
	public function getIdLocal() {
		return $this->idLocal;
	}
	public function setUsuarioCliente(Usuario $usuario) {
		$this->usuarioCliente = $usuario;
	}
		    
	public function getUsuarioCliente() {
		return $this->usuarioCliente;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
		    
	public function getDescricao() {
		return $this->descricao;
	}
	public function setCampus($campus) {
		$this->campus = $campus;
	}
		    
	public function getCampus() {
		return $this->campus;
	}
	public function setPatrimonio($patrimonio) {
		$this->patrimonio = $patrimonio;
	}
		    
	public function getPatrimonio() {
		return $this->patrimonio;
	}
	public function setRamal($ramal) {
		$this->ramal = $ramal;
	}
		    
	public function getRamal() {
		return $this->ramal;
	}
	public function setLocal($local) {
		$this->local = $local;
	}
		    
	public function getLocal() {
		return $this->local;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
		    
	public function getStatus() {
		return $this->status;
	}
	public function setSolucao($solucao) {
		$this->solucao = $solucao;
	}
		    
	public function getSolucao() {
		return $this->solucao;
	}
	public function setPrioridade($prioridade) {
		$this->prioridade = $prioridade;
	}
		    
	public function getPrioridade() {
		return $this->prioridade;
	}
	public function setAvaliacao($avaliacao) {
		$this->avaliacao = $avaliacao;
	}
		    
	public function getAvaliacao() {
		return $this->avaliacao;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
		    
	public function getEmail() {
		return $this->email;
	}
	public function setIdUsuarioAtendente($idUsuarioAtendente) {
		$this->idUsuarioAtendente = $idUsuarioAtendente;
	}
		    
	public function getIdUsuarioAtendente() {
		return $this->idUsuarioAtendente;
	}
	public function setIdUsuarioIndicado($idUsuarioIndicado) {
		$this->idUsuarioIndicado = $idUsuarioIndicado;
	}
		    
	public function getIdUsuarioIndicado() {
		return $this->idUsuarioIndicado;
	}
	public function setAnexo($anexo) {
		$this->anexo = $anexo;
	}
		    
	public function getAnexo() {
		return $this->anexo;
	}
	public function setLocalSala($localSala) {
		$this->localSala = $localSala;
	}
		    
	public function getLocalSala() {
		return $this->localSala;
	}
	public function __toString(){
	    return $this->id.' - '.$this->areaResponsavel.' - '.$this->servico.' - '.$this->idLocal.' - '.$this->usuarioCliente.' - '.$this->descricao.' - '.$this->campus.' - '.$this->patrimonio.' - '.$this->ramal.' - '.$this->local.' - '.$this->status.' - '.$this->solucao.' - '.$this->prioridade.' - '.$this->avaliacao.' - '.$this->email.' - '.$this->idUsuarioAtendente.' - '.$this->idUsuarioIndicado.' - '.$this->anexo.' - '.$this->localSala;
	}
                

}
?>