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
			$query = "INSERT INTO Users (sUserName, nCellNum, Department) VALUES(N'".$new_user_name."','".$new_user_cellphone."','".$new_user_department."')";
			$statement = $this->DBObject->executeQuery($query);
				
			$query = "SELECT nUserID FROM Users WHERE sUserName=N'".$new_user_name."' and nCellNum='".$new_user_cellphone."'";
			$statement = $this->DBObject->executeQuery($query);
			$row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC);

			return $row[0];
		}
	}

	function deleteUser($user_id) {
		if($this->connection) {
			
			$query = "DELETE FROM Permission WHERE nUserID='".$user_id."'";
			$statement = $this->DBObject->executeQuery($query);
			$query = "DELETE FROM Users WHERE nUserID='".$user_id."'";
			$statement = $this->DBObject->executeQuery($query);

			return $statement;
		}
	}

	function updateUser($user_id, $user_name, $user_cellphone, $user_department) {
		$row = -1;
		if($this->connection) {
			
			$query = "UPDATE Users SET sUserName=N'".$user_name."', nCellNum='".$user_cellphone."', Department='".$user_department."' WHERE nUserID=".$user_id;
			$statement = $this->DBObject->executeQuery($query);
				
			if($statement) {
				$user_name = ICONV("EUC-KR","UTF-8",$user_name);
				$row = $user_id.",".$user_name.",".$user_cellphone.",".$user_department;
			}
			return $row;
		}
		
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
				
			$query = "IF NOT EXISTS(Select * From Permission Where nUserID='".$user_id."' and nDeviceID='".$device_id."') Begin INSERT INTO Permission (nUserID, nDeviceID) VALUES(".$user_id.",".$device_id.") End";
			//"INSERT INTO Permission (nUserID, nDeviceID) VALUES(".$user_id.",".$device_id.")";
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
			$query = "SELECT D.* from  DeviceGroup AS DG INNER JOIN PivotDeviceToGroup AS PD ON DG.nDeviceGroupID = PD.nDeviceGroupID INNER JOIN Device AS D ON PD.nDeviceID = D.nDeviceID Where dg.nParentGroupID = '0' and DG.nMonitorStateID !='0' and  DG.nMonitorStateID !='10'  order by nDeviceID ASC ";
			// WhatUp DB쩍횄 쨩챌쩔챘
			//$query = "SELECT * from  Device";
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

	function getDeviceListForUser($user_id, $device_group_id) {

		if($this->connection) {
			$query = "SELECT p.nDeviceID, dg.sGroupName, d.sDisplayName FROM Permission p, Device d, PivotDeviceToGroup g, DeviceGroup dg WHERE p.nDeviceID=d.nDeviceID and d.nDeviceID=g.nDeviceID and g.nDeviceGroupID=dg.nDeviceGroupID and p.nUserID ='".$user_id."' and g.nDeviceGroupID=".$device_group_id;
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
			$query = "SELECT * FROM Device WHERE nDeviceID NOT IN (SELECT nDeviceID FROM Permission WHERE nUserID =".$user_id.")";
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

	function getDeviceListNotForUserInGroup($user_id, $device_group_id) {

		if($this->connection) {
				
			$query = "SELECT d.nDeviceID, d.sDisplayName FROM Device d, PivotDeviceToGroup pdg WHERE d.nDeviceID=pdg.nDeviceID and pdg.nDeviceGroupID=".$device_group_id."and d.nDeviceID NOT IN (SELECT p.nDeviceID FROM Permission p, PivotDeviceToGroup pdg WHERE p.nDeviceID=pdg.nDeviceID and pdg.nDeviceGroupID=".$device_group_id." and p.nUserID=".$user_id.")";
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

	function getUserListNotForDevice($device_id) {
		if($this->connection) {
			$query = "SELECT * FROM Users WHERE nUserID NOT IN (SELECT nUserID FROM Permission WHERE nDeviceID =".$device_id.")";
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


	function getDevicesByUserAndDeviceGroup($nUserID, $nDeviceGroupID) {

		if($this->connection) {

			$query = "SELECT p.nDeviceID, d.sDisplayName, dg.sGroupName FROM Permission p, Device d, PivotDeviceToGroup pdg, DeviceGroup dg WHERE p.nDeviceID=d.nDeviceID and d.nDeviceID=pdg.nDeviceID and pdg.nDeviceGroupID=dg.nDeviceGroupID and p.nUserID=".$nUserID." and pdg.nDeviceGroupID=".$nDeviceGroupID;
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

	}//�짱�첬쨍짝 �횑쩔챘횉횗 쨉챨쨔횢�횑쩍쨘 횄짙짹창
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
	} //쨉챨쨔횢�횑쩍쨘쨍짝 �횑쩔챘횉횗 �짱�첬 횄짙짹창
	function DeviceGroupsView() {

		if($this->connection) {


			//$query = "Select * from DeviceGroup Where nParentGroupID = '0' order by sGroupName ASC";
			$query = "Select * from DeviceGroup Where nParentGroupID = '0' and nMonitorStateID !='0' and  nMonitorStateID !='10' order by sGroupName ASC";
			// 쩍횉횁짝 WhatsUp DB 쨩챌쩔챘쩍횄 쨩챌쩔챘쩔쨔횁짚
				

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
	} //쨉챨쨔횢�횑쩍쨘쨍짝 짹횞쨌챙 횄짙짹창
	function GroupDeviceView($Device_List1) {

		if($this->connection) {


			$query = "SELECT D.*, DG.* from  DeviceGroup AS DG INNER JOIN PivotDeviceToGroup AS PD ON DG.nDeviceGroupID = PD.nDeviceGroupID INNER JOIN Device AS D ON PD.nDeviceID = D.nDeviceID Where DG.nDeviceGroupID='".$Device_List1."'";
			//$query = "SELECT D.* from  DeviceGroup AS DG INNER JOIN PivotDeviceToGroup AS PD ON DG.nDeviceGroupID = PD.nDeviceGroupID INNER JOIN Device AS D ON PD.nDeviceID = D.nDeviceID Where DG.nDeviceGroupID='".$Device_List1."'";
			// WhatsUp DB 쨩챌쩔챘쩍횄 쨩챌쩔챘쩔쨔횁짚

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
	} //짹횞쨌챙쨀쨩 쨉챨쨔횢�횑쩍쨘  횄짙짹창

	function getDisPlayNameUser2($nDeviceID) {

		if($this->connection) {


			//$query = "SELECT U.* FROM Permission AS P INNER Join Users As U ON P.nUserID = U.nUserID INNER Join Device AS D ON P.nDeviceID = D.nDeviceID WHERE U.sDisplayName='".$sDisplayName."' order by nUserID ASC";

			$query = "Select U.* From Device AS D INNER JOIN Permission AS P ON D.nDeviceID = P.nDeviceID INNER JOIN Users AS U ON P.nUserID=U.nUserID Where D.nDeviceID='".$nDeviceID."'";
				
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
	} //쨉챨쨔횢�횑쩍쨘쨍짝 �횑쩔챘횉횗 �짱�첬 횄짙짹창2
	function tem($temp_name, $temp_string) {
		if($this->connection) {
			$query = "Insert Into template(templateName,templateString) values(N'".$temp_name."','".$temp_string."')";
			$statement = $this->DBObject->executeQuery($query);
			return $statement;

		}
	}//template쩔징 쨩천쨌횙째횚 횄횩째징횉횕쨈횂 횆천쨍짰
	function tem1($temp_name) {
		if($this->connection) {
			$query = "Select * From template Where templateName='".$temp_name."'";
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
	}//template 횁쨍�챌 쩔짤쨘횓 횊짰�횓쩍횉쩍횄

	function getTemplate($template_select) {

		if($this->connection) {
				
			$query = "SELECT * FROM Template where templateId ='".$template_select."'";
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
	}// Template횇횞�횑쨘챠쩔징쩌짯 String�쨩 횊짙횄창
	function getSelecttemp() {

		if($this->connection) {
			$query = "SELECT * FROM Template";
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
	}// 횄횎짹창 Template select쨔짰쩔징 쨀짧횇쨍쨀쨩쨈횂 째횒

	function getDeviceName($result_first) {

		if($this->connection) {
            $query = "SELECT D.*, DG.* from  DeviceGroup AS DG INNER JOIN PivotDeviceToGroup AS PD ON DG.nDeviceGroupID = PD.nDeviceGroupID INNER JOIN Device AS D ON PD.nDeviceID = D.nDeviceID Where D.nDeviceID ='".$result_first."'";
			//$query = "SELECT * FROM Device WHERE nDeviceID='".$result_first."' order by nDeviceID ASC";
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
	}//Template string�횉 째짧�쨩 �횑쩔챘횉횠쩌짯 쨉챨쨔횢�횑쩍쨘 �횑쨍짠 횄짙짹창
	function update_template($update_temp_id, $update_temp_string) {
		if($this->connection) {
			$query = "Update Template set templateString = '".$update_temp_string."' where templateID ='".$update_temp_id."'";
			$statement = $this->DBObject->executeQuery($query);


			return $statement;
		}
	}
	function delete_template($update_temp_id) {
		if($this->connection) {
			$query = "delete from template where templateID ='".$update_temp_id."'";
			$statement = $this->DBObject->executeQuery($query);


			return $statement;
		}
	}
	function UpdateAction($list_select,$device_ID){
		if($this->connection) {
			//$query = "Update Device set nActionPolicyID = '".$list_select."' where nDeviceID ='".$device_ID."'";
			$statement = $this->DBObject->executeQuery($query);
			return $statement;
		}
	}

	function disconnectDB() {
		$this->DBObject->disconnectDB();
	}
}

?>