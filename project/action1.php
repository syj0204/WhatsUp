
<?php
include "DBController.php";


$list_select=$_POST["name"];

$DBControlObject = new DBController();
$rows = null;
$rows = $DBControlObject-> getDeviceList();// Template���̺��� String�� ȣ��
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {
			$device_ID[$i] = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
			$DBControlObject1 = new DBController();
			$rows1 = null;
			//$rows1 = $DBControlObject1-> UpdateAction($list_select,$device_ID[$i]);
				}
					
		}

?>
