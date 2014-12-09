<?php
require_once 'BaseObject.php';


class UserObject extends BaseObject{
	
	public function __construct() {
	}
	
	/**Create new student account<p>
	 * 
	 * */
	public function createNewStudent($email,$hashedpassword, $first, $last, $major=null, $minor=null) {
		$id=$this->insertNewAccountEntry('student');
		
		$this->insertNewLoginEntry($id, $email, $hashedpassword);
		
		
		$stmt=$this->generateInsertStatement('student',array('id','first','last'), array($id,$first, $last));
		
		$this->execute($stmt);
	}
	
	public function createNewCompany($email, $password_hash,$name,$city,$country,$state,$website,$shortname) {
		if(!isset($shortname)) {
			$shortname=$name;
			
		}
		
		$id=$this->insertNewAccountEntry('company');
		$this->insertNewLoginEntry($id, $email, $password_hash);
		
		$stmt=$this->generateInsertStatement('company',array('id','shortname','city','country','state','website','name'),array($id,$shortname,$city,$country,$state,$website,$name));
		
		$this->execute($stmt);
		
	}
	
	
	
	/**
	 * Create a new entry in the account table that has type enum of $type.<p>
	 * This method returns the primary key of the newly inserted row.
	 * */
	private function insertNewAccountEntry($type) {
		//insert into the account table
		$this->execute("INSERT INTO account(type) VALUES ('".mysqli_real_escape_string($this->getMySqli(), $type)."');");
	
		//return the primary key of the insert
		return mysqli_insert_id($this->getMySqli());
	
	}
	
	private function insertNewLoginEntry($id, $email, $password_hash) {
		//insert into the account table
		$this->execute("INSERT INTO login(id,email,password) VALUES ('".$id."','".$email."','".$password_hash."');");
		
	}
	
	
	
	
	
}


?>