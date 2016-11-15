<?php
include "Database.php";

Class DBController{
		
	private $DBObject;
	private $connection;
	
	function __construct() {
		$this->DBObject = new Database();
		$this->connection=$this->DBObject->connectDB();
	}
	
	function addUser($new_user_name, $new_user_cellphone, $new_user_department) {
		if($this->connection) {
			$query = "INSERT INTO Users (sUserName, nCellNum, Department) VALUES('".$new_user_name."','".$new_user_cellphone."','".$new_user_department."')";
			$statement = $this->DBObject->executeQuery($query);
		
			return $statement;
		}
	}
	
	function deleteUser($user_id) {
		if($this->connection) {
			$query = "DELETE FROM Users WHERE nUserID=".$user_id;
			$statement = $this->DBObject->executeQuery($query);
	
			return $statement;
		}
	}
	
	function updateUser($user_id, $user_name, $user_cellphone, $user_department) {
		$row = -1;
		if($this->connection) {
			$query = "UPDATE Users SET sUserName='".$user_name."', nCellNum='".$user_cellphone."', Department='".$user_department."' WHERE nUserID=".$user_id;
			$statement = $this->DBObject->executeQuery($query);
			
			if($statement) {
				$user_name = ICONV("EUC-KR","UTF-8",$user_name);
				$row = $user_id.",".$user_name.",".$user_cellphone.",".$user_department;
			}
		}
		return $row;
	}
	
	function selectUser($user_id) {
		$row = -1;
		if($this->connection) {
			$query = "SELECT * FROM Users WHERE nUserID=".$user_id;
			$statement = $this->DBObject->executeQuery($query);
			if(count($statement)>0) {
				$row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC);
			}
		}
		return $row;
	}
	
	/*function addDevice($new_device_name) {
		if($this->connection) {
			$query = "INSERT INTO Device (sUserName, nCellNum, Department) VALUES('".$new_user_name."','".$new_user_cellphone."','".$new_user_department."')";
			$statement = $this->DBObject->executeQuery($query);
	
			return $statement;
			//$this->DBObject->disconnectDB();
		}
	}*/
	
	function addPermission($user_id, $device_id) {
		if($this->connection) {
			
			$query = "INSERT INTO Permission (nUserID, nDeviceID) VALUES(".$user_id.",".$device_id.")";
			$statement = $this->DBObject->executeQuery($query);
			/*$query = "SELECT * FROM Permission WHERE nUserID=".$user_id." and nDeviceID=".$device_id.")";
			$statement = $this->DBObject->executeQuery($query);
			if(count($statement)>0) $statement = true;
			else {
				$query = "INSERT INTO Permission (nUserID, nDeviceID) VALUES(".$user_id.",".$device_id.")";
				$statement = $this->DBObject->executeQuery($query);
			}*/
	
			return $statement;
			//$this->DBObject->disconnectDB();
		}
	}
	
	function deletePermission($user_id, $device_id) {
		if($this->connection) {
				
			$query = "DELETE FROM Permission WHERE nUserID=".$user_id."and nDeviceID=".$device_id;
			$statement = $this->DBObject->executeQuery($query);
			/*$query = "SELECT * FROM Permission WHERE nUserID=".$user_id." and nDeviceID=".$device_id.")";
				$statement = $this->DBObject->executeQuery($query);
				if(count($statement)>0) $statement = true;
				else {
				$query = "INSERT INTO Permission (nUserID, nDeviceID) VALUES(".$user_id.",".$device_id.")";
				$statement = $this->DBObject->executeQuery($query);
				}*/
	
			return $statement;
			//$this->DBObject->disconnectDB();
		}
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
	
	function getDeviceListForUser($user_id) {
	
		if($this->connection) {
			$query = "SELECT p.nDeviceID, d.sDisplayName FROM Permission p, Device d WHERE p.nDeviceID=d.nDeviceID and p.nUserID ='".$user_id."'";
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
	
	function getDeviceListNotForUser($user_id) {
	
		if($this->connection) {
			$query = "SELECT * FROM Device WHERE nDeviceID NOT IN (SELECT p.nDeviceID FROM Permission p, Device d WHERE p.nDeviceID=d.nDeviceID and p.nUserID ='".$user_id."')";
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
	
	function getDeviceGroupList() {
	
		if($this->connection) {
			$query = "SELECT * FROM DeviceGroup";
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
	
	function getUser($sUserName) {
	
		if($this->connection) {
	
			$query = "SELECT * FROM Users WHERE sUserName='".$sUserName."'";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
			
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
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
	
			$query = "SELECT D.* FROM Permission AS P INNER Join Users As U ON P.nUserID = U.nUserID INNER Join Device AS D ON P.nDeviceID = D.nDeviceID WHERE U.sUserName='".$sUserName."'";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
				
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;

		}
		
	}//유저를 이용한 디바이스 찾기
	function getDisPlayNameUser($sDisplayName) {
	
		if($this->connection) {
	
			//$query = "SELECT U.* FROM Permission AS P INNER Join Users As U ON P.nUserID = U.nUserID INNER Join Device AS D ON P.nDeviceID = D.nDeviceID WHERE U.sDisplayName='".$sDisplayName."'";
			$query = "Select U.* From Device AS D INNER JOIN Permission AS P ON D.nDeviceID = P.nDeviceID INNER JOIN Users AS U ON P.nUserID=U.nUserID Where D.sDisplayName ='".$sDisplayName."'";
			
			//$query = "Select * From Device Where nDeviceID ='".$sDisplayName."'";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
			
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
			
			}
	} //디바이스를 이용한 유저 찾기
	function DeviceGroupsView() {
	
		if($this->connection) {
	
			//$query = "Select * from DeviceGroup Where nParentGroupID = '0' order by sGroupName ASC";// 실제 WhatsUp DB 사용시 사용예정
			$query = "Select * from DeviceGroup Where nParentGroupID = '0' order by sGroupName ASC";
			//$query = "Select * From Device Where nDeviceID ='".$sDisplayName."'";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
			
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
			
			}
	} //디바이스를 그룹 찾기
	function GroupDeviceView($Device_List1) {
	
		if($this->connection) {
	
		
			//$query = "Select D.* from DeviceGroup AS DG INNER JOIN MonitorState AS MS ON DG.nMonitorStateID = MS.nMonitorStateID INNER JOIN Device AS D ON MS.nMonitorStateID = D.nWorstStateID Where nDeviceGroupID='".$Device_List1."'";
			$query = "SELECT D.* from  DeviceGroup AS DG INNER JOIN PivotDeviceToGroup AS PD ON DG.nDeviceGroupID = PD.nDeviceGroupID INNER JOIN Device AS D ON PD.nDeviceID = D.nDeviceID Where DG.nDeviceGroupID='".$Device_List1."'";
			// 실제 WhatsUp DB 사용시 사용예정
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
				
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
				
		}
	} //디바이스를 그룹 찾기
	
	function getDisPlayNameUser2($nDeviceID) {
	
		if($this->connection) {
	
			$query = "SELECT U.* FROM Permission AS P INNER Join Users As U ON P.nUserID = U.nUserID INNER Join Device AS D ON P.nDeviceID = D.nDeviceID WHERE U.sDisplayName='".$sDisplayName."'";
			//$query = "Select U.* From Device AS D INNER JOIN Permission AS P ON D.nDeviceID = P.nDeviceID INNER JOIN Users AS U ON P.nUserID=U.nUserID Where D.nDeviceID='".$nDeviceID."'";
			
			//$query = "Select * From Device Where nDeviceID ='".$sDisplayName."'";
			$statement = $this->DBObject->executeQuery($query);
			$rows = array();
			
			if(count($statement)>0) {
				while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
					$rows[] = $row;
				}
				return $rows;
			}
			else return null;
			
			}
	} //디바이스를 이용한 유저 찾기2
	
	function disconnectDB() {
		$this->DBObject->disconnectDB();
	}
}
	
?>