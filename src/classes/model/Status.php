
<?php
            
/**
 * Classe feita para manipulação do objeto Status
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class Status {
	private $id;
	private $sigla;
	private $nome;
	private $icone;
	private $cor;
    public function __construct(){

    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setSigla($sigla) {
		$this->sigla = $sigla;
	}
		    
	public function getSigla() {
		return $this->sigla;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
		    
	public function getNome() {
		return $this->nome;
	}
	public function setIcone($icone) {
		$this->icone = $icone;
	}
		    
	public function getIcone() {
		return $this->icone;
	}
	public function setCor($cor) {
		$this->cor = $cor;
	}
		    
	public function getCor() {
		return $this->cor;
	}
	public function __toString(){
	    return $this->id.' - '.$this->sigla.' - '.$this->nome.' - '.$this->icone.' - '.$this->cor;
	}
                

}
?>