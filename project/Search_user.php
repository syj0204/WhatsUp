



<?php 


	include "DBController.php";
	
	
	$sUserName1 =$_POST["name"];
	$sUserName = ICONV("UTF-8","EUC-KR",$sUserName1);  //�Է� ���� �ѱ��� �ɸ��ͼ��� �����Ŵ ���������� ����ϱ� ����
	$DBControlObject = new DBController();
	$rows = $DBControlObject->getUserDisPlayName($sUserName);  // ������ ȣ���Ͽ��� ���� ����

	?>


<font face="�ü�ü"  size="4">
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
								 for($i=0; $i<count($rows); $i++) {  // ���ڵ���� ����� �������� ������ �迭�� ��Ÿ������
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
	