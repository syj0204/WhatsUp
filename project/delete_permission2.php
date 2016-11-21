
<?php
include "DBController.php";

$user_id = $_POST["user"];
$device_id = $_POST["device"];

$DBControlObject = new DBController();
$result = $DBControlObject->deletePermission($user_id, $device_id);

if($result) echo "success";
else echo "fail!!";
?>
s