
<?php
include "DBController.php";

$template_select=$_POST["category"];


$DBControlObject = new DBController();
$rows = null;
$rows = $DBControlObject-> getTemplate($template_select);// Template테이블에서 String을 호출
if(count($rows)>0) {
	
	for($i=0; $i<count($rows); $i++) {
		$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][2]);
		$result_first = explode(',', $device_name);
		
		for($x=0; $x<count($result_first); $x++){
			$display = $result_first[$x];
			$DBControlObject1 = new DBController();
			$rows1 = null;
			$rows1 = $DBControlObject1-> getDeviceName($display); ////Template string의 값을 이용해서 디바이스 이름 찾기
			$new_result="";
				for($y=0; $y<count($rows1); $y++) {
					for($j=0; $j<count($rows1[$i]); $j++) {
						$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$rows1[$y][$j]);
					}
					$new_result = $new_result."|";
				}echo $new_result;
			
	 	 }
	}	
}


/*
$new_result="";
for($i=0; $i<count($result); $i++) {
	for($j=0; $j<count($result[$i]); $j++) {
		$new_result = $new_result.",".ICONV("EUC-KR","UTF-8",$result[$i][$j]);
	}
	$new_result = $new_result."|";
}
*/

?>
