<?php
	require_once 'orm/Student.php';
	require_once 'orm/Account.php';
	require_once 'orm/Company.php';
	require_once 'orm/DBManager.php';
	require_once 'orm/Posts.php';
	
	$manager=DBManager::getManager();
	

	
	DBManager::getManager()->connect();
	
	$student=Posts::get(null,14,null,null,null,null,null);//, -1, "Some great position", '2014-12-9', '2014-12-9');
	//14,'Apple Inc.','apple','Coupertino','USA','CA','www.apple.com');
	
	print_r($student);
	
?>