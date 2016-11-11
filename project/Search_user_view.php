<?php
	include "DBController.php";
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$("button").click(function(){
		//var new_user_name = document.getElementById("user_search_text").value;
		var value = $(this).attr("value"); 

		$.post("Search_user.php",{ 
			//name: new_user_name
			name: value
		}, 
			function(data,status){
				if(data==0){
					alert("No Device");
					$("div#div1").text("No Device");

				} // 오류시 수정 예정
				else {
					//alert(status);
					$("div#div1").html(data);

				}
			});	
	
	});

}); // ajax 방식을 통해서 PHP에 POST 형식으로 데이터 값을 넘기고 다시 콜백으로 값을 받아서 출력함


$(function(){

	$('#permission_view').click(function(){
		$('#ui_view').load("permission_view.php");
		return false;
	});	


});
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
						$rows = $DBControlObject->getUserList();
						$cnt = count($rows);
							if(count($rows)>0) {
					?>
				<div class="row">
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="device_list_table">
    
                                <tbody>
					<?php
							for($i=0; $i<count($rows); $i++) {
								$user_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
					?>
                                    <tr>

                                        <td><button  class="btn btn-lg btn-primary" value="<?php echo $user_name?>"> <?php echo $user_name?></button></td>

                                    </tr>
					<?php	
							}
							
					?>	
						      </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="panel panel-default">
					   <div class="panel-body">
                        <div class="table-responsive">
                        <a href="#" id="permission_view"><i class="btn-primary"></i> Go permission</a>
                            <table class="table table-bordered table-hover table-striped">
								<thead>
									<tr>
									</tr>
								</thead>
                                <tbody>
	
                                    <tr>
										<div  id="div1"> </div>  	
                                    </tr>
				
                                </tbody>
                            </table>
                        </div>
                      </div>
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