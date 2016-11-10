
<?php
include "DBController.php";


$users_for_new_permission =$_POST["userarray"];
$devices_for_new_permission =$_POST["devicearray"];
$current_count = 0;
$to_add_count = count($users_for_new_permission)*count($devices_for_new_permission);

$DBControlObject = new DBController();

for($i=0; $i<count($users_for_new_permission); $i++) {
	$current_user = $users_for_new_permission[$i];
	//$current_user = intval($current_user);
	
	for($j=0; $j<count($devices_for_new_permission); $j++) {
		$current_device  = $devices_for_new_permission[$j];
		//$current_device = intval($current_device);
		
		$result = $DBControlObject->addPermission($current_user, $current_device);
		
		
		if($result) $current_count++;
	}
}


	if($current_count==$to_add_count) echo "success";
	else echo "fail";
?>

