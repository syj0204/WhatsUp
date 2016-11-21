<?php
include "DBController.php";

$user_id =$_POST["userid"];
$DBControlObject = new DBController();
$result = $DBControlObject->deleteUser1($user_id);
$DBControlObject1 = new DBController();
$result1 = $DBControlObject1->deleteUser($user_id);

if($result1) echo "success";
else echo "fail!!";
?>

