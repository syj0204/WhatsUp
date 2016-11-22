
<?php

include "DBController.php";


$category = $_POST["category"];

$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject->GroupDeviceView($category);
//echo json_encode($result);
$new_result="";
for($i=0; $i<count($result); $i++) {
						
	$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$result[$i][0]);
	$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$result[$i][1]);
	$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$result[$i][27]);
	$new_result = $new_result."|";
}
echo $new_result;

/*
$temp_size="5";
$temp_string="34,25,26,27,10,";
$temp_string = substr($temp_string , 0, -1);
$result_first = explode(",", $temp_string);
sort($result_first);
$result_first= implode(",", $result_first);
$result_first = $result_first.",";
echo $result_first;

*/

?>

