<?php
class Company {
	private $id;
	private $name;
	private $shortname;
	private $city;
	private $country;
	private $state;
	private $website;
	public function __construct($id = null, $name = null, $shortname = null, $city = null
			, $country = null, $state=null, $website=null) {
		$this->id = $id;
		$this->name = $name;
		$this->shortname = $shortname;
		$this->city = $city;
		$this->country = $country;
		$this->state=$state;
		$this->website=$website;
		
	}
	public function getId() {
		return $this->id;
	}
	public function getName() {
		return $this->name;
	}
	public function getShortName() {
		return $this->shortname;
	}
	public function getState() {
		return $this->state;
	}
	public function getCountry() {
		return $this->country;
	}
	public function getWebsite() {
		return $this->website;
	}
	public function getCity() {
		return $this->city;
	}

	public static function create($id, $name, $shortname=null, $city, $country, $state, $website) {
		$sql = SQLObj::getSQLObj ();
		
		$stmt = $sql->generateInsertStatement ( 'company', array (
				'ID',
				'name',
				'shortname',
				'city',
				'country',
				'state',
				'website'
		), func_get_args () );
		
		$key = $sql->execute ( $stmt, true );
		
		// return primary key
		return new Student ( $key );
	}
	public static function get($id=null, $name=null, $shortname=null, $city=null
			, $country=null, $state=null, $website=null) {
		$sql = SQLObj::getSQLObj ();
		
		$columns = array (
				'ID',
				'name',
				'shortname',
				'city',
				'country',
				'state',
				'website' 
		);
		$operators = array (
				'=',
				'=',
				'=',
				'=',
				'=',
				'=',
				'=',
				'='
		);
		
		$stmt = $sql->generateSelectStatement ( 'company', $columns, $operators, func_get_args () );
		
		$result = $sql->execute ( $stmt );
		
		$result = mysqli_fetch_all ( $result, MYSQLI_ASSOC );
		
		print_r ( $result );
		$r = array ();
		foreach ( $result as $rows ) {
			$r [] = new Company ( $rows ['ID'], $rows ['name'], $rows ['shortname'], $rows ['city']
					,$rows['country'], $rows ['state'],$rows['website']);
		}
		
		return $r;
	}
	public static function update($id, $name, $shortname, $city, $country, $state, $website) {
		$sql = SQLObj::getSQLObj ();
		
		$columns = array (
				'ID',
				'name',
				'shortname',
				'city',
				'country',
				'state',
				'website' 
		);
		
		$args = func_get_args ();
		$args [0] = null;
		
		$stmt = $sql->generateUpdateStatement ( 'company', 'id', $id, $columns, $args );
		
		$sql->execute ( $stmt );
	}
	public static function delete($id) {
		$sql = SQLObj::getSQLObj ();
		
		$stmt = $sql->generateDeleteFromStatement ( 'company', 'id', $id );
		
		$sql->execute ( $stmt );
	}
}
?>
