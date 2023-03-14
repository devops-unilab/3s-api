<?php
                
                
namespace app3s\dao;
use PDO;

class DAO {
 
    protected $type;
	protected $connection;
	private $sgdb;
	    
	public function getSgdb(){
		return $this->sgdb;
	}
	/**
	 * Undocumented function
	 *
	 * @param PDO|null $connection
	 * @param string $type
	 */
	public function __construct(PDO $connection = null, $type = "default") {
	    $this->type = $type;
		if ($connection  != null) {
			$this->connection = $connection;
		} else {
			$this->connect();
		}
	}
	    
	public function connect() {
	    if($this->type === "default"){
			$sgdb = env('DB_CONNECTION');
			$dbName = env('DB_DATABASE');
			$host = env('DB_HOST');
			$port = env('DB_PORT');
			$user = env('DB_USERNAME');
			$password = env('DB_PASSWORD');
		}else if($this->type === "SIG"){
			echo "Passei aqui";
			$sgdb = env('DB_CONNECTION_SIGAA');
			$dbName = env('DB_DATABASE_SIGAA');
			$host = env('DB_HOST_SIGAA');
			$port = env('DB_PORT_SIGAA');
			$user = env('DB_USERNAME_SIGAA');
			$password = env('DB_PASSWORD_SIGAA');
		}

	    $this->sgdb = $sgdb;

		if ($sgdb == "pgsql") {
			if($this->type === "SIG"){
				echo "Fix conexao no sig";
			}
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