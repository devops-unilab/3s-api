<?php
            
/**
 * Classe feita para manipulação do objeto Usuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace app3s\model;

class Usuario {
	private $id;
	private $nome;
	private $email;
	private $login;
	private $senha;
	private $nivel;
	private $idSetor;
	public $idUnidade;
	public $siglaUnidade; 
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
	public function setEmail($email) {
		$this->email = $email;
	}
		    
	public function getEmail() {
		return $this->email;
	}
	public function setLogin($login) {
		$this->login = $login;
	}
		    
	public function getLogin() {
		return $this->login;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
	}
		    
	public function getSenha() {
		return $this->senha;
	}
	public function setNivel($nivel) {
		$this->nivel = $nivel;
	}
		    
	public function getNivel() {
		return $this->nivel;
	}
	public function setIdSetor($idSetor) {
		$this->idSetor = $idSetor;
	}
		    
	public function getIdSetor() {
		return $this->idSetor;
	}
	public function getStrNivel() {
		$strNivel = 'Desconhecido';
		switch($this->nivel) {
			case 'a':
				$strNivel = 'Administrador';
				break;
			case 't':
				$strNivel = 'Técnico';
				break;
			case 'c':
				$strNivel = 'Comum';
				break;
			default: 
				$strNivel = 'Desconhecido';
			break;
		}
		return $strNivel;
	}
	public function __toString(){
	    return $this->id.' - '.$this->nome.' - '.$this->email.' - '.$this->login.' - '.$this->senha.' - '.$this->nivel.' - '.$this->idSetor;
	}
                

}
?>