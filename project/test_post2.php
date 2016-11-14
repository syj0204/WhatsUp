
<?php
include "DBController.php";



$category = "03. MIS";//$_POST["category"];
$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject->GroupDeviceView(intval($category));

//echo json_encode($result);
$new_result="";
for($i=0; $i<count($result); $i++) {
	for($j=0; $j<count($result[$i]); $j++) {
		$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$result[$i][$j]);
	}
	$new_result = $new_result."/";
}
echo $new_result;
?>
