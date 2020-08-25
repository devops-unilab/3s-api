
<?php
            
/**
 * Classe feita para manipulação do objeto StatusOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class StatusOcorrencia {
	private $id;
	private $status;
	private $mensagem;
	private $idUser;
	private $dtMudanca;
    public function __construct(){

        $this->status = new Status();
    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setStatus(Status $status) {
		$this->status = $status;
	}
		    
	public function getStatus() {
		return $this->status;
	}
	public function setMensagem($mensagem) {
		$this->mensagem = $mensagem;
	}
		    
	public function getMensagem() {
		return $this->mensagem;
	}
	public function setIdUser($idUser) {
		$this->idUser = $idUser;
	}
		    
	public function getIdUser() {
		return $this->idUser;
	}
	public function setDtMudanca($dtMudanca) {
		$this->dtMudanca = $dtMudanca;
	}
		    
	public function getDtMudanca() {
		return $this->dtMudanca;
	}
	public function __toString(){
	    return $this->id.' - '.$this->status.' - '.$this->mensagem.' - '.$this->idUser.' - '.$this->dtMudanca;
	}
                

}
?>