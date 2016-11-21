
<?php
include "DBController.php";
$han="템플릿 저장완료";
$han = ICONV("EUC-KR","UTF-8",$han);
$han1="템플릿 저장실패(이름 중복을 확인하세요~)";
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
