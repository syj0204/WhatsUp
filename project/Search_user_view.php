<?php
	include "DBController.php";
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$("button").click(function(){
		var value = $('#user_search_text').val(); 
		$.post("Search_user.php",{ 
			name: value
		}, 
			function(data,status){

			$("div#div1").html(data);
			});		
	});

});  // ajax 방식을 통해서 PHP에 POST 형식으로 데이터 값을 넘기고 다시 콜백으로 값을 받아서 출력함
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
		<div class="row">
		<div class="col-lg-6">
   			<div class="input-group">
			<input id="user_search_text" type="text" class="form-control" placeholder="Search for...">
	
			<button class="btn btn-default" > Enter</button>
		
    		</div>
    		<!-- /input-group -->
  		</div>
  		<!-- /.col-lg-6 -->
  		</div>
  		<!-- /.row -->
  		
  		<br />
  		


				<?php 
					$DBControlObject = new DBController();
					$rows = $DBControlObject->getUserList();
					$cnt = count($rows);
					?>
		<div class="table-responsive">
			<table id="user_list_table" class="table table-bordered table-hover table-striped">

				<tbody>
					
					<?php 
					if(count($rows)>0) {
						for($i=0; $i<count($rows); $i++) {
							$user_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);

				?>


						<!-- <td id="user_id"><?php echo $rows[$i][0]?></td>
						<td id="user_cellphone"><?php echo $rows[$i][2]?></td>
						<td id="user_button"><button id="edit_user" class="btn btn-default" type="button">Edit User</button>      <button id="delete_user" class="btn btn-default" type="button">Delete User</button></td>
						 -->
				
						<td align = "center"><?php echo $user_name?></td>

				<?php
		
						}
					}
				?>
				</tbody>
			</table>
		</div>
		<div id="div1"><br> </div>  		
		<!-- /table-responsive -->
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