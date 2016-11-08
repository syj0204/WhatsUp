<?php
	include "DBController.php";
?>
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
User <small>Users Overview</small>
</h1>
<ol class="breadcrumb">
<li class="active">
<i class="fa fa-dashboard"></i> User
</li>
</ol>
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
<!-- <div id="morris-area-chart"></div> -->

<div class="table-responsive">
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th>Department</th>
<th>User</th>
<th>CellPhone</th>
<th>Option</th>
</tr>
</thead>
<tbody>

<?php 
$DBControlObject = new DBController();
$rows = $DBControlObject->getUserList();
if(count($rows)>0) {
	for($i=0; $i<count($rows); $i++) {
		?>
		<tr>
			<td><?php echo $rows[$i][0]?></td>
			<td><?php echo $rows[$i][1]?></td>
			<td><?php echo $rows[$i][2]?></td>
			<td><input type="button" id="user_edit" name="user_edit" value="EDIT"><input type="button" id="user_delete" name="user_delete" value="DELETE"></td>
		</tr>
		<?php
		
	}
	//$UserObject->DBObject->disconnectDB();
}
else echo "fail!!";
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<!-- /.row -->


				</div>
				<!-- /.container-fluid -->

				</div>
				<!-- /#page-wrapper -->