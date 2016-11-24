
<?php
include "DBController.php";

$new_device_name =$_POST["devicename"];
$new_device_name = ICONV("UTF-8","EUC-KR",$new_device_name);

$DBControlObject = new DBController();
$result = $DBControlObject->addDevice($new_device_name);
if($result) echo "success";
else echo "fail";

?>

