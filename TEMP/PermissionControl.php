<?php
	include "C:\Sites\whatsup\MVC\Controller\Database.php";
	
	if(!isset($_POST['device'])) exit;
	if(!isset($_POST['user'])) exit;
	
	$device = $_POST['device'];
	$user = $_POST['user'];
	
	$deviceList = explode(',',$this->device);
	$userList = explode(',',$this->user);
	
	$deviceCount = count($this->deviceList);
	$userCount = count($this->userList);
	
	$query;
	$statement;
	
	$DBObject = new Database();
	$connection=$this->DBObject->connectDB();
	if($connection) {
		
		for($i=0; $i<=$this->userCount; $i++) {
			for($j=0; $j<=$this->deviceCount; $j++) {
				$this->query = "SELECT * FROM nUserID=".$this->userList[i]." and nDeviceIDList=".$this->deviceList[j];
				$this->statement = $this->DBObject->executeQuery($this->query);
				
				if(!$this->statement) {
					$this->query = "INSERT INTO permission (nUserID, nDeviceIDList) VALUES (".$this->userList[i]+",".$this->deviceList[j].")";
					$this->statement = $this->DBObject->executeQuery($this->query);
				}
			}
		}
		echo "success!";
		$this->DBObject->disconnectDB();
	}
	
	
?>