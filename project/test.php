<?php
include "DBController.php";


$category = $_POST["category"];
$nDevice= $_POST["item"];
$nUser= $_POST["test"];

$DBControlObject = new DBController();
$result = null;

switch($category) {
	case 'user':
		$result = $DBControlObject->DevieceInsertest($nDevice,$nUser);
		break;
	default:
		$result = $DBControlObject->UserInsertest($nDevice,$nUser);
		break;
		
}

?>
