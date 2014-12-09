<?php
session_start ();

require_once "orm/DBManager.php";
require_once "orm/Login.php";

DBManager::getManager ()->connect ();
$_POST = json_decode(file_get_contents('php://input'),true);

// check if everything exists
if (isset ( $_POST )) {
	if (isset ( $_POST ['password'] ) && isset ( $_POST ['email'] )) {
		// fetch the matching email and password from db
		$loginobj = Login::get ( null, $_POST ['email'], $_POST ['password'] );
		
		if (isset ( $loginobj [0] )) {
			// login success
			$_SESSION ['id'] = $loginobj [0]->getPid ();
		}
	} else {
		$error = 'No password and email recieved';
	}
} else {
	$error = 'bad request';
}

//output http response
if (isset ( $error )) {
	header ( $_SERVER ["SERVER_PROTOCOL"] . " 401 ".$error );
} else {
	header ( $_SERVER ["SERVER_PROTOCOL"] . " 200 OK");
	header ( "Content-Type: application/json");
	
	//the body
	echo json_encode(array('id'=>$_SESSION['id']),JSON_FORCE_OBJECT);
}


DBManager::getManager ()->close ();

?>