
<?php
include "DBController.php";

$DBControlObject = new DBController();
$result = $DBControlObject->getDeviceList();
echo $result;

?>

