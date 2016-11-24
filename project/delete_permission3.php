
<?php
include "DBController.php";

$user_id = $_POST["user"];
$device_id_list = $_POST["devicelist"];

$DBControlObject = new DBController();
$result = $DBControlObject->deletePermissionMultiple($user_id, $device_id_list);

$device_id_list_len = count($device_id_list);
if($result==$device_id_list_len) echo $result;
else echo -1;
//echo $result;
?>
