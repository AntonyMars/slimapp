<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;


//creating route to get all customers 

$app->get('/api/customers', function(Request $request, Response $response){
	$sql = "SELECT * FROM `customers`";
	try{
		$db = new db();
		$db = $db->connect();

		$stmt = $db->query($sql);
		$customers = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;

		print json_encode( $customers );
	}catch( PDOException $e ){
		print('{"error": {"text": '.$e->getMessage().'}}');
	}

});

//getting information for only one customer

$app->get('/api/customer/{id}', function(Request $request, Response $response){
	
	$id = $request->getAttribute('id'); //grabs ID from the the url


	$sql = "SELECT * FROM `customers` WHERE `id` = {$id}";
	try{
		$db = new db();
		$db = $db->connect();  //connects to the DB

		$stmt = $db->query($sql);
		$customer = $stmt->fetchAll(PDO::FETCH_OBJ); //fetches data from the DB
		$db = null;

		print json_encode( $customer );
	}catch( PDOException $e ){
		print('{"error": {"text": '.$e->getMessage().'}}'); //prints out an error message
	}

});

//adding a single customer

$app->post('/api/customer/add', function(Request $request, Response $response){
	
	$id = $request->getAttribute('id'); //grabs ID from the the url


	$sql = "SELECT * FROM `customers` WHERE `id` = {$id}";
	try{
		$db = new db();
		$db = $db->connect();  //connects to the DB

		$stmt = $db->query($sql);
		$customer = $stmt->fetchAll(PDO::FETCH_OBJ); //fetches data from the DB
		$db = null;

		print json_encode( $customer );
	}catch( PDOException $e ){
		print('{"error": {"text": '.$e->getMessage().'}}'); //prints out an error message
	}

});

?>