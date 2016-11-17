
<?php
include "DBController.php";

$user_id =$_POST["user"];
$devices_for_new_permission =$_POST["devicearray"];
$current_count = 0;
$to_add_count = count($devices_for_new_permission);

$DBControlObject = new DBController();

for($j=0; $j<count($devices_for_new_permission); $j++) {
	$current_device  = $devices_for_new_permission[$j];

	$result = $DBControlObject->addPermission($user_id, $current_device);
	if($result) $current_count++;
}

	if($current_count==$to_add_count) echo 1;
	else echo "fail";
?>

