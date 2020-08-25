
<?php
            
/**
 * Classe feita para manipulação do objeto Perfil
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class Perfil {
	private $id;
	private $nome;
	private $sigla;
    public function __construct(){

    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
		    
	public function getNome() {
		return $this->nome;
	}
	public function setSigla($sigla) {
		$this->sigla = $sigla;
	}
		    
	public function getSigla() {
		return $this->sigla;
	}
	public function __toString(){
	    return $this->id.' - '.$this->nome.' - '.$this->sigla;
	}
                

}
?>