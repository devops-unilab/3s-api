
<?php
            
/**
 * Classe feita para manipulação do objeto Chamado
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */
class Chamado {
	private $id;
	private $descricao;
	private $abertura;
	private $atendimento;
	private $fechamento;
	private $fechamentoConfirmado;
	private $campus;
	private $idstatus;
	private $status;
	private $atendente;
	private $demandante;
	private $setorDemandante;
	private $idsetor;
	private $setor;
    private $mudancas;
    
    public function __construct(){
        $this->mudancas = array();
    }
    public function addMudanca($dataMudanca){
        $this->mudancas[] = $dataMudanca;
    }
    public function getMudancas(){
        return $this->mudancas;
    }
    public function setFechamentoConfirmado($fechamentoConfirmado){
        $this->fechamentoConfirmado;
    }
    public function getFechamentoConfirmado(){
        return $this->fechamentoConfirmado;
    }
    public function setSetorDemandante($setorDemandante){
        $this->setorDemandante = $setorDemandante;
    }
    public function getSetorDemandante(){
        return $this->setorDemandante;
    }
    public function setDemandante($demandante){
        $this->demandante = $demandante;
    }
    public function getDemandante(){
        return $this->demandante;
    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
		    
	public function getDescricao() {
		return $this->descricao;
	}
	public function setAbertura($abertura) {
		$this->abertura = $abertura;
	}
		    
	public function getAbertura() {
		return $this->abertura;
	}
	public function setAtendimento($atendimento) {
		$this->atendimento = $atendimento;
	}
		    
	public function getAtendimento() {
		return $this->atendimento;
	}
	public function setFechamento($fechamento) {
		$this->fechamento = $fechamento;
	}
		    
	public function getFechamento() {
		return $this->fechamento;
	}
	public function setCampus($campus) {
		$this->campus = $campus;
	}
		    
	public function getCampus() {
		return $this->campus;
	}
	public function setIdstatus($idstatus) {
		$this->idstatus = $idstatus;
	}
		    
	public function getIdstatus() {
		return $this->idstatus;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
		    
	public function getStatus() {
		return $this->status;
	}
	public function setAtendente($atendente) {
		$this->atendente = $atendente;
	}
		    
	public function getAtendente() {
		return $this->atendente;
	}
	public function setIdsetor($idsetor) {
		$this->idsetor = $idsetor;
	}
		    
	public function getIdsetor() {
		return $this->idsetor;
	}
	public function setSetor($setor) {
		$this->setor = $setor;
	}
		    
	public function getSetor() {
		return $this->setor;
	}
	public function __toString(){
	    return $this->id.' - '.$this->descricao.' - '.$this->abertura.' - '.$this->atendimento.' - '.$this->fechamento.' - '.$this->campus.' - '.$this->idstatus.' - '.$this->status.' - '.$this->atendente.' - '.$this->idsetor.' - '.$this->setor;
	}
                

}
?>