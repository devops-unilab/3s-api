
<?php
            
/**
 * Classe feita para manipulação do objeto AreaResponsavel
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class AreaResponsavel {
	private $id;
	private $nome;
	private $descricao;
	private $email;
	private $idAdmin;
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
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
		    
	public function getDescricao() {
		return $this->descricao;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
		    
	public function getEmail() {
		return $this->email;
	}
	public function setIdAdmin($idAdmin) {
		$this->idAdmin = $idAdmin;
	}
		    
	public function getIdAdmin() {
		return $this->idAdmin;
	}
	public function __toString(){
	    return $this->id.' - '.$this->nome.' - '.$this->descricao.' - '.$this->email.' - '.$this->idAdmin;
	}
                

}
?>