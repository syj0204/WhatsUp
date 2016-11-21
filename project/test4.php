
<?php
include "DBController.php";

$update_temp_id= $_POST["name"];
$update_temp_string=$_POST["category"];
$temp_size= $_POST["size"];
$update_temp_string = substr($update_temp_string , 0, -1);
$result_first = explode(",", $update_temp_string);
sort($result_first);
$result_first= implode(",", $result_first);
$result_first = $result_first.",";


$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject->update_template($update_temp_id, $result_first);

?>
