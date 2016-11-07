<?php
include "Database.php";

Class User {
		
	private $DBObject;
	private $connection;
	
	function __construct() {
		$this->DBObject = new Database();
		$this->connection=$this->DBObject->connectDB();
	}
	
	function getUserList() {
		
		if($this->connection) {
			echo "getuserlist connect!";
			$query = "SELECT * FROM Users";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
			
			if(count($statement)>0) {
				echo "getuserlist connect333!";
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
			
			//$this->DBObject->disconnectDB();
		}
	}
	
	function getUser($nUserID) {
	
		if($this->connection) {
				
			$query = "SELECT * FROM User WHERE nUserID=".$nUserID;
			$statement = $this->DBObject->executeQuery($query);
				
			if(!$statement) return $statement;
			else return null;
				
			$this->DBObject->disconnectDB();
		}
	}
	
}
	
?>