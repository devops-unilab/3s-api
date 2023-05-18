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

        $this->connection = new PDO(
            'pgsql:host=' . env('DB_HOST') .
                ' port=' . env('DB_PORT') .
                ' dbname=' .  env('DB_DATABASE') .
                ' user=' . env('DB_USERNAME') .
                ' password=' . env('DB_PASSWORD')
        );
    }
    public function getConnection()
    {
        return $this->connection;
    }
}
