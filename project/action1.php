
<?php
include "DBController.php";


$list_select=$_POST["name"];
$device_ID="1038";// ���� ����� �ּ�ó��
$DBControlObject = new DBController();
$rows = null;
$rows1 = null;
$rows = $DBControlObject-> UpdateAction($list_select,$device_ID);// ���� ����� �ּ�ó��
/*$rows = $DBControlObject-> getDeviceList();// Template���̺��� String�� ȣ��
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {
			$device_ID = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
			$DBControlObject1 = new DBController();
			
			$rows1 = $DBControlObject1-> UpdateAction($list_select,$device_ID);//$device_ID[$i] ���� ����
				}
					
		}
*/
?>
