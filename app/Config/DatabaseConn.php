<?php

namespace App\Config;

/*
 *  DB connection with PDO
 */
class DatabaseConn 
{

    private $conn;


    /**
     * Constructor 
     * @property promotion
     */
    function __construct(
        private string $hostname,
        private string $dbname,
        private string $username,
        private string $password,
        ){}

	//DB connect
	public function connect()
	{
		global $config;

		$this->conn = null;

		try{
			//PDO object
			$this->conn = new \PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->dbname,$this->username, $this->password);

			$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		} catch(\PDOException $e) {
			echo 'Connection Error: '.$e->getMessage();			
		}

		return $this->conn;
	}
	
}
