
<?php
include "DBController.php";


$list_select=$_POST["name"];
$device_ID="1038";// 실제 적용시 주석처리
$DBControlObject = new DBController();
$rows = null;
$rows1 = null;
$rows = $DBControlObject-> UpdateAction($list_select,$device_ID);// 실제 적용시 주석처리
/*$rows = $DBControlObject-> getDeviceList();// Template테이블에서 String을 호출
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {
			$device_ID = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
			$DBControlObject1 = new DBController();
			
			$rows1 = $DBControlObject1-> UpdateAction($list_select,$device_ID);//$device_ID[$i] 실제 적용
				}
					
		}
*/
?>
