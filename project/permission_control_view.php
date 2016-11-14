<?php
	include "DBController.php";
?>

<script type="text/javascript">

	$(function(){

		$('#list1').change(function(){
			$('#list2 option').remove();
			var selected_category = $('#list1 option:selected').val();
			//alert(selected_category);

			$.post("category.php",{
				category:selected_category
				}, 
				function(data,status) {
					//alert(data);
					var data_by_category = data.split('/');
					//alert(data_by_category.length);
					for(var i=0; i<data_by_category.length-1; i++) {
						//alert(data_by_category[i]);
						var value = data_by_category[i].split(',');
						//alert(value.length);
						$('#list2').append("<option value='"+value[1]+"'>"+value[2]+"</option>");
					}
				}
			);
		});

		$('#list2').change(function(){
			$('#list3 option').remove();
			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();
			//alert(selected_category);
			//alert(selected_item);
			//alert(selected_category);

			$.post("item1.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					//alert(data);
					var data_by_list1 = data.split('/');
					for(var i=0; i<data_by_list1.length-1; i++) {
						//alert(data_by_list1[i]);
						var value = data_by_list1[i].split(',');
						$('#list3').append("<option value='"+value[1]+"'>"+value[2]+"</option>");
					}
				}
			);
		});
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
    		<label>DeviceGroups</label>
		</div>
    	<div class="row">
        	<div class="col-xs-3">
				<select name="list1" id="list1" class="form-control" size="25">
					<option value='user'>User</option>
					<option value='device'>Device</option>
					<option value='devicegroup'>Device Group</option>
					<option value='host'>Host<option>
						
				</select>
			</div>
			<!-- /.col-xs-3 -->
        	<div class="col-xs-3">
				<select name="list2" id="list2" class="form-control" size="25">
				</select>
			</div>
			<!-- /.col-xs-3 -->			

			<div class="col-xs-3">
				<select name="list3" id="list3" class="form-control" size="25">
				</select>
			</div>
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
				
