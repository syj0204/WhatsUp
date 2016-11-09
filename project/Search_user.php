<?php
	include "DBController.php";
?>

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
   		
    		<!-- /input-group -->
  		</div>
  		<!-- /.col-lg-6 -->
  		</div>
  		<!-- /.row -->
  		
  		<br />
 		<div class="table-responsive">
			<table id="user_list_table" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Device List</th>
					</tr>
				</thead>
				<tbody>

				<?php 
				
					$nUserID = $_POST["user_search_text"];
					echo $nUserID;
					$DBControlObject = new DBController();
					$rows = $DBControlObject->getUserDisPlayName($nUserID);
					if(count($rows)>0) {
						for($i=0; $i<count($rows); $i++) {
							$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
				?>
					<tr>
						<td id="user_name"><?php echo $device_name?></td>
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