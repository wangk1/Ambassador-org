<?php

class Account{
	private $id;
	private $type;
	
	public function __construct($id=null, $type=null) {
		
		$this->id=$id;
		$this->type=$sid;
	
		
	}
	
	public function getId() {
		return $this->id;
		
	}
	
	public function getType() {
		return $this->type;
		
	}
	
	
	public static function create($type) {
		$sql=SQLObj::getSQLObj();
		
		$stmt=$sql->generateInsertStatement('account'
				, array('type')
				, func_get_args());
		
		$key=$sql->execute($stmt,true);
		
		//return primary key
		return new Student($key);
		
	}
	
	public static function get($id,$type=null) {
		$sql=SQLObj::getSQLObj();
		
		$columns=array('id','type');
		$operators=array('=','=');
	
		
		$stmt=$sql->generateSelectStatement('account',$columns,$operators,func_get_args());
		
		
		$result=$sql->execute($stmt);
		
		$result=mysqli_fetch_all($result,MYSQLI_ASSOC);
		
		
		print_r($result);
		$r=array();
		foreach($result as $rows) {
			$r[]=new Account($rows['id'],$rows['type']);
			
		}
		
		return $r;
	}
	
	public static function update($id, $type) {
		$sql=SQLObj::getSQLObj();
		
		$columns=array('id','type');
		
		$args=func_get_args();
		$args[0]=null;
		
		
		$stmt=$sql->generateUpdateStatement('account'
				, 'id', $id ,$columns,$args);
		
		
		$sql->execute($stmt);
	}
	
	public static function delete($id) {
		$sql=SQLObj::getSQLObj();
		
		$stmt=$sql->generateDeleteFromStatement('account', 'id', $id);
		
		$sql->execute($stmt);
		
	}
	
}