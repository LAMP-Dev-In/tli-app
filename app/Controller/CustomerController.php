<?php
	namespace App\Controller;
/*
 *  Customer controller to have actions for customer
 */

 use App\Model\CustomerModel;
 use App\View\View;
 
class CustomerController
{
	/**
	 * to hold customer model object
	 * @var object
	 */
	protected $customer_model;

	/**
	 * to hold request data
	 * @var array
	 */
	protected $data= array();

	/**
	 * resourse ID
	 * @var int
	 */
	protected $customer_id;



	/**
	 * construct initialize db connection object
	 */
	public function __construct(public $conn)
	{		
		$this->customer_model = new CustomerModel($this->conn);
	}




	/**
	 * to get row count for a resource 
	 * @return int     row count
	 */
	protected function getResultSetRowCount(): int
	{
		$num = 0;

		// call read action on customer model object
		$this->customer_model->setId($this->customer_id);

		// get row count
		 $num = $this->customer_model->getResultSetRowCountById();

		return $num;
	}




	/**
	 * Action for GET verb to list resource 
	 * 
	 * @return array   response
	 */
	public function getAllAction(): string
	{
	  // call read action on customer model object			
	  $customers_agent_service = $this->customer_model->getCustomerAgentServices();

	  return (string)View::make('Customer/Index', ['customers' => $customers_agent_service] );	

	}




	/**
	 * Action for GET verb to read an individual resource 
	 * 
	 * @return array   response
	 */
	public function getCustomerById($id): array
	{
		$data = $this->customer_model->getCustomerDetailsById($id);

		$response = array('message' => 'info of individual resource ','status' => '1', 'data' => $data);

		return $response;
	}


	/**
	 * create resource 
	 * 
	 * @return string   response
	 */
	public function create(): string
	{

	  return (string)View::make('Customer/Create', ['foo' => 'bar']);	

	}

	/**
	 * store resource 
	 * 
	 * @return string   response
	 */
	public function store(): string
	{

	  return 'Store Customer';	

	}




	/**
	 * Action for POST verb to create an individual resource 
	 * 
	 * @return array   response
	 */
/* 	protected function postAction(): array
	{
		// empty data, return status as 0
		if(empty($this->data)){			
			$response =	array('message' => 'invalid resource data','status' => '0');
			return $response;			
		}

		$customer_table_fields = $this->customer_model->getCustomerTableFields();

		foreach ($this->data as $key => $value) {

		  // get values
		  $setter_value = (array_key_exists($key, $customer_table_fields)) ? $key : null;

		  if (!empty($setter_value)) {

		  	 // validation
		    $setter_value = $this->validateParameter($key, $this->data[$key], false);
		  	
		    // values to model
		    $this->setCustomerSetterMethodWithValue($key, $setter_value);
		  }

		}

		// call insert action on customer model object		
		$result = $this->customer_model->insert();

		$response = ($result) ? array('message' => 'resource submitted','status' => '1') : array('message' => 'resource not submitted','status' => '0');

		return $response;

	} */



	/**
	 *  Dynamically create setter and pass value to it
	 *  to set into model  
	 *  
	 * @param string $setter_key   key to creaye setter
	 * @param string $setter_value value to pass into setter 
	 *
	 * @return boolean
	 */
    protected function setCustomerSetterMethodWithValue($setter_key, $setter_value): bool
    {
    	$customer_table_fields = $this->customer_model->getCustomerTableFields();

    	$setter_method = 'set'.ucfirst($customer_table_fields[$setter_key]['method']);

		$this->customer_model->$setter_method($setter_value);

		return true;

    }

}