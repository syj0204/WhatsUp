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
		
		 $this->server = "10.50.202.121";
		$this->uid = "smssend";
		$this->pwd = "answkqkfthd!@12";
		$this->database = "WhatsUp";
		//whatsUP��
		/*$this->server = "203.249.128.60";
		$this->uid = "youngjoo";
		$this->pwd = "$%dudwn0514^*("; 
		$this->database = "whatsup";
		*/
		$this->connectionInfo = array( "UID"=>$this->uid,
				"PWD"=>$this->pwd,
				"Database"=>$this->database);
		//echo "connectionninfo!!";
		/* Connect using SQL Server Authentication. */
		$this->connection = sqlsrv_connect( $this->server, $this->connectionInfo);
		
		if($this->connection); //echo "Success!<br>\n";
		else echo "fail!!";
		
		return $this->connection;
	}
	
	function executeQuery($query) {
		if($this->connection) {
			//$tsql = "SELECT id, name, age FROM interninfo";
			
			$this->statement = sqlsrv_query($this->connection, $query);
		}
		return $this->statement;
	}
	
	function disconnectDB() {
		sqlsrv_free_stmt( $this->statement);
		sqlsrv_close( $this->connection);
		/*if(sqlsrv_free_stmt( $this->statement) && sqlsrv_close( $this->connection))
			echo "DB Closed!";	*/
	}
}
?>