



<?php 


	include "DBController.php";
	
	
	$sUserName1 =$_POST["name"];
	$sUserName = ICONV("UTF-8","EUC-KR",$sUserName1);  //입력 받은 한글의 케릭터셋을 변경시킴 쿼리문에서 사용하기 위함
	$DBControlObject = new DBController();
	$rows = $DBControlObject->getUserDisPlayName($sUserName);  // 퀴리문 호출하여서 값을 받음

	?>


<font face="궁서체"  size="4">
          <div class="col-lg-12">
              <div class="panel panel-default">
					<div class="panel-body">
                        <div class="table-responsive" align="center">
                            <table class="table table-bordered table-hover table-striped" >
								<thead>
								<th style="text-align:center; "class="bg-primary">Device List</td>
								</thead>
                                <tbody>
                               <?php 
                                if(count($rows)>0) {
								 for($i=0; $i<count($rows); $i++) {  // 레코드셋을 통재로 가져오기 때문에 배열로 나타내야함
										$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);

								?>
                                   <tr> <td align="center"> 
                                <?php 	echo $device_name; 
                                  		}
                                  	 }
                                  else { ?>
                                  </td></tr>
                                   <tr> <td align="center">
                                  <?php 
										echo "NO Device(Permissin Select)" ;
                                   }
                                 ?></td></tr>

                                </tbody>

                            </table>

						</div>
                    </div>
                </div>
             </div>
                    

     
</font>
	