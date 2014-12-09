<?php

require_once 'SQLObj.php';

class Login{
	
	private $id;
	private $email;
	private $password;
	
	public function __construct($id=null, $email=null, $password=null) {
		$this->id=$id;
		$this->email=$email;
		$this->password=$password;
	
	}
	public function getPid() {
		return $this->id;
	}
	public function getCid() {
		return $this->email;
	}
	public function getSid() {
		return $this->password;
	}
	
	
	public static function create($id, $email, $password) {
		$sql = SQLObj::getSQLObj ();
	
		$stmt = $sql->generateInsertStatement ( 'login', array (
				'id',
				'email',
				'password'
		), func_get_args () );
	
		$key = $sql->execute ( $stmt, true );
	
		// return primary key
		return new Login ( $key );
	}
	public static function get($id, $email, $password) {
		$sql = SQLObj::getSQLObj ();
	
		$columns = array (
				'id',
				'email',
				'password'
		);
		$operators = array (
				'=',
				'=',
				'=',
				
		);
	
		$stmt = $sql->generateSelectStatement ( 'login', $columns, $operators, func_get_args () );
	
		$result = $sql->execute ( $stmt );
	
		$result = mysqli_fetch_all ( $result, MYSQLI_ASSOC );
	
	
		$r = array ();
		foreach ( $result as $rows ) {
			$r [] = new Login ( $rows ['ID'], $rows ['email'], $rows ['password']);
		}
	
		return $r;
	}
	public static function update($id, $email, $password) {
		$sql = SQLObj::getSQLObj ();
	
		$columns = array (
				'id',
				'email',
				'password'
		);
	
		$args = func_get_args ();
		$args [0] = null;
	
		$stmt = $sql->generateUpdateStatement ( 'login', 'id', $pid, $columns, $args );
	
		$sql->execute ( $stmt );
	}
	public static function delete($id) {
		$sql = SQLObj::getSQLObj ();
	
		$stmt = $sql->generateDeleteFromStatement ( 'login', 'id', $id );
	
		$sql->execute ( $stmt );
	}
	
	
}

?>