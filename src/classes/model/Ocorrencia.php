
<?php
            
/**
 * Classe feita para manipulação do objeto Ocorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class Ocorrencia {
	private $id;
	private $areaResponsavel;
	private $servico;
	private $idLocal;
	private $idFuncionario;
	private $descProblema;
	private $campus;
	private $etiqEquipamento;
	private $contato;
	private $ramal;
	private $local;
	private $funcionario;
	private $status;
	private $obs;
	private $prioridade;
	private $avaliacao;
	private $email;
	private $fechaConfirmado;
	private $reaberto;
	private $dtAbertura;
	private $dtAtendimento;
	private $dtFechamento;
	private $dtFechaConfirmado;
	private $dtCancelamento;
	private $idAtendente;
	private $idTecnicoIndicado;
	private $dtLiberacao;
	private $anexo;
	private $dtEspera;
	private $dtAguardandoUsuario;
	private $localSala;
	private $listaStatus;
    public function __construct(){

        $this->areaResponsavel = new AreaResponsavel();
        $this->servico = new Servico();
        $this->listaStatus = array();
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
	public function setIdFuncionario($idFuncionario) {
		$this->idFuncionario = $idFuncionario;
	}
		    
	public function getIdFuncionario() {
		return $this->idFuncionario;
	}
	public function setDescProblema($descProblema) {
		$this->descProblema = $descProblema;
	}
		    
	public function getDescProblema() {
		return $this->descProblema;
	}
	public function setCampus($campus) {
		$this->campus = $campus;
	}
		    
	public function getCampus() {
		return $this->campus;
	}
	public function setEtiqEquipamento($etiqEquipamento) {
		$this->etiqEquipamento = $etiqEquipamento;
	}
		    
	public function getEtiqEquipamento() {
		return $this->etiqEquipamento;
	}
	public function setContato($contato) {
		$this->contato = $contato;
	}
		    
	public function getContato() {
		return $this->contato;
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
	public function setFuncionario($funcionario) {
		$this->funcionario = $funcionario;
	}
		    
	public function getFuncionario() {
		return $this->funcionario;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
		    
	public function getStatus() {
		return $this->status;
	}
	public function setObs($obs) {
		$this->obs = $obs;
	}
		    
	public function getObs() {
		return $this->obs;
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
	public function setFechaConfirmado($fechaConfirmado) {
		$this->fechaConfirmado = $fechaConfirmado;
	}
		    
	public function getFechaConfirmado() {
		return $this->fechaConfirmado;
	}
	public function setReaberto($reaberto) {
		$this->reaberto = $reaberto;
	}
		    
	public function getReaberto() {
		return $this->reaberto;
	}
	public function setDtAbertura($dtAbertura) {
		$this->dtAbertura = $dtAbertura;
	}
		    
	public function getDtAbertura() {
		return $this->dtAbertura;
	}
	public function setDtAtendimento($dtAtendimento) {
		$this->dtAtendimento = $dtAtendimento;
	}
		    
	public function getDtAtendimento() {
		return $this->dtAtendimento;
	}
	public function setDtFechamento($dtFechamento) {
		$this->dtFechamento = $dtFechamento;
	}
		    
	public function getDtFechamento() {
		return $this->dtFechamento;
	}
	public function setDtFechaConfirmado($dtFechaConfirmado) {
		$this->dtFechaConfirmado = $dtFechaConfirmado;
	}
		    
	public function getDtFechaConfirmado() {
		return $this->dtFechaConfirmado;
	}
	public function setDtCancelamento($dtCancelamento) {
		$this->dtCancelamento = $dtCancelamento;
	}
		    
	public function getDtCancelamento() {
		return $this->dtCancelamento;
	}
	public function setIdAtendente($idAtendente) {
		$this->idAtendente = $idAtendente;
	}
		    
	public function getIdAtendente() {
		return $this->idAtendente;
	}
	public function setIdTecnicoIndicado($idTecnicoIndicado) {
		$this->idTecnicoIndicado = $idTecnicoIndicado;
	}
		    
	public function getIdTecnicoIndicado() {
		return $this->idTecnicoIndicado;
	}
	public function setDtLiberacao($dtLiberacao) {
		$this->dtLiberacao = $dtLiberacao;
	}
		    
	public function getDtLiberacao() {
		return $this->dtLiberacao;
	}
	public function setAnexo($anexo) {
		$this->anexo = $anexo;
	}
		    
	public function getAnexo() {
		return $this->anexo;
	}
	public function setDtEspera($dtEspera) {
		$this->dtEspera = $dtEspera;
	}
		    
	public function getDtEspera() {
		return $this->dtEspera;
	}
	public function setDtAguardandoUsuario($dtAguardandoUsuario) {
		$this->dtAguardandoUsuario = $dtAguardandoUsuario;
	}
		    
	public function getDtAguardandoUsuario() {
		return $this->dtAguardandoUsuario;
	}
	public function setLocalSala($localSala) {
		$this->localSala = $localSala;
	}
		    
	public function getLocalSala() {
		return $this->localSala;
	}
                            
    public function addStatus(Status $status){
        $this->listaStatus[] = $status;
            
    }
	public function getListaStatus() {
		return $this->listaStatus;
	}
	public function __toString(){
	    return $this->id.' - '.$this->areaResponsavel.' - '.$this->servico.' - '.$this->idLocal.' - '.$this->idFuncionario.' - '.$this->descProblema.' - '.$this->campus.' - '.$this->etiqEquipamento.' - '.$this->contato.' - '.$this->ramal.' - '.$this->local.' - '.$this->funcionario.' - '.$this->status.' - '.$this->obs.' - '.$this->prioridade.' - '.$this->avaliacao.' - '.$this->email.' - '.$this->fechaConfirmado.' - '.$this->reaberto.' - '.$this->dtAbertura.' - '.$this->dtAtendimento.' - '.$this->dtFechamento.' - '.$this->dtFechaConfirmado.' - '.$this->dtCancelamento.' - '.$this->idAtendente.' - '.$this->idTecnicoIndicado.' - '.$this->dtLiberacao.' - '.$this->anexo.' - '.$this->dtEspera.' - '.$this->dtAguardandoUsuario.' - '.$this->localSala.' - '.'Lista: '.implode(", ", $this->listaStatus);
	}
                

}
?>