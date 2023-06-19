<?php
/**
 * autoload rules to load controller, model, view 
 * and config files as needed
 */
spl_autoload_register(function($class){
    $path = __DIR__ .'/'. lcfirst(str_replace('\\','/', $class)) . '.php';

    require $path;
});


use App\Config\DatabaseConn;



//get environment data from config
if(file_exists('./app/Config/config.ini')){
    $env = parse_ini_file("./app/Config/config.ini");
}


//get database connection
$db = new DatabaseConn($env['DB_HOST'],$env['DB_NAME'],$env['DB_USERNAME'],$env['DB_PASSWORD']);
$conn = $db->connect();
