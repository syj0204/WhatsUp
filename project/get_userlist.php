<?php
include "DBController.php";

$DBControlObject = new DBController();
$result = $DBControlObject->getUserList();
//if($result==-1) echo "fail";
//else echo $result;

if($result) {
	$new_result="";
	for($i=0; $i<count($result); $i++) {
		for($j=0; $j<count($result[$i]); $j++) {
			$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$result[$i][$j]);
		}
		$new_result = $new_result."|";
	}
	echo $new_result;
}
else echo -1;
?>

