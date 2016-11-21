<?php
include "DBController.php";

$user_id =$_POST["userid"];
$user_name =$_POST["username"];
$user_name = ICONV("UTF-8","EUC-KR",$user_name);
$user_cellphone =$_POST["cellphone"];
$user_department =$_POST["department"];

$DBControlObject = new DBController();
$result = $DBControlObject->updateUser($user_id, $user_name, $user_cellphone, $user_department);
//if($result==-1) echo "fail";
//else echo $result;

echo $result;
?>

