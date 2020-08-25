
<?php
            
/**
 * Classe feita para manipulação do objeto Servico
 * feita automaticamente com programa gerador de software inventado por
 * @author Jefferson Uchôa Ponte <j.pontee@gmail.com>
 */



class Servico {
	private $id;
	private $nome;
	private $descricao;
	private $ativo;
	private $tempoSla;
	private $areaResponsavel;
	private $grupoServico;
	private $tipoAtividade;
    public function __construct(){

        $this->areaResponsavel = new AreaResponsavel();
        $this->grupoServico = new GrupoServico();
        $this->tipoAtividade = new TipoAtividade();
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
	public function setAtivo($ativo) {
		$this->ativo = $ativo;
	}
		    
	public function getAtivo() {
		return $this->ativo;
	}
	public function setTempoSla($tempoSla) {
		$this->tempoSla = $tempoSla;
	}
		    
	public function getTempoSla() {
		return $this->tempoSla;
	}
	public function setAreaResponsavel(AreaResponsavel $areaResponsavel) {
		$this->areaResponsavel = $areaResponsavel;
	}
		    
	public function getAreaResponsavel() {
		return $this->areaResponsavel;
	}
	public function setGrupoServico(GrupoServico $grupoServico) {
		$this->grupoServico = $grupoServico;
	}
		    
	public function getGrupoServico() {
		return $this->grupoServico;
	}
	public function setTipoAtividade(TipoAtividade $tipoAtividade) {
		$this->tipoAtividade = $tipoAtividade;
	}
		    
	public function getTipoAtividade() {
		return $this->tipoAtividade;
	}
	public function __toString(){
	    return $this->id.' - '.$this->nome.' - '.$this->descricao.' - '.$this->ativo.' - '.$this->tempoSla.' - '.$this->areaResponsavel.' - '.$this->grupoServico.' - '.$this->tipoAtividade;
	}
                

}
?>