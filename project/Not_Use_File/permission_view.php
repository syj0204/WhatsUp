<?php
	include "DBController.php";
?>
<script type="text/javascript">

	/*function add_permission() {
		var devices = new Array;
		var users = new Array;

		var new_user_department = document.getElementById("selected_device_list");
		for(var i=0; i<new_user_department.options.length; i++) {
			if(new_user_department.options[i].selected) {
				alert(new_user_department.options[i].value);
			}
		}
		
		
	}*/

	$(function(){

		$('#toRightAllDevice').click(function(){
			$('#device_list option').each(function() {
				$(this).remove().appendTo('#selected_device_list');
			});
		});
			
		$('#toRightSelectedDevice').click(function(){
			$('#device_list option:selected').each(function() {
				$(this).remove().appendTo('#selected_device_list');
			});
		});
			
		$('#toLeftSelectedDevice').click(function(){
			$('#selected_device_list option:selected').each(function() {
				$(this).remove().appendTo('#device_list');
			});
		});
			
		$('#toLeftAllDevice').click(function(){
			$('#selected_device_list option').each(function() {
				$(this).remove().appendTo('#device_list');
			});
		});
			
		$('#toRightAllUser').click(function(){
			$('#user_list option').each(function() {
				$(this).remove().appendTo('#selected_user_list');
			});
		});
			
		$('#toRightSelectedUser').click(function(){
			$('#user_list option:selected').each(function() {
				$(this).remove().appendTo('#selected_user_list');
			});
		});
			
		$('#toLeftSelectedUser').click(function(){
			$('#selected_user_list option:selected').each(function() {
				$(this).remove().appendTo('#user_list');
			});
		});
			
		$('#toLeftAllUser').click(function(){
			$('#selected_user_list option').each(function() {
				$(this).remove().appendTo('#user_list');
			});
		});

		$('#add_permission').click(function(){
			var devices = new Array;
			var users = new Array;
			
			$('#selected_device_list option:selected').each(function() {
				devices.push($(this).val());
			});
			
			$('#selected_user_list option:selected').each(function() {
				users.push($(this).val());
			});
			//alert(devices);
			//alert(users);
			if(devices.length>0 && users.length>0) {

				$.post("permission.php",{
					userarray:users,
					devicearray:devices
					}, 
					function(data,status) {
					//$("div#div1").html(data);
						alert(data);
						/*if(data=='success') {
							alert("New User Added Successfully!!");
						}*/
					}
				);
			} else alert("Choose Device and User!");			
			
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
	<h1 class="page-header">Permission <small>Permission Overview</small></h1>
	<ol class="breadcrumb">
		<li class="active"><i class="fa fa-dashboard"></i> Permission</li>
	</ol>
</div>
</div>

<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Permission List</h3>
	</div>
	<div class="panel-body">
	<!-- <div id="morris-area-chart"></div> -->

	<div class="row">
		<div class="col-lg-12">
    		<label>Devices</label>
		</div>
    	<div class="row">
        	<div class="col-xs-4">
				<select name="device_list" id="device_list" class="form-control" size="10" multiple="multiple">
					<?php
						$DBControlObject = new DBController();
						$rows = $DBControlObject->getDeviceList();
						if(count($rows)>0) {
							for($i=0; $i<count($rows); $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
						?>
								<option value=<?php echo $rows[$i][0]?>>
						<?php
								echo $device_name." <br> \n";
							}
						?>
								</option>
						<?php
						}
						?>
				</select>
			</div>
			<!-- /.col-xs-4 -->

			<div class="col-xs-2">
				<button type="button" id="toRightAllDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
				<button type="button" id="toRightSelectedDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
				<button type="button" id="toLeftSelectedDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
				<button type="button" id="toLeftAllDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
			</div>
			<!-- /."col-xs-2" -->

			<div class="col-xs-4">
				<select name="selected_device_list" id="selected_device_list" class="form-control" size="12" multiple="multiple"></select>
			</div>
		</div>
		<!-- /.row -->		
				
		<div class="col-lg-12">
            <label>Users</label>
		</div>
        <div class="row">
        	<div class="col-xs-4">
				<select name="user_list" id="user_list" class="form-control" size="10" multiple="multiple">
					<?php
						$rows = $DBControlObject->getUserList();
						if(count($rows)>0) {
							for($i=0; $i<count($rows); $i++) {	
								$user_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
					?>
								<option value=<?php echo $rows[$i][0]?>>
					<?php
								echo $user_name." <br> \n";
							}
					?>
								</option>
					<?php
							$DBControlObject->disconnectDB();
						}
					?>
				</select>
			</div>

			<div class="col-xs-2">
				<button type="button" id="toRightAllUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
				<button type="button" id="toRightSelectedUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
				<button type="button" id="toLeftSelectedUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
				<button type="button" id="toLeftAllUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
			</div>

			<div class="col-xs-4">
				<select name="selected_user_list" id="selected_user_list" class="form-control" size="12" multiple="multiple"></select>
			</div>
			
			
		</div>
		<div class="col-xs-2" align="center">
				<button id="add_permission" class="btn btn-default" type="button">Add Permission</button>
		</div>
		<!-- /.row -->						
	</div>
	<!-- /.row -->
	</div>
	<!-- /.panel-body -->
</div>
<!-- /.panel panel-default -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</div>
<!-- /.page-wrapper -->				
				
