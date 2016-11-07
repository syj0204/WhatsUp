<?php 

class Database {

	private $server;
	private $database;
	private $uid;
	private $pwd;
	private $connectionInfo;
	private $connection;
	private $statement;
	
	function connectDB() {
		
		$this->server = "203.249.128.60";
		$this->uid = "youngjoo";
		$this->pwd = "$%dudwn0514^*(";
		$this->database = "whatsup";
		
		$this->connectionInfo = array( "UID"=>$this->uid,
				"PWD"=>$this->pwd,
				"Database"=>$this->database);
		
		/* Connect using SQL Server Authentication. */
		$this->connection = sqlsrv_connect( $this->server, $this->connectionInfo);
		
		if($this->connection) return $this->connection;
		else return null;
		
		//return $this->connection;
	}
	
	function executeQuery($query) {
		if($this->connection) {
			//$tsql = "SELECT id, name, age FROM interninfo";
			
			$this->statement = sqlsrv_query($this->connection, $query);
		}
		return $this->statement;
	}
	
	function disconnectDB() {
		if(sqlsrv_free_stmt( $this->statement) && sqlsrv_close( $this->connection))
			echo "DB Closed!";	
	}
}
?>