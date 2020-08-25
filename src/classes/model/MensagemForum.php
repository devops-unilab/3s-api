
<?php
            
/**
 * Classe feita para manipulação do objeto MensagemForum
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class MensagemForum {
	private $id;
	private $tipo;
	private $mensagem;
	private $idUser;
	private $dtEnvio;
	private $origem;
	private $ativo;
    public function __construct(){

    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setTipo($tipo) {
		$this->tipo = $tipo;
	}
		    
	public function getTipo() {
		return $this->tipo;
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
	public function setDtEnvio($dtEnvio) {
		$this->dtEnvio = $dtEnvio;
	}
		    
	public function getDtEnvio() {
		return $this->dtEnvio;
	}
	public function setOrigem($origem) {
		$this->origem = $origem;
	}
		    
	public function getOrigem() {
		return $this->origem;
	}
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
	}
		    
	public function getAtivo() {
		return $this->ativo;
	}
	public function __toString(){
	    return $this->id.' - '.$this->tipo.' - '.$this->mensagem.' - '.$this->idUser.' - '.$this->dtEnvio.' - '.$this->origem.' - '.$this->ativo;
	}
                

}
?>