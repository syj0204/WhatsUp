



<?php 


	include "DBController.php";
	
	
	$sUserName1 =$_POST["name"];
	$sUserName = ICONV("UTF-8","EUC-KR",$sUserName1);  //�Է� ���� �ѱ��� �ɸ��ͼ��� �����Ŵ ���������� ����ϱ� ����
	$DBControlObject = new DBController();
	$rows = $DBControlObject->getUserDisPlayName($sUserName);  // ������ ȣ���Ͽ��� ���� ����
	if(count($rows)>0) {
		for($i=0; $i<count($rows); $i++) {  // ���ڵ���� ����� �������� ������ �迭�� ��Ÿ������
			$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
	
?>
<font face="�ü�ü" color="blue" size="4">
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
