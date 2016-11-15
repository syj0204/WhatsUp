<?php
	include "DBController.php";
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	var isEditMode = -1;
	var to_add_list = [];  
	var to_delete_list = [];

	function setEditMode() {
		isEditMode = 1;
		$('#list3').attr( "size", 11 );
		$('#list4').show();
		$('#list4_title').show();
		//$('#edit_permission').text("SAVE");
		$('#edit_permission').hide();
		$('#edit_permission_save').show();
		$('#edit_permission_cancel').show();
		$('#list3_title').text("Make New Permission List");
	}
	
	function setSearchMode() {
		isEditMode = 0;
		$('#list4').hide();
		$('#list4_title').hide();
		$('#list3').attr( "size", 25 );
		$('#edit_permission').show();
		$('#edit_permission_save').hide();
		$('#edit_permission_cancel').hide();
		//$('#list2_title').text("List By Category");
		$('#list3_title').text("Permission List");
	}
	
	function initSelectBoxes() {
		$('#list2 option').remove();
		$('#list3 option').remove();
		$('#list2_title').text("List By Category");
		$('#list3_title').text("Permission List");
	}

	$(function(){

		$('#list1').change(function(){
			initSelectBoxes();
			var selected_category = $('#list1 option:selected').val();
			$('#list2_title').text($('#list1 option:selected').text()+" List");
			$.post("category.php",{
				category:selected_category
				}, 
				function(data,status) {
					var data_by_category = data.split('/');
					for(var i=0; i<data_by_category.length-1; i++) {
						var value = data_by_category[i].split(',');
						$('#list2').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});

		$('#list2').change(function(){
			$('#list3 option').remove();
			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();

			$.post("item1.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					var data_by_list1 = data.split('/');
					for(var i=0; i<data_by_list1.length-1; i++) {
						var value = data_by_list1[i].split(',');
						$('#list3').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});

		$('#edit_permission').click(function(){

			setEditMode();

			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();

			$.post("get_no_permission_device_list.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					var data_by_category_item = data.split('/');
					for(var i=0; i<data_by_category_item.length-1; i++) {
						var value = data_by_category_item[i].split(',');
						$('#list4').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});

		$('#list3').change(function(){
			
			if(isEditMode==1) {
				var count = $('#list3 option:selected').length;
				if(count==0) {
					$('#edit_permission_save').attr('disabled',true);
					$('#edit_permission_cancel').attr('disabled',true);
				}
				else {
					$('#edit_permission_save').attr('disabled',false);
					$('#edit_permission_cancel').attr('disabled',false);
				}
				
				var to_delete_item = $('#list3 option:selected').remove().appendTo('#list4').val();
				to_delete_list.push(to_delete_item);
			}
		});

		$('#list4').change(function(){
			if(isEditMode==1) {
				var count = $('#list4 option:selected').length;
				if(count==0) {
					$('#edit_permission_save').attr('disabled',true);
					$('#edit_permission_cancel').attr('disabled',true);
				}
				else {
					$('#edit_permission_save').attr('disabled',false);
					$('#edit_permission_cancel').attr('disabled',false);
				}
				
				var to_add_item = $('#list4 option:selected').remove().appendTo('#list3').val();
				to_add_list.push(to_add_item);
			}
		});

		$('#edit_permission_save').click(function(){
			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();

			switch(selected_category) {
				case 'user':
					alert(to_add_list);
					alert(to_delete_list);

					to_add_list.forEach( function(add_item, add_index, add_array){
						//alert(add_array[add_index]);
						to_delete_list.forEach( function(delete_item, delete_index, delete_array){
							//alert(add_array[add_index]+","+delete_array[delete_index]);
							if(add_array[add_index]===delete_array[delete_index]) {
								
								add_array.splice(add_index, 1);
								delete_array.splice(delete_index, 1);
								//return false;
							}
						});
					});
					alert("re:"+to_add_list);
					alert("re:"+to_delete_list);

					
					$.post("update_permission.php",{
						user:selected_item,
						addlist:to_add_list,
						deletelist:to_delete_list
						}, 
						function(data,status) {
							alert(data);
						}
					);
					break;
				case 'device':
					break;
				case 'devicegroup':
					break;
				case 'host':
					break;
			}
			setSearchMode();
			
		});

		$(window).load(function(e){

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
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Permission Search</h3>
	</div>
	<div class="panel-body">
	<!-- <div id="morris-area-chart"></div> -->

	<div class="row">
		<!-- <div class="col-lg-12">
    		<label>Permission Search</label>
		</div> -->
    	<div class="row">
        	<div class="col-xs-2">
        		<div class="col-lg-12">
	    			<label>Search Category</label>
				</div>
				<select name="list1" id="list1" class="form-control" size="25">
					<option value='user'>User</option>
					<option value='device'>Device / ALL</option>
						<?php
						$DBControlObject = new DBController();
						$rows = $DBControlObject->DeviceGroupsView();
						if(count($rows)>0) {
							for($i=0; $i<count($rows)-1; $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][2]);
						?>

								<option value=<?php echo $rows[$i][0]?>>
						<?php
								echo "Device / " .$device_name." <br> \n";
							}
						?>
								</option>
						<?php
						}
						?>
				</select>
			</div>
			<!-- /.col-xs-2 -->
        	<div class="col-xs-2">
        		<div class="col-lg-12">
	    			<label id="list2_title">List By Category</label>
				</div>
				<select name="list2" id="list2" class="form-control" size="25">
				</select>
			</div>
			<!-- /.col-xs-2 -->			

			<div class="col-xs-2">
				<div class="col-lg-12">
	    			<label id="list3_title">Permission List</label>
				</div>
				<select name="list3" id="list3" class="form-control" size="25">
				</select>
				<br />
				<div class="col-lg-12">
	    			<label id="list4_title" style="display: none">Available Options</label>
				</div>
				<select name="list4" id="list4" class="form-control" size="11" style="display: none">
				</select>
			</div>
			<!-- /.col-xs-2 -->	
			<div class="col-xs-3" align="center">
				<button id="edit_permission" class="btn btn-default" type="button">Edit Permission</button>
				<button id="edit_permission_save" class="btn btn-default" type="button" style="display: none" disabled="true">Save</button>
				<button id="edit_permission_cancel" class="btn btn-default" type="button" style="display: none" disabled="true">Cancel</button>
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
				
