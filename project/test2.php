
<?php
include "DBController.php";
include "SQL_injection.php";
$han="템플릿 저장완료";
$han = ICONV("EUC-KR","UTF-8",$han);
$han1="템플릿 저장실패(이름 중복을 확인하세요~)";
$han1 = ICONV("EUC-KR","UTF-8",$han1);
//한글화 하기 위한 작업

$temp_size=$_POST["size"];
$temp_name= $_POST["name"];
$temp_name = ICONV("UTF-8","EUC-KR",$temp_name);
// test.php에서 값을 전달 받아 변수 저장
$temp_name=SQL_injection($temp_name);
$temp_string=$_POST["category"];

$temp_string = substr($temp_string , 0, -1);
$result_first = explode(",", $temp_string);
sort($result_first);
$result_first= implode(",", $result_first);
$result_first = $result_first.",";
//전달 받은 값을 정령시키고 다시 문자열로 변경함

$DBControlObject = new DBController();
$rows= null;
$rows = $DBControlObject-> tem1($temp_name);
//echo count($rows);
	if(count($rows)>0) {
		echo $han1;
	}else {
		$DBControlObject1 = new DBController();
		$result = null;
		$result = $DBControlObject1-> tem($temp_name, $result_first);
		echo $han;
	}
	
//template 테이블에서 tamplate 이름을 호출 받아서 다시 조건으로 사용해서 문자열값 DB에 저장

?>

