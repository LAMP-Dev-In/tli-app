<?php

namespace App\Model;

/**
 * Customer model to run actions on DB
 */
class CustomerModel
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
	  $this->table = 'customers';
	}


	public function getAllCustomers(): array 
	{
      // prepare statement
      $stmt = $this->conn->prepare("SELECT * FROM ". $this->table);
      $stmt->execute();
      $customers = $stmt->fetchAll(\PDO::FETCH_ASSOC);

      return $customers;

	}

	public function getCustomerAgentServices(): array
	{
		$stmt = $this->conn->prepare("SELECT customers.email as Customer, customers.rank as Rank,customers.status as stat, premium_services.name as Premium_Service, sales_agents.full_name as Agent
		FROM `customer_agent_service` 
		LEFT JOIN customers ON  customer_agent_service.customer_id = customers.id
		LEFT JOIN sales_agents ON  customer_agent_service.agent_id = sales_agents.agent_id
		LEFT JOIN premium_services ON  customer_agent_service.premium_service_id = premium_services.id;");
	    $stmt->execute();
		$customers_agent_service = $stmt->fetchAll(\PDO::FETCH_ASSOC);
	
		return $customers_agent_service;	
	}

	public function getCustomerDetailsById($id): array
	{	
      $stmt =  $this->getResultSetById($id);
      $customer = $stmt->fetch(\PDO::FETCH_ASSOC);

      return $customer;
	}


	public function getResultSetRowCountById($id):int 
	{
	  $num = 0;
	  $result = $this->getResultSetById($id);
	  $num = $result->rowCount();

	  return $num;
	}

	/**
	 * method to read collection as well as a resource
	 * from GET verb action call
	 *  
	 * @param  int|integer $id 			resource ID
	 * @return object               	PODStatement Object
	 */
	//public function read():object
	public function getResultSetById($id):object
	{
	  // query to get collection 
	  $query = "SELECT * FROM ". $this->table
					." WHERE id = :customerId";

      // prepare statement
      $stmt = $this->conn->prepare($query);

      // bind param
      $stmt->bindParam(':customerId', $id, \PDO::PARAM_INT);

      // execute query
      $stmt->execute();

      return $stmt;

	}



	/**
	 * method to create a resource 
	 * call from POST verb action
	 * 
	 * @return boolean       
	 */
	public function insert():bool
	{
		// get model table fields
		$customer_table_fields = $this->getCustomerTableFields();

		$set='';
		$i=0;
		$bind_param_array = array();

		// make SET and $bindParam variable
		foreach ($customer_table_fields as $key => $value) {

			if (!empty($this->$key)) {

				$set .= ($i>0?',':'').'`'. $key . '`= :' .$key;	

				$bind_param_array[$key] =  $this->$key ;

				$i++;
			}
		}

		// insert query
		$query = "INSERT INTO "  . $this->table . " SET " . $set;

		$stmt = $this->conn->prepare($query);

		// bind param 
		foreach ($bind_param_array as $key => &$value) {
			$stmt->bindParam($key, $value);	
		}

		if($stmt->execute()){
			return true;
		}

		return false;

	}


	/**
	 *  Customer table fields with type and 
	 *  corresponding methods for setter/getter 
	 *  
	 * @return [type] array
	 */
	public function getCustomerTableFields(): array
	{
		return array('id'   => array('method' => 'id', 'type' => 'INT'),
                     'name' => array('method' => 'name', 'type' => 'STRING'),
                     'description' => array('method' => 'description', 'type' => 'STRING'),
                     'created_at' => array('method' => 'createdAt', 'type' => 'STRING'),
                     'updated_at' => array('method' => 'updatedAt', 'type' => 'STRING')
	                );
	}
	
	
}