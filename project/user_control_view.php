<?php
	include "DBController.php";
?>

<script type="text/javascript">

	$(function(){
		$('#user_search').click(function(){
			//alert(''+$('#device_search_text').val());
			var value = $('#user_search_text').val(); 

			$("#user_list_table tbody tr").each(function(){
				$row = $(this);
				var text = $row.find("td:eq(1)").text();
				if(text.toLowerCase()==value.toLowerCase()) {
					$row.show();
				} else $row.hide();
				
				//alert(text);
				/*if(text.toLowerCase()==value.toLowerCase()) {
					
				}*/
				
			});
		});

	});

	$(window).load(function(e){

	});

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
     			<span class="input-group-btn">
        			<button id="user_search" class="btn btn-default" type="button">Search</button>
      			</span>
    		</div>
    		<!-- /input-group -->
  		</div>
  		<!-- /.col-lg-6 -->
  		<button id="add_user" class="btn btn-default" type="button">Add User</button>
  		</div>
  		<!-- /.row -->
  		
  		<br />
  		
  		<div class="table-responsive">
			<table id="user_list_table" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>User ID</th>
						<th>User Name</th>
						<th>Cell Phone</th>
						<th>Option</th>
					</tr>
				</thead>
				<tbody>

				<?php 
					$DBControlObject = new DBController();
					$rows = $DBControlObject->getUserList();
					if(count($rows)>0) {
						for($i=0; $i<count($rows); $i++) {
							$user_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
				?>
					<tr>
						<td><?php echo $rows[$i][0]?></td>
						<td><?php echo $user_name?></td>
						<td><?php echo $rows[$i][2]?></td>
						<td><button id="edit_user" class="btn btn-default" type="button">Edit User</button>      <button id="delete_user" class="btn btn-default" type="button">Delete User</button></td>
					</tr>
				<?php
		
						}
					}
				?>
				</tbody>
			</table>
		</div>
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