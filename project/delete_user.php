<?php
include "DBController.php";

$user_id =$_POST["userid"];
$user_id =intval($user_id);
//$DBControlObject = new DBController();
//$result = $DBControlObject->deleteUser($user_id);


echo $user_id;
?>

