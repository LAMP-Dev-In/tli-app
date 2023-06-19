<?php 
//autoload
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


//autoload 
include (__DIR__ . "/autoload.php");

define('VIEW_PATH', __DIR__ .'/app/View');

$uri = explode('/', $_SERVER['REQUEST_URI']);

// check request URL
if(!isset($uri[2]) or $uri[2] ==''){
    header("Location: ./index/customer");
}


use App\Controller\CustomerController;
use App\Controller\PremiumServiceController;

switch ($uri['3']) {
    case 'customer':
        $customer = new CustomerController($conn);
        if(!isset($uri[4]) or $uri[4]==''){
            $response = $customer->getAllAction();
        }elseif(isset($uri[4]) and is_numeric($uri[4])){
            $id = (int)$uri['4'];
            $response = $customer->getCustomerById($id);
        }elseif(isset($uri[4]) and $uri[4] == 'create'){
            $response = $customer->create();
        }elseif(isset($uri[4]) and $uri[4] == 'store'){
            $response = $customer->store();
        }

        break;
    case 'visa':
        $visa = new PremiumServiceController($conn);
        if(!isset($uri[4]) or $uri[4]==''){
            $response = $visa->getAllAction();
        }elseif(isset($uri[4]) and is_numeric($uri[4])){
            $id = (int)$uri['4'];
            $response = $visa->getServiceById($id);
        }elseif(isset($uri[4]) and $uri[4] == 'create'){
            $response = $visa->create();
        }elseif(isset($uri[4]) and $uri[4] == 'store'){
            $response = $visa->store();
        }

        break;    
    
    default:
        break;
}

echo $response;
?>
   