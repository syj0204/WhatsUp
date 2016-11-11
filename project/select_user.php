<?php
include "DBController.php";

$user_id =$_POST["userid"];
$DBControlObject = new DBController();
$result = $DBControlObject->selectUser($user_id);
if($result==-1) echo "fail";
else {
	$user_name = ICONV("EUC-KR","UTF-8",$result[1]);
	echo "".$result[0].",".$user_name.",".$result[2].",".$result[3];
}

?>

