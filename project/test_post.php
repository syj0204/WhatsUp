<?php 


	include "DBController.php";
	
	
	
	
	
	$nUserID =$_POST["name"];

	$DBControlObject = new DBController();
	$rows = $DBControlObject->getUser($nUserID);
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {
			$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
			echo $device_name;
				
		}
	}



?>