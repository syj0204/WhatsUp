
<?php
include "DBController.php";
$han="���ø� ����Ϸ�";
$han = ICONV("EUC-KR","UTF-8",$han);
$han1="���ø� �������(�̸� �ߺ��� Ȯ���ϼ���~)";
$han1 = ICONV("EUC-KR","UTF-8",$han1);


$temp_name= $_POST["name"];
$temp_name = ICONV("UTF-8","EUC-KR",$temp_name);

$temp_string=$_POST["category"];
$DBControlObject = new DBController();
$rows= null;
$rows = $DBControlObject-> tem1($temp_name);
//echo count($rows);
	if(count($rows)>0) {
		echo $han1;
	}else {
		$DBControlObject1 = new DBController();
		$result = null;
		$result = $DBControlObject1-> tem($temp_name, $temp_string);
		echo $han;
	}

?>
