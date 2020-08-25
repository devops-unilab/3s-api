<?php
                
                
class DAO {
	const ARQUIVO_CONFIGURACAO = "/dados/3s/3s_bd.ini";
	    
	protected $conexao;
	private $tipoDeConexao;
	private $sgdb;
	    
	public function getSgdb(){
		return $this->sgdb;
	}
	public function DAO(PDO $conexao = null) {
		if ($conexao != null) {
			$this->conexao = $conexao;
		} else {
	    
			$this->fazerConexao ();
		}
	}
	public function getEntidadeUsuarios(){
		return $this->entidadeUsuarios;
	}
	    
	    
	public function fazerConexao() {
		$config = parse_ini_file ( self::ARQUIVO_CONFIGURACAO );
		$bd = array();
		$bd ['sgdb'] = $config ['sgdb'];
		$bd ['bd_nome'] = $config ['bd_nome'];
		$bd ['host'] = $config ['host'];
		$bd ['porta'] = $config ['porta'];
		$bd ['usuario'] = $config ['usuario'];
		$bd ['senha'] = $config ['senha'];
	    
		if ($bd ['sgdb'] == "postgres") {
			$this->conexao = new PDO ( 'pgsql:host=' . $bd ['host'] . ' dbname=' . $bd ['bd_nome'] . ' user=' . $bd ['usuario'] . ' password=' . $bd ['senha'] );
		} else if ($bd ['sgdb'] == "mssql") {
			$this->conexao = new PDO ( 'dblib:host=' . $bd ['host'] . ';dbname=' . $bd ['bd_nome'], $bd ['usuario'], $bd ['senha'] );
	    
		}else if($bd['sgdb'] == "mysql"){
			$this->conexao = new PDO( 'mysql:host=' . $bd ['host'] . ';dbname=' .  $bd ['bd_nome'], $bd ['usuario'], $bd ['senha']);
		}else if($bd['sgdb']== "sqlite"){
			$this->conexao = new PDO('sqlite:'.$bd ['bd_nome']);
		}
		$this->sgdb = $bd['sgdb'];
	}
	public function setConexao($conexao) {
		$this->conexao = $conexao;
	}
	public function getConexao() {
		return $this->conexao;
	}
	public function fechaConexao() {
		$this->conexao = null;
	}
	public function getTipoDeConexao() {
		return $this->tipoDeConexao;
	}
	public function setTipoDeConexao($tipo) {
		$this->tipoDeConexao = $tipo;
	}
}
	    
?>
		