<<<<<<< HEAD

<?php
include "DBController.php";


$category = $_POST["category"];
$item = $_POST["item"];

$DBControlObject = new DBController();
$result = null;

switch($category) {
	case 'user':
		$result = $DBControlObject->getDeviceListNotForUser($item);
		break;
	case 'device':
		$result = $DBControlObject->getUserListNotForDevice($item);
		break;
	default:
		//$result = $DBControlObject->;
		break;
		
}
//echo json_encode($result);
$new_result="";
for($i=0; $i<count($result); $i++) {
	for($j=0; $j<count($result[$i]); $j++) {
		$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$result[$i][$j]);
	}
	$new_result = $new_result."|";
}
echo $new_result;
?>

