
<?php
include "DBController.php";


$user_id = $_POST["user"];
$devicegroup_id = $_POST["devicegroup"];

$DBControlObject = new DBController();
$result = $DBControlObject->getDeviceListForUser($user_id, $devicegroup_id);

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
