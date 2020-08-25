
<?php
            
/**
 * Classe feita para manipulação do objeto PermissaoUsuario
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class PermissaoUsuario {
	private $id;
	private $perfil;
	private $idUsuarioSigaa;
	private $usuario;
	private $email;
	private $setor;
    public function __construct(){

        $this->setor = new AreaResponsavel();
    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setPerfil($perfil) {
		$this->perfil = $perfil;
	}
		    
	public function getPerfil() {
		return $this->perfil;
	}
	public function setIdUsuarioSigaa($idUsuarioSigaa) {
		$this->idUsuarioSigaa = $idUsuarioSigaa;
	}
		    
	public function getIdUsuarioSigaa() {
		return $this->idUsuarioSigaa;
	}
	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}
		    
	public function getUsuario() {
		return $this->usuario;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
		    
	public function getEmail() {
		return $this->email;
	}
	public function setSetor(AreaResponsavel $areaResponsavel) {
		$this->setor = $areaResponsavel;
	}
		    
	public function getSetor() {
		return $this->setor;
	}
	public function __toString(){
	    return $this->id.' - '.$this->perfil.' - '.$this->idUsuarioSigaa.' - '.$this->usuario.' - '.$this->email.' - '.$this->setor;
	}
                

}
?>