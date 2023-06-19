<?php
	namespace App\Controller;
/*
 *  Premium Service controller to have actions for customer
 */

 use App\Model\PremiumServiceModel;
 use App\View\View;
 
class PremiumServiceController
{
	/**
	 * to hold premium service model object
	 * @var object
	 */
	protected $premium_service_model;

    /**
	 * construct initialize db connection object
	 */
	public function __construct(public $conn)
	{		
		$this->premium_service_model = new PremiumServiceModel($this->conn);
	}

	/**
	 * Action for GET verb to list resource 
	 * 
	 * @return array   response
	 */
	public function getAllAction(): string
	{
	  // call read action on customer model object			
	  $premium_service = $this->premium_service_model->getAllPremiumServices();

	  return (string)View::make('Service/Index', ['premium_services' => $premium_service] );	

	}
	/**
	 * Action for GET verb to read an individual resource 
	 * 
	 * @return array   response
	 */
	public function getServiceById($id): array
	{
		$data = $this->premium_service_model->getServiceDetailsById($id);

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

}