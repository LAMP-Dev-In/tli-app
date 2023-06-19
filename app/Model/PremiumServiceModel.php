<?php

namespace App\Model;

/**
 * PremiumService model to run actions on DB
 */
class PremiumServiceModel
{
	/**
	 * table name
	 * @var string
	 */
	private $table;

	/**
	 * Class constructor
	 * @param object $db database connection object
	 */
	public function __construct(private $conn)
	{
	  $this->table = 'premium_services';
	}


	public function getAllPremiumServices(): array 
	{
      // prepare statement
      $stmt = $this->conn->prepare("SELECT * FROM ". $this->table);
      $stmt->execute();
      $premium_services = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $premium_services;

	}

}