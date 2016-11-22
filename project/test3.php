
<?php
include "DBController.php";

$template_select=$_POST["category"];


$DBControlObject = new DBController();
$rows = null;
$rows = $DBControlObject-> getTemplate($template_select);// Template테이블에서 String을 호출
if(count($rows)>0) {
		$device_name = ICONV("EUC-KR","UTF-8",$rows[0][2]);
		$update_temp_string = substr($device_name , 0, -1);
		$result_first = explode(',', $update_temp_string);
	
		for($i=0; $i<count($result_first); $i++){
		$DBControlObject1 = new DBController();
		$rows1 = null;
		$rows1 = $DBControlObject1-> getDeviceName($result_first[$i]); ////Template string의 값을 이용해서 디바이스 이름 찾기
		
			//echo $rows1[1];
				for($y=0; $y<count($rows1); $y++) {
						$new_result = ICONV("EUC-KR","UTF-8",$rows1[$y][27]);
						$new_result1 = $new_result.",".ICONV("EUC-KR","UTF-8",$rows1[$y][0]);

						$new_result2 = $new_result1.",".ICONV("EUC-KR","UTF-8",$rows1[$y][1]);
						
						
					$new_result3 = $new_result2."|";
					$new_result4[$i] = $new_result3;
				}//echo $new_result3;
				

				//$new_result12 = $new_result;
				

			//echo $display[1];
			//echo $display[2];
			////echo $display[3];
			//echo $display[4];
	}	
	$new_result12="";
	for($j=0; $j<count($result_first); $j++){
		$new_result12 =$new_result12.$new_result4[$j];
		
		
	}
	$update_temp_string = substr($new_result12 , 0, -1);
	echo $update_temp_string;
	
	
}//echo $device_name;



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
