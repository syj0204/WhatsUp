<?php
include "DBController.php";

$update_temp_id= $_POST["name"];

$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject->delete_template($update_temp_id);

?>
