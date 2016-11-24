
<?php
include "DBController.php";

$function=$_POST["func"];

switch($function) {
	case "add_user":
		$new_user_name =$_POST["username"];
		$new_user_name = ICONV("UTF-8","EUC-KR",$new_user_name);
		$new_user_cellphone =$_POST["cellphone"];
		$new_user_department =$_POST["department"];
		$DBControlObject = new DBController();
		$result = $DBControlObject->addUser($new_user_name, $new_user_cellphone, $new_user_department);
		if($result) echo "success";
		else echo "fail";
		break;
		
	case "edit_user":
		edit_user();
		break;
	case "delete_user":
		delete_user();
		break;
}





?>

