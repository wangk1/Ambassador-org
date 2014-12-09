<?php
require_once 'SQLObj.php';

class Student{	
	private $id;
	private $sid;
	private $first;
	private $last;
	private $year;
	
	public function __construct($id=null, $sid=null, $first=null, $last=null,$year=null) {
		
		$this->id=$id;
		$this->sid=$sid;
		$this->first=$first;
		$this->last=$last;
		$this->year=$year;
		
	}
	
	public function getId() {
		return $this->id;
		
	}
	
	public function getSid() {
		return $this->sid;
		
	}
	
	public function getFirst() {
		return $this->first;
		
	}
	
	public function getLast() {
		return $this->last;
		
	}
	
	public function getYear() {
		return $this->year;
		
	}
	
	public static function create($id, $sid=-1, $first, $last,$year) {
		$sql=SQLObj::getSQLObj();
		
		$stmt=$sql->generateInsertStatement('student'
				, array('id','sid','first','last','year')
				, func_get_args());
		
		$key=$sql->execute($stmt,true);
		
		//return primary key
		return new Student($key);
		
	}
	
	public static function get($id,$sid,$first,$last,$year) {
		$sql=SQLObj::getSQLObj();
		
		$columns=array('id','sid','first','last','year');
		$operators=array('=','=','=','=','=');
	
		
		$stmt=$sql->generateSelectStatement('student',$columns,$operators,func_get_args());
		
		
		$result=$sql->execute($stmt);
		
		$result=mysqli_fetch_all($result,MYSQLI_ASSOC);
		
				$r=array();
		foreach($result as $rows) {
			$r[]=new Student($rows['ID'],$rows['sid'],$rows['first']
					,$rows['last'],$rows['year']);
			
		}
		
		return $r;
	}
	
	public static function update($id, $sid, $first, $last,$year) {
		$sql=SQLObj::getSQLObj();
		
		$columns=array('id','sid','first','last','year');
		
		$args=func_get_args();
		$args[0]=null;
		
		
		$stmt=$sql->generateUpdateStatement('student'
				, 'id', $id ,$columns,$args);
		
		
		$sql->execute($stmt);
	}
	
	public static function delete($id) {
		$sql=SQLObj::getSQLObj();
		
		$stmt=$sql->generateDeleteFromStatement('student', 'id', $id);
		
		$sql->execute($stmt);
		
	}
	
	
	
}