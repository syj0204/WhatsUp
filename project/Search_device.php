<?php 


	include "DBController.php";
	
	
	$sDisplayName1 =$_POST["name"];
	$sDisplayName =ICONV("UTF-8","EUC-KR",$sDisplayName1);  //�Է� ���� �ѱ��� �ɸ��ͼ��� �����Ŵ ���������� ����ϱ� ����"10.50.106.1"; 
	$DBControlObject = new DBController();
	$rows = $DBControlObject->getDisPlayNameUser($sDisplayName);  // ������ ȣ���Ͽ��� ���� ����

	?>


<font face="�ü�ü"  size="4">
          <div class="col-lg-12">
              <div class="panel panel-default">
					<div class="panel-body">
                        <div class="table-responsive" align="center">
                            <table class="table table-bordered table-hover table-striped" >
								<thead>
								<th style="text-align:center; "class="bg-primary">User List</td>
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
										echo "NO User(Permissin Select)" ;
                                   }
                                 ?></td></tr>

                                </tbody>

                            </table>

						</div>
                    </div>
                </div>
             </div>
                    

     
</font>
