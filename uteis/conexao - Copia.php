<?php 
class PDOConnection {
	private $dbh;
	function __construct() {
		try {
			$server = "localhost";
			$db_username = "root";
			$db_password = "";
			$service_name = "";
			$sid = "";
			$port = "3306";
			$dbtns = "";
			
			$this->dbh = new PDO ( "oci:dbname=" . $dbtns . ";charset=utf8", $db_username, $db_password, array (
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_EMULATE_PREPARES => false,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
			) );
		} catch ( PDOException $e ) {
			echo $e->getMessage ();
		}
	}
	public function select($sql) {
		$sql_stmt = $this->dbh->prepare ( $sql );
		$sql_stmt->execute ();
		$result = $sql_stmt->fetchAll ( PDO::FETCH_ASSOC );
		return $result;
	}
	function __destruct() {
		$this->dbh = NULL;
	}
}

?>