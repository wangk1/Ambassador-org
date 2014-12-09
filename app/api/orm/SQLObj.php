<?php
require_once 'orm/DBManager.php';

final class SQLObj {
	public static $SELECTLIMIT=20;
	private static $sql;
	
	private $mysqli;
	
	// constructor
	private function __construct() {
		$this->mysqli=DBManager::getManager()->getLink();
		
	}
	
	public function setSelectLimit($limit) {
		SQLObj::$SELECTLIMIT=$limit;
		
	}
	
	public function execute($query,$returnKey=false) {
		echo $query;
		
		if($returnKey) {
			mysqli_query($this->mysqli, $query );
			
			return mysqli_insert_id(DBManager::getManager()->getLink());
		}
		
		return mysqli_query($this->mysqli, $query );
	}

	
	/**
	 * Generate insert statement from the inputs and sanitizes
	 *
	 * @param unknown $arrayOfCols        	
	 * @param unknown $arguments        	
	 * @return string
	 */
	public function generateInsertStatement($table, $arrayOfCols, $arguments) {
		$sanitized = array ();
		
		foreach ( $arguments as $a ) {
			$sanitized [] = mysqli_escape_string ( $this->mysqli, $a );
		}
		
		$stmt = "INSERT INTO " . $table . "(" . implode ( ',', $arrayOfCols ) . ") VALUES ('" . implode ( "','", $sanitized ) . "');";
		
		return $stmt;
	}
	
	/**
	 * Generates a update statement
	 *
	 * @param unknown $table        	
	 * @param unknown $arrayOfCols        	
	 * @param unknown $arguments        	
	 */
	public function generateUpdateStatement($table, $idname, $id, $columns, $arguments) {
		
		$length=count($arguments);
		
		$sanitized = array ();
		
		//check if any arguments are not provided
		for($i=0;$i<$length;$i++) {
			$value=$arguments[$i];
		
			if(!isset($value)) {
				//if the value for that param does not exist, splice it ut
				$columns[$i]=null;
		
		
			} else {
				//put into array of arguments
				$sanitized[]=mysqli_escape_string ( $this->mysqli, $value );
		
			}
		
		}
		
		$columns=SQLObj::eliminateNulls($columns);
		
		// sanitize id
		$id = mysqli_escape_string ( $this->mysqli, $id );
		
		$length = count ( $sanitized );
		
		$stmt = "UPDATE " . $table . " SET " . $columns [0] . "='" . $sanitized [0] . "'";
		
		// we need to concat all the other update elements too if length >1
		if ($length > 1) {
			
			for($i = 1; $i < $length; $i ++) {
				
				$stmt = $stmt . "," . $columns [$i] . "='" . $sanitized [$i] . "'";
			}
		}
		
		$stmt = $stmt . " WHERE " . $idname . "='" . $id . "';";
		
		return $stmt;
	}
	
	/**Generate select statement to $table with arguments in array of cols with operator to $argumetns
	 * 
	 * @param unknown $table
	 * @param unknown $arrayOfCols
	 * @param unknown $operator
	 * @param unknown $arguments
	 * @return string
	 */
	public function generateSelectStatement($table, $arrayOfCols, $operator,$arguments) {
		$length=count($arguments);
		
		$sanitized = array ();
		
		
		
		//check if any arguments are not provided
		for($i=0;$i<$length;$i++) {
			$value=$arguments[$i];
		
			if(!isset($value)) {
				//if the value for that param does not exist, splice it ut
				$arrayOfCols[$i]=null;
		
		
			} else {
				//put into array of arguments
				$sanitized[]=mysqli_escape_string ( $this->mysqli, $value);
		
			}
		
		}
		
		//eliminate the columns that does not have a parameter
		$arrayOfCols=SQLObj::eliminateNulls($arrayOfCols);
		
		$stmt = "SELECT * FROM " . $table;
		
		$length = count ( $arrayOfCols );
		
		if ($length > 0) {
			
			$stmt=$stmt." WHERE ".$arrayOfCols[0].$operator[0]."'".$sanitized[0]."'";
			
			if($length>1) {
				
				for($i=1; $i<$length;$i++)
					$stmt=$stmt." AND ".$arrayOfCols[$i]
						.$operator[$i]."'".$sanitized[$i]."'";
				
			}
			
			//put in update limit and close off
			$stmt = $stmt . " LIMIT ".SQLObj::$SELECTLIMIT;
		}
		
		$stmt=$stmt.";";
		
		return $stmt;
	}
	
	public function generateDeleteFromStatement($table, $idname, $id) {
		$stmt="DELETE FROM ".$table
			." WHERE ".$idname."= '"
					.mysqli_escape_string($this->mysqli, $id)."';";	
		
		return $stmt;
	}
	

	public static function getSQLObj() {
		if(!isset(SQLObj::$sql)) {
			SQLObj::$sql=new SQLObj();
			
		}
		
		return SQLObj::$sql;
		
	}
	
	public static function eliminateNulls($array) {
		$length=count($array);
		
		for($i=0;$i<$length;$i++) {
			if(!isset($array[$i])) {
				array_splice($array, $i,1);
				$length--;
				$i--;
				
			}
			
		}
		
		return $array;
		
	}
}

?>