<?php
	include "DBController.php";?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$("button").click(function(){
		var value = $(this).attr("value"); //��ư�� �մ� value ���� ȣ���ؼ� ������ ����
		//alert(value)
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
					$("table#div1").html(data);  //������ ȣ�� ����

									}
			});	
	});

	$("search_user").click(function(){
		var value = $('#user_search_text').val(); 

		$("#user_list_table tbody tr").each(function(){
			$row = $(this);
			var text = $row.find("td:eq(0)").find().attr("value");
			if(text.toLowerCase()==value.toLowerCase()) {
				$row.show();
			} else $row.hide();
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
				<h1 class="page-header">Device</h1>
			</div>
		</div>

		<!-- /.row -->
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Device List</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6">
   								<div class="input-group">
      								<input id="user_search_text" type="text" class="form-control" placeholder="Search for...">
     									<span class="input-group-btn">
        									<button id="search_user" class="btn btn-default" type="button">Search</button>
      									</span>
    							</div>
    							<!-- /input-group -->
  							</div>
  							<!-- /.col-lg-6 -->

  						</div>

					<?php 

					$DBControlObject = new DBController();
					$rows = $DBControlObject->getDeviceList();
					$cnt = count($rows);
						if(count($rows)>0) {
					?>

				<div class="row">
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="user_list_table">
    
                                <tbody>
					<?php 
							for($i=0; $i<count($rows); $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
					?>
                                    <tr>
                                        <td><button id="<?php echo $device_name?>" class="btn btn-lg btn-primary" value="<?php echo $device_name?>"> <?php echo $device_name?></button></td>

                                    </tr>
					<?php	
							}
					?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id="div1">
								<thead>
									<tr>
																</tr>
								</thead>
                                <tbody>
	
                                    <tr>
										<div id="div1"><br> </div> 
                                    </tr>
				
                                </tbody>
                            </table>
                        </div>
                    </div>

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





