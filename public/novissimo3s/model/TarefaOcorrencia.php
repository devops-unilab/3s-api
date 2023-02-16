<?php
            
/**
 * Classe feita para manipulação do objeto TarefaOcorrencia
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */

namespace novissimo3s\model;

class TarefaOcorrencia {
	private $id;
	private $ocorrencia;
	private $tarefa;
	private $usuario;
	private $dataInclusao;
    public function __construct(){

        $this->ocorrencia = new Ocorrencia();
        $this->usuario = new Usuario();
    }
	public function setId($id) {
		$this->id = $id;
	}
		    
	public function getId() {
		return $this->id;
	}
	public function setOcorrencia(Ocorrencia $ocorrencia) {
		$this->ocorrencia = $ocorrencia;
	}
		    
	public function getOcorrencia() {
		return $this->ocorrencia;
	}
	public function setTarefa($tarefa) {
		$this->tarefa = $tarefa;
	}
		    
	public function getTarefa() {
		return $this->tarefa;
	}
	public function setUsuario(Usuario $usuario) {
		$this->usuario = $usuario;
	}
		    
	public function getUsuario() {
		return $this->usuario;
	}
	public function setDataInclusao($dataInclusao) {
		$this->dataInclusao = $dataInclusao;
	}
		    
	public function getDataInclusao() {
		return $this->dataInclusao;
	}
	public function __toString(){
	    return $this->id.' - '.$this->ocorrencia.' - '.$this->tarefa.' - '.$this->usuario.' - '.$this->dataInclusao;
	}
                

}
?>