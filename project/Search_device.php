<?php 


	include "DBController.php";
	
	
	$sDisplayName1 =$_POST["name"];
	$sDisplayName =ICONV("UTF-8","EUC-KR",$sDisplayName1);  //입력 받은 한글의 케릭터셋을 변경시킴 쿼리문에서 사용하기 위함"10.50.106.1"; 
	$DBControlObject = new DBController();
	$rows = $DBControlObject->getDisPlayNameUser($sDisplayName);  // 퀴리문 호출하여서 값을 받음
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {  // 레코드셋을 통재로 가져오기 때문에 배열로 나타내야함
			$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);

?>
<font face="궁서체" color="blue" size="4">
          <div class="col-lg-6">
              <div class="panel panel-default">
					<div class="panel-body">
                        <div class="table-responsive" align="center">
                            <table class="table table-bordered table-hover table-striped" >

								<thead>
									<tr>
									</tr>
								</thead>
                                <tbody>
	
                                   <tr>  <?php echo $device_name; ?></tr>
				
                                </tbody>

                            </table>

						</div>
                    </div>
                </div>
             </div>
                    

     
</font>
<?php 
			}	

	}


?>