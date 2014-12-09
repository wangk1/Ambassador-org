<?php

class DBManager {
	//local
	CONST HOST="localhost";
	CONST USER="root";
	CONST PASSWORD="";
	CONST DATABASE="ambassador";
// 	//classroom
// 	CONST HOST="https://classroom.cs.unc.edu";
// 	CONST USER="wangk1";
// 	CONST PASSWORD="password";
// 	CONST DATABASE="wangk1db";
	
	
	private static $manager;
	
	private $mysqli;	
	
	private function __construct() {
		
	}
	
	public function getLink() {
		return $this->mysqli;
		
	}
	
	
	public function connect() {
		$this->mysqli = mysqli_connect ( DBManager::HOST, DBManager::USER, DBManager::PASSWORD, DBManager::DATABASE );
	}
	
	public function close() {
		mysqli_close($this->mysqli);
		
	}
	
	public static function getManager() {
		if(!isset(DBManager::$manager)) {
			DBManager::$manager=new DBManager();
			
		}
		
		return DBManager::$manager;
		
	}
	
	public static function createStudent($email,$password, $first,$last
			,$schoolname,$schoolcity,$schoolcountry,$schoolstate) {
		
		
		
	}
	
	public static function createCompany() {
		
		
	}
}


?>