
<?php
include "DBController.php";

$user =$_POST["user"];
$to_add_list =$_POST["addlist"];
//$to_delete_list =$_POST["deletelist"];
$current_count = 0;
$to_add_count = count($to_add_list);
//$to_delete_count = count($to_delete_list);
$add_count = 0;
//$delete_count= 0;
$DBControlObject = new DBController();


if($to_add_count>0) {
	for($i=0; $i<$to_add_count; $i++) {
		$current_item  = $to_add_list[$i];
		//$current_device = intval($current_device);
		//$str = $str.$user_for_new_permission."&".$current_device."||";
	
		$result = $DBControlObject->addPermission($user, $current_item);
		if($result) $add_count++;
	}
}

/*if($to_delete_count>0) {
	for($i=0; $i<$to_delete_count; $i++) {
		$current_item  = $to_delete_list[$i];
		//$current_device = intval($current_device);
		//$str = $str.$user_for_new_permission."&".$current_device."||";
	
		$result = $DBControlObject->deletePermission($user, $current_item);
		if($result) $delete_count++;
	}
}*/
if($add_count==$to_add_count) echo "success";
//if($add_count==$to_add_count && $delete_count==$to_delete_count) echo "success";
else echo "fail";
//echo $to_add_list.",".$to_delete_list;
?>

