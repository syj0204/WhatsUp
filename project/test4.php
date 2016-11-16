
<?php
include "DBController.php";

$update_temp_id= $_POST["name"];
$update_temp_string=$_POST["category"];


$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject->update_template($update_temp_id, $update_temp_string);

?>
