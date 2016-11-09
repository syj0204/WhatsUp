<?php 


	include "DBController.php";
	
	
	
	
	
	$sUserName1 =$_POST["name"];
	$sUserName = ICONV("UTF-8","EUC-KR",$sUserName1);
	$DBControlObject = new DBController();
	$rows = $DBControlObject->getUserDisPlayName($sUserName);
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {
			$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
			echo $device_name;
				
		}
	}



?>