<?php 


	include "DBController.php";

	$DBControlObject = new DBController();
	$rows = $DBControlObject->getUserList();
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {
			$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
			echo $device_name;
		}
	}




?>