<?php
                
                
class DAO {
 
    protected $arquivoIni;
	protected $conexao;
	private $sgdb;
	    
	public function getSgdb(){
		return $this->sgdb;
	}
	public function __construct(PDO $conexao = null, $arquivoIni = DB_INI) {
	    $this->arquivoIni = $arquivoIni;
		if ($conexao  != null) {
			$this->conexao = $conexao;
		} else {
			$this->fazerConexao ();
		}
	}
	    
	public function fazerConexao() {
	    $config = parse_ini_file ( $this->arquivoIni );

		$sgdb = $config ['sgdb'];
		$bdNome = $config ['bd_nome'];
		$host = $config ['host'];
		$porta = $config ['porta'];
		$usuario = $config ['usuario'];
		$senha = $config ['senha'];
	    $this->sgdb = $sgdb;

		if ($sgdb == "postgres") {
			$this->conexao = new PDO ( 'pgsql:host=' . $host. ' port='.$porta.' dbname=' . $bdNome . ' user=' . $usuario . ' password=' . $senha );

		} else if ($sgdb == "mssql") {
			$this->conexao = new PDO ( 'dblib:host=' . $host . ';dbname=' . $bdNome, $usuario, $senha);
		}else if($sgdb == "mysql"){
			$this->conexao = new PDO( 'mysql:host=' . $host . ';dbname=' .  $bdNome, $usuario, $senha);
		}else if($sgdb == "sqlite"){
			$this->conexao = new PDO('sqlite:'.$bdNome);
		}
		
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
}
	    
?>
		