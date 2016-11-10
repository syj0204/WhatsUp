



<?php 


	include "DBController.php";
	
	
	$sUserName1 =$_POST["name"];
	$sUserName = ICONV("UTF-8","EUC-KR",$sUserName1);  //입력 받은 한글의 케릭터셋을 변경시킴 쿼리문에서 사용하기 위함
	$DBControlObject = new DBController();
	$rows = $DBControlObject->getUserDisPlayName($sUserName);  // 퀴리문 호출하여서 값을 받음
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {  // 레코드셋을 통재로 가져오기 때문에 배열로 나타내야함
			$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
	
?>

<div class="col-lg-6">
       <div class="table-responsive">
          <table class="table table-bordered table-hover">        
             <tbody>
               <tr > <?php echo $device_name; ?></tr>
              </tbody>
          </table>
     </div>
  </div>
 
 
<?php 
			}	

	}


?>
