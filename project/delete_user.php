<?php
include "DBController.php";

$user_id =$_POST["userid"];
$DBControlObject = new DBController();
$result = $DBControlObject->deleteUser($user_id);
echo $result;
//if($result) echo "success";
//else echo "fail!!";
?>

