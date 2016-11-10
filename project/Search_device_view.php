<?php
	include "DBController.php";?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$("button").click(function(){
		var value = $(this).attr("value"); //버튼에 잇는 value 값을 호출해서 변수에 저장
		//alert(value)
		$.post("Search_device.php",{ 
			//name: new_user_name
			name: value
		}, 
			function(data,status){
				if(data==0){
					alert("No User");
					$("div#div1").text("No User");  // 데이터가 없는 경우를 나타낸다.

				} // 오류시 수정 예정
				else {
					//alert(status);
					$("div#div1").html(data);  //데이터 호출 성공
					alert(data);
									}
			});	
	});

}); // ajax 방식을 통해서 PHP에 POST 형식으로 데이터 값을 넘기고 다시 콜백으로 값을 받아서 출력함
$(window).load(function(e){

});	// 별 쓸모가 없는 코드....

</script>

<div id="page-wrapper">

	<div class="container-fluid">
		<!-- Page Heading -->
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">User</h1>
			</div>
		</div>

		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> User List</h3>
					</div>
					<div class="panel-body">

					<?php 

					$DBControlObject = new DBController();
					$rows = $DBControlObject->getDeviceList();
					$cnt = count($rows);
						if(count($rows)>0) {
					?>

					<div ><br> </div>  

				<div class="row">
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Device List</th>

                                    </tr>
                                </thead>
                                <tbody>
					<?php 
							for($i=0; $i<count($rows)/3; $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
					?>
                                    <tr>
                                        <td><button  class="btn btn-sm btn-primary" value="<?php echo $device_name?>"> <?php echo $device_name?></button></td>

                                    </tr>
					<?php	
							}
					?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Device List</th>
                                    </tr>
                                </thead>
                                <tbody>
					<?php 
							for($i=count($rows)/3; $i<(count($rows)*2)/3; $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
					?>
                                    <tr>
                                        <td><button  class="btn btn-sm btn-primary" value="<?php echo $device_name?>"> <?php echo $device_name?></button></td>

                                    </tr>
					<?php	
							}
					?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <!-- /.row -->
                <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Device List</th>
                                    </tr>
                                </thead>
                                <tbody>
					<?php 
							for($i=(count($rows)*2)/3; $i<(count($rows)*3)/3; $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
					?>
                                    <tr>
                                        <td><button  class="btn btn-sm btn-primary" value="<?php echo $device_name?>"> <?php echo $device_name?></button></td>

                                    </tr>
					<?php	
							}
					?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
					
					<?php	
							}
					?>	
									

					
					 
					</div>
					<!-- /.panel-body -->
						
				</div>
				<!-- /.panel-default -->
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->

	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->





