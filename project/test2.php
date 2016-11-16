
<?php
include "DBController.php";

$temp_name= $_POST["name"];
$temp_string=$_POST["category"];


$DBControlObject = new DBController();
$result = null;
$result = $DBControlObject-> tem($temp_name, $temp_string);

?>
