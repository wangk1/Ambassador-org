<?php

require_once 'SQLObj.php';

class Posts {
	private $pid;
	private $id;
	private $sid;
	private $title;
	private $enddate;
	private $posteddate;
	
	public function __construct($pid = null, $cid = null, $sid = null, $title = null
			, $enddate = null, $posteddate=null) {
		$this->pid=$pid;
		$this->id=$cid;
		$this->sid=$sid;
		$this->title=$title;
		$this->enddate=$enddate;
		$this->posteddate=$posteddate;

	}
	public function getPid() {
		return $this->pid;
	}
	public function getCid() {
		return $this->cid;
	}
	public function getSid() {
		return $this->sid;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getposteddate() {
		return $this->posteddate;
	}
	public function getEndDate() {
		return $this->enddate;
	}
	public function getCity() {
		return $this->city;
	}

	public static function create($cid, $sid, $title, $enddate, $posteddate) {
		$sql = SQLObj::getSQLObj ();

		$stmt = $sql->generateInsertStatement ( 'posts', array (
				'id',
				'sid',
				'title',
				'enddate',
				'posteddate',
		), func_get_args () );

		$key = $sql->execute ( $stmt, true );

		// return primary key
		return new Student ( $key );
	}
	public static function get($pid=null, $cid=null, $sid=null, $title=NULL
			, $enddate=null, $posteddate=null) {
		$sql = SQLObj::getSQLObj ();

		$columns = array (
				'pid',
				'id',
				'sid',
				'title',
				'enddate',
				'posteddate',
		);
		$operators = array (
				'=',
				'=',
				'=',
				'=',
				'=',
				'='
		);

		$stmt = $sql->generateSelectStatement ( 'posts', $columns, $operators, func_get_args () );

		$result = $sql->execute ( $stmt );

		$result = mysqli_fetch_all ( $result, MYSQLI_ASSOC );

		
		$r = array ();
		foreach ( $result as $rows ) {
			$r [] = new Posts ( $rows ['pid'], $rows ['id'], $rows ['sid'], $rows ['title']
					,$rows['enddate'], $rows ['posteddate']);
		}

		return $r;
	}
	public static function update($pid, $name, $shortname, $city, $country, $state, $website) {
		$sql = SQLObj::getSQLObj ();

		$columns = array (
				'pid',
				'id',
				'sid',
				'title',
				'enddate',
				'posteddate',
		);

		$args = func_get_args ();
		$args [0] = null;

		$stmt = $sql->generateUpdateStatement ( 'posts', 'pid', $pid, $columns, $args );

		$sql->execute ( $stmt );
	}
	public static function delete($id) {
		$sql = SQLObj::getSQLObj ();

		$stmt = $sql->generateDeleteFromStatement ( 'posts', 'pid', $id );

		$sql->execute ( $stmt );
	}
}

?>