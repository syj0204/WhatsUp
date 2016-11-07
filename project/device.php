<?php
include "Database.php";

Class Device{
		
	private $DBObject;
	private $connection;
	
	function __construct() {
		$this->DBObject = new Database();
		$this->connection=$this->DBObject->connectDB();
	}
	
	function getDeviceList() {
		
		if($this->connection) {
			$query = "SELECT * FROM Device";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
			
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
			
			$this->DBObject->disconnectDB();
		}
	}
	
	function getDevice($nDeviceID) {
	
		if($this->connection) {
				
			$query = "SELECT * FROM Device WHERE nDeviceID=".$nDeviceID;
			$statement = $this->DBObject->executeQuery($query);
				
			if(!$statement) return $statement;
			else return null;
				
			$this->DBObject->disconnectDB();
		}
	}
	
}
	
?>