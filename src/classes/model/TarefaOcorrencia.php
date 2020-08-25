
<?php
            
/**
 * Classe feita para manipulação do objeto TarefaOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class TarefaOcorrencia {
	private $id;
	private $idOcorrencia;
	private $tarefa;
	private $idUser;
	private $dtInclusao;
    public function __construct(){

    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setIdOcorrencia($idOcorrencia) {
		$this->idOcorrencia = $idOcorrencia;
	}
		    
	public function getIdOcorrencia() {
		return $this->idOcorrencia;
	}
	public function setTarefa($tarefa) {
		$this->tarefa = $tarefa;
	}
		    
	public function getTarefa() {
		return $this->tarefa;
	}
	public function setIdUser($idUser) {
		$this->idUser = $idUser;
	}
		    
	public function getIdUser() {
		return $this->idUser;
	}
	public function setDtInclusao($dtInclusao) {
		$this->dtInclusao = $dtInclusao;
	}
		    
	public function getDtInclusao() {
		return $this->dtInclusao;
	}
	public function __toString(){
	    return $this->id.' - '.$this->idOcorrencia.' - '.$this->tarefa.' - '.$this->idUser.' - '.$this->dtInclusao;
	}
                

}
?>