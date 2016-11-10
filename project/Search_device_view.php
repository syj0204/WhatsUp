<?php
	include "DBController.php";?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$("button").click(function(){
		var value = $(this).attr("value"); //��ư�� �մ� value ���� ȣ���ؼ� ������ ����
		alert(value)
		$.post("Search_device.php",{ 
			//name: new_user_name
			name: value
		}, 
			function(data,status){
				if(data==0){
					alert("No User");
					$("div#div1").text("No User");  // �����Ͱ� ���� ��츦 ��Ÿ����.

				} // ������ ���� ����
				else {
					//alert(status);
					$("div#div1").html(data);  //������ ȣ�� ����

				}
			});	
	});

}); // ajax ����� ���ؼ� PHP�� POST �������� ������ ���� �ѱ�� �ٽ� �ݹ����� ���� �޾Ƽ� �����
$(window).load(function(e){

});	// �� ���� ���� �ڵ�....

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
							for($i=0; $i<count($rows); $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
					?>
					<button class="btn btn-default" id="device_search_text" value="<?php echo $device_name?>"><?php echo $device_name?></button>
					<?php
							}
						}
					?>
					<div ><br> </div>  
					<div id="div1" ><br> </div>  		
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





