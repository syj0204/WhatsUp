
<?php

include "DBController.php";


$category =$_POST["category"];
$bank =$_POST["bank"];


$update_temp_string = substr($bank , 0, -1);
$result_first = explode(",", $update_temp_string);


$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject->GroupDeviceView($category);
//echo json_encode($result);
$new_result="";
$new_result1="";
for($i=0; $i<count($result); $i++) {
	$new_result =ICONV("EUC-KR","UTF-8",$result[$i][0]).",";
	$new_result1 = $new_result1.$new_result;
}

$new_result_string = substr($new_result1 , 0, -1);
$result_string = explode(",", $new_result_string);
$test="";
$sul = array_diff ($result_string , $result_first);
sort($sul);
foreach ($sul as $key => $val);
//echo count($sul);

for($x=0; $x<count($sul); $x++) {
	//echo $sul[$x];

	$DBControlObject1 = new DBController();
	$rows1 = null;
	$rows1 = $DBControlObject1-> getDeviceName($sul[$x]); ////Template string의 값을 이용해서 디바이스 이름 찾기

	for($y=0; $y<count($rows1); $y++) {
			
		$test = $test.",".ICONV("EUC-KR","UTF-8",$rows1[$y][0]);
		$test = $test.",".ICONV("EUC-KR","UTF-8",$rows1[$y][1]);
		$test = $test.",".ICONV("EUC-KR","UTF-8",$rows1[$y][27]);
		$test = $test."|";
	}
}echo $test;




?>

