
<?php
include "DBController.php";


$category = $_POST["category"];
$item = $_POST["item"];
$td_id =$_POST["td_id"];

$DBControlObject = new DBController();
$result = null;

switch($category) {
	case 'user':
		$result = $DBControlObject->deletePermission($item, $td_id);
		break;
	default:
		//$('#permission_list_table').append('<tr><th>Department</th><th>User Name</th><th>Option</th></tr>');
		break;
}

//echo $result;
if($result) echo "success";
else echo "fail!!";
?>
