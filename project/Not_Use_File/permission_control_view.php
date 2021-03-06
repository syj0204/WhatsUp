<?php
	include "DBController.php"; 
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	var isAddMode = -1;
	var to_add_list = [];
	var to_add_text_list_ = [];    
	var to_delete_list = [];

	function setAddMode() {
		isAddMode = 1;
		//$('#list3').attr( "size", 11 );
		$('#list4').show();
		$('#list4_title').show();
		//$('#edit_permission').text("SAVE");
		$('#add_permission').hide();
		$('#delete_permission').hide();
		$('#save').show();
		$('#cancel').show();
		$('#list3_title').text("Current Permission List");
	}

	function setDeleteMode() {
		isEditMode = 1;
		$('#list3').attr( "size", 11 );
		//$('#list4').show();
		$('#list4_title').show();
		//$('#edit_permission').text("SAVE");
		$('#add_permission').hide();
		$('#delete_permission').hide();
		$('#save').show();
		$('#cancel').show();
		$('#list3_title').text("Current Permission List");
	}
	
	function setSearchMode() {
		isAddMode = 0;
		$('#list4').hide();
		$('#list4_title').hide();
		$('#list3').attr( "size", 25 );
		$('#add_permission').hide();
		$('#delete_permission').hide();
		$('#save').hide();
		$('#cancel').hide();
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
			$('#list2').append("<option>-- Select "+$('#list1 option:selected').text()+" --</option>");
			$.post("category.php",{
				category:selected_category
				}, 
				function(data,status) {
					var data_by_category = data.split('|');
					for(var i=0; i<data_by_category.length-1; i++) {
						var value = data_by_category[i].split(',');
						$('#list2').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});

		$('#list2').change(function(){
			$('#list3 option').remove();
			$('#list4 option').remove();
			$('#add_permission').show();
			$('#delete_permission').show();
			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();

			$.post("item1.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					var data_by_list1 = data.split('|');
					for(var i=0; i<data_by_list1.length-1; i++) {
						var value = data_by_list1[i].split(',');
						$('#list3').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});

		$('#add_permission').click(function(){

			setAddMode();

			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();

			$.post("get_no_permission_list.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					var data_by_category_item = data.split('|');
					for(var i=0; i<data_by_category_item.length-1; i++) {
						var value = data_by_category_item[i].split(',');
						$('#list4').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});

		$('#delete_permission').click(function(){


			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();

			$.post("get_no_permission_list.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					var data_by_category_item = data.split('|');
					for(var i=0; i<data_by_category_item.length-1; i++) {
						var value = data_by_category_item[i].split(',');
						$('#list4').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});

		$('#list3').change(function(){
			if(isAddMode==1) {
				var count = $('#list3 option:selected').length;
				if(count==0) {
					$('#save').attr('disabled',true);
					$('#cancel').attr('disabled',true);
				}
				else {
					$('#save').attr('disabled',false);
					$('#cancel').attr('disabled',false);
				}
				
				var to_delete_item = $('#list3 option:selected').remove().appendTo('#list4').val();

			}
		});

		$('#list4').change(function(){
			if(isAddMode==1) {
				var count = $('#list4 option:selected').length;
				if(count==0) {
					$('#save').attr('disabled',true);
					$('#cancel').attr('disabled',true);
				}
				else {
					$('#save').attr('disabled',false);
					$('#cancel').attr('disabled',false);
				}
			}
		});

		$('#save').click(function(){
			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();

			switch(selected_category) {
				case 'user':
					//alert('user');
					$('#list4 option:selected').each(function(){
						to_add_list.push($(this).val());
					});

					$.post("update_permission.php",{
						user:selected_item,
						addlist:to_add_list
						}, 
						function(data,status) {
							alert(data);
							if(data=="success") {
							}
						}
					);
					break;
				case 'device':
					alert('device');
					break;
				default:
					alert('devicegroup');
					break;
			}
			setSearchMode();
		});
	});

</script>
	
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
	<h1 class="page-header">Permission</h1>

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
	<div class="row">
		<div class="form-group">
			<!-- <label for="list1" class="col-sm-2 control-label">Search Category</label> -->
			<div class="col-sm-2">
	    	<select name="list1" id="list1" class="form-control selcls">
	    		<option> -- Select Search Category -- </option>
				<option value='user'>User</option>
				<option value='device'>Device / ALL</option>
				<?php
					$DBControlObject = new DBController();
					$rows = $DBControlObject->DeviceGroupsView();
					if(count($rows)>0) {
						for($i=0; $i<count($rows); $i++) {
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
			<div class="col-xs-2">
				<label id="list2_title">List By Category</label>
	    		<select name="list2" id="list2" class="form-control selcls">
	    		</select>
			</div>
		</div>
	</div>
	<br />
	
	<div class="row">
		<div class="form-group">
			<!-- <label for="list1" class="col-sm-2 control-label">Search Category</label> -->
			<div class="col-xs-2">
				<label id="list2_title">List By Category</label>
	    		<select name="list2" id="list2" class="form-control selcls">
	    		</select>
			</div>
			<div class="col-xs-2">
				<label id="list3_title">Permission List</label>
	    		<select name="list3" id="list3" class="form-control selcls" size="20">
	    		</select>
			</div>
			<div class="col-xs-2">
				<label id="list4_title" style="display: none">Available Options To Add</label>
	    		<select name="list4" id="list4" class="form-control selcls" size="20" style="display: none" multiple="multiple">
	    		</select>
			</div>
			<div class="col-xs-3" align="center">
				<button id="add_permission" class="btn btn-default" type="button" style="display: none" >Add Permission</button> <br /><br />
				<button id="delete_permission" class="btn btn-default" type="button" style="display: none" >Delete Permission</button>
				<button id="save" class="btn btn-default" type="button" style="display: none" disabled="true">Save</button>
				<button id="cancel" class="btn btn-default" type="button" style="display: none" disabled="true">Cancel</button>
			</div>
		</div>
	</div>
	<br />			
			
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
				
