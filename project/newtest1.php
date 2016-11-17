
<?php
include "DBController.php";


$list_select=$_POST["list"];
$list_size=$_POST["size"];
$temp_select=$_POST["temp"];


for($i=0; $i<$list_size; $i++) {
		$result_list = explode(',', $list_select);
		 //User ID 값을 저장 완료
		$result_list1 =  $result_list[$i];
		
}	



$DBControlObject = new DBController();
$rows = null;
$rows = $DBControlObject-> getTemplate($temp_select);// Template테이블에서 String을 호출
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {
			$device_ID = ICONV("EUC-KR","UTF-8",$rows[$i][2]);
			$result_temp = explode(',', $device_ID);
				for($j=0; $j<count($result_temp); $j++){
					$result_temp1 = $result_temp[$j];
					//echo $result_temp1;
				}
					
		}
	}

for($x=0; $x<$list_size; $x++) {
	for($y=0; $y<count($result_temp)-1; $y++) {
		$DBControlObject1 = new DBController();
		$rows1 = null;
		//echo $result_list[$x];
		//echo $result_temp[$y];
		$rows1 = $DBControlObject1-> addPermission($result_list[$x],$result_temp[$y]);
	}
}

?>
