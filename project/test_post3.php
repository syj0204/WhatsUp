
<?php
include "DBController.php";



$item = $_POST["item"];
$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject->getDisPlayNameUser2($item);

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
