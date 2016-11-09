<?php
include "Database.php";

Class DBController{
		
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
				
			//$this->DBObject->disconnectDB();
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
	
	function getUserList() {
	
		if($this->connection) {
			$query = "SELECT * FROM Users";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
				
			if(count($statement)>0) {
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
	
	function getPermissionList() {
		
		if($this->connection) {
			$query = "SELECT * FROM Permission";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
			
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
			
			//$this->DBObject->disconnectDB();
		}
	}
	
	function getPermission($nPermissionID) {
	
		if($this->connection) {
				
			$query = "SELECT * FROM Permission WHERE nPermissionID=".$nPermissionID;
			$statement = $this->DBObject->executeQuery($query);
				
			if(!$statement) return $statement;
			else return null;
				
			//$this->DBObject->disconnectDB();
		}
	}
	
	function getPermissionsForUser($nUserID) {
	
		if($this->connection) {
	
			$query = "SELECT * FROM Permission WHERE nUserID=".$nUserID;
			$statement = $this->DBObject->executeQuery($query);
	
			if(!$statement) return $statement;
			else return null;
	
			//$this->DBObject->disconnectDB();
		}
	}
	
	function getUsersForDevice($nDeviceID) {
	
		if($this->connection) {
	
			$query = "SELECT * FROM Permission WHERE nDeviceID=".$nDeviceID;
			$statement = $this->DBObject->executeQuery($query);
	
			if(!$statement) return $statement;
			else return null;
	
			//$this->DBObject->disconnectDB();
		}
	}
	function getUserDisPlayName($sUserName) {
	
		if($this->connection) {
	
			$query = "SELECT D.sDisplayName FROM Permission AS P INNER Join Users As U ON P.nUserID = U.nUserID INNER Join Device AS D ON P.nDeviceID = D.nDeviceID WHERE U.sUserName=".$sUserName;
			$statement = $this->DBObject->executeQuery($query);
	
			if(!$statement) return $statement;
			else return null;
	
			//$this->DBObject->disconnectDB();
		}
	}//유저를 이용한 디바이스 찾기
	function getDisPlayNameUser($nDeviceID) {
	
		if($this->connection) {
	
			$query = "SELECT U.sUserName FROM Permission AS P INNER Join User As U ON P.nUserID = U.nUserID INNER Join Device AS D ON P.nDeviceID = D.nDeviceID WHERE D.nDeviceID=".$nDeviceID;
			$statement = $this->DBObject->executeQuery($query);
	
			if(!$statement) return $statement;
			else return null;
	
			//$this->DBObject->disconnectDB();
		}
	} //디바이스를 이용한 유저 찾기
	
	function disconnectDB() {
		$this->DBObject->disconnectDB();
	}
}
	
?>