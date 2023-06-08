<?php


namespace app3s\dao;

use PDO;

class DAO
{


	protected $connection;


	/**
	 * Undocumented function
	 *
	 * @param PDO|null $connection
	 */
	public function __construct(PDO $connection = null)
	{
		if ($connection  != null) {
			$this->connection = $connection;
		} else {
			$this->connect();
		}
	}

	public function connect()
	{

		$dbName = env('DB_DATABASE');
		$host = env('DB_HOST');
		$port = env('DB_PORT');
		$user = env('DB_USERNAME');
		$password = env('DB_PASSWORD');


		$this->connection = new PDO('pgsql:host=' . $host . ' port=' . $port . ' dbname=' . $dbName . ' user=' . $user . ' password=' . $password);
	}

	public function getConnection()
	{
		return $this->connection;
	}
}
