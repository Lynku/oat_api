<?php 
//for json file 
#define('DATA_STORAGE_TYPE', 'Json');
#$DATA_STORAGE = __DIR__."/data/testtakers.json";

//for json csv
#define('DATA_STORAGE_TYPE', 'csv');
#$DATA_STORAGE = __DIR__."/data/testtakers.csv";

//for json MYSQL
define('DATA_STORAGE_TYPE', 'mysql');
$DATA_STORAGE = new PDO("mysql:dbname=r41998vh_alin;host=localhost", 'r41998vh_alin', '+[4sb3i[uH=H');

spl_autoload_register(function ($class) {
     // base directory 
	$base_dir = __DIR__ . '/';
	//file
	$file = $base_dir . str_replace('\\', '/', $class) . '.php';
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

//Boostrap
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if(!empty($_GET['method'])){ 
		$HandlerFactory = HandlerFactory::getHandler(DATA_STORAGE_TYPE, $DATA_STORAGE);
 		$request = new Request($HandlerFactory);
		$methodName  =  'Action'.$_GET['method'];
		if(method_exists($request ,$methodName)){
			if(is_callable(array($request ,$methodName))){
				unset($_GET['method']);
				$params = $_GET;
				try{
 					$request->{$methodName}($params);
 				} catch (Exception $e){
					header($_SERVER['SERVER_PROTOCOL'] . ' Invalid request', true, 500);
					throw new Exception("Invalid request!");		
				}
			}
		}else{
			header($_SERVER['SERVER_PROTOCOL'] . ' No such request', true, 404);
			throw new Exception("No such request!");
		}
	}
}