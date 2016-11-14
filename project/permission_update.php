
<?php
include "DBController.php";


$user_for_new_permission =$_POST["user"];
$devices_for_new_permission =$_POST["devicearray"];
$devices_for_new_permission = explode(',', $devices_for_new_permission);
$current_count = 0;
$to_add_count = count($devices_for_new_permission);

$DBControlObject = new DBController();

/*for($j=0; $j<count($devices_for_new_permission); $j++) {
	$current_device  = $devices_for_new_permission[$j];
	$current_device = intval($current_device);
	$result = $DBControlObject->addPermission($user_for_new_permission, $current_device);
	if($result) $current_count++;
}
if($current_count==$to_add_count) echo "success";
else echo "fail";*/
echo count($devices_for_new_permission);
?>

