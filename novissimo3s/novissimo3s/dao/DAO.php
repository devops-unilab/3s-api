<?php
                
                
namespace novissimo3s\dao;
use PDO;

class DAO {
 
    protected $iniFile;
	protected $connection;
	private $sgdb;
	    
	public function getSgdb(){
		return $this->sgdb;
	}
	public function __construct(PDO $connection = null, $iniFile = DB_INI) {
	    $this->iniFile = $iniFile;
		if ($connection  != null) {
			$this->connection = $connection;
		} else {
			$this->connect();
		}
	}
	    
	public function connect() {
	    $config = parse_ini_file ( $this->iniFile );

		$sgdb = $config ['sgdb'];
		$dbName = $config ['db_name'];
		$host = $config ['host'];
		$port = $config ['port'];
		$user = $config ['user'];
		$password = $config ['password'];
	    $this->sgdb = $sgdb;

		if ($sgdb == "postgres") {
			$this->connection = new PDO ( 'pgsql:host=' . $host. ' port='.$port.' dbname=' . $dbName . ' user=' . $user . ' password=' . $password);
		} else if ($sgdb == "mssql") {
			$this->connection = new PDO ( 'dblib:host=' . $host . ';dbname=' . $dbName, $user, $password);
		}else if($sgdb == "mysql"){
			$this->connection = new PDO( 'mysql:host=' . $host . ';dbname=' .  $dbName, $user, $password);
		}else if($sgdb == "sqlite"){
			$this->connection = new PDO('sqlite:'.$dbName);
		}
		
	}
	public function setConnection($connection) {
		$this->connection = $connection;
	}
	public function getConnection() {
		return $this->connection;
	}
	public function closeConnection() {
		$this->connection = null;
	}
}
	    
?>