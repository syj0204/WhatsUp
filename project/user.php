
<?php
include "DBController.php";

$new_user_name =$_POST["username"];
$new_user_name = ICONV("UTF-8","EUC-KR",$new_user_name);
$new_user_cellphone =$_POST["cellphone"];
$new_user_department =$_POST["department"];

$DBControlObject = new DBController();
$result = $DBControlObject->addUser($new_user_name, $new_user_cellphone, $new_user_department);
//if($result) echo "success";
//else echo "fail";
echo $result;	
?>

