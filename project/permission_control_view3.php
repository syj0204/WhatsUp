<?php
	include "DBController.php";
	
	$han="추가";
	$han1="수정";
	$han2="삭제";
	$han3="검색";
	$han4="취소";
	$han5="완료";
	$han6="이름으로 찾기";
	$han = ICONV("EUC-KR","UTF-8",$han);
	$han1 = ICONV("EUC-KR","UTF-8",$han1);
	$han2 = ICONV("EUC-KR","UTF-8",$han2);
	$han3 = ICONV("EUC-KR","UTF-8",$han3);
	$han4 = ICONV("EUC-KR","UTF-8",$han4);
	$han5 = ICONV("EUC-KR","UTF-8",$han5);
	$han6 = ICONV("EUC-KR","UTF-8",$han6);
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
		$('#permission_list_table tr').remove();
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
			$('#permission_list_table tr').remove();
			$('#permission_list_table').show();
			var list1_item = $('#list1 option:selected').val();
			var list2_item = $('#list2 option:selected').val();
			switch(list1_item) {
			case 'user':
				$('#permission_list_table').append('<tr><th>Device ID</th><th>Device Group</th><th>Device Name</th><th>Option</th></tr>');
				break;
			default:
				$('#permission_list_table').append('<tr><th>Department</th><th>User Name</th><th>Option</th></tr>');
				break;
			}

			$.post("item1.php",{
				category:list1_item,
				item:list2_item
				}, 
				function(data,status) {
					var data_by_list1 = data.split('|');
					switch(list1_item) {
					case 'user':
						for(var i=0; i<data_by_list1.length-1; i++) {
							var value = data_by_list1[i].split(',');
							//$.newtr = $("<tr><td style='display: none'>"+data+"</td><td>"+new_user_name+"</td><td>"+new_user_cellphone+"</td><td>"+new_user_department+"</td><td><button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'><?php echo $han1?></button>      <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'><?php echo $han2?></button></td></tr>");
							$.newtr = $("<tr><td>"+value[1]+"</td><td></td><td>"+value[2]+"</td><td><button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'><?php echo $han1?></button>      <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'><?php echo $han2?></button></td></tr>");
							$('#permission_list_table').append($.newtr);
						}
						break;
					default:
						//$('#permission_list_table').append('<tr><th>Department</th><th>User Name</th><th>Option</th></tr>');
						break;
					}
				}
			);
			/*$('#list3 option').remove();
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
			);*/
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
	<h1 class="page-header">User</h1>
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
		<div class="row">
		<div class="form-group">
			<!-- <label for="list1" class="col-sm-2 control-label">Search Category</label> -->
			<div class="col-sm-2">
			<label id="list1_title">Search Category</label>
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
		<div class="col-lg-6">
   			<div class="input-group">
      			<input id="user_search_text" type="text" class="form-control" placeholder="<?php echo $han6?>~~">
     			<span class="input-group-btn">
        			<button id="search_user" class="btn btn-default" type="button"><?php echo $han3?></button>
      			</span>
    		</div>
    		<!-- /input-group -->
  		</div>
  		<!-- /.col-lg-6 -->
  		<button id="add_user" class="btn btn-default" type="button"><?php echo $han?></button>
  		</div>
  		<!-- /.row -->
  		<br />
  		<div id="permission_table_view">You can check permission! Just Check Each Category Items!!
  			<table id="permission_list_table" class="table table-bordered table-hover table-striped" style="display: none">
  			</table>
  		</div>
 
  		<!-- <div class="table-responsive">
			<table id="permission_list_table" class="table table-bordered table-hover table-striped" style="display: none">
				<thead>
					<tr>
						<th style="display: none">User ID</th>
						<th>User Name</th>
						<th>Cell Phone</th>
						<th>Department</th>
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
						<td style="display: none"><?php echo $rows[$i][0]?></td>
						<td><?php echo $user_name?></td>
						<td><?php echo $rows[$i][2]?></td>
						<td><?php echo $rows[$i][3]?></td>
						<td><button id="edit_user" class="btn btn-default" type="button" onclick="edit_user(this)"><?php echo $han1?></button>      <button id="delete_user" class="btn btn-default" type="button" onclick="delete_user(this)"><?php echo $han2?></button></td>
					</tr>
				<?php
						}
					}
				?>
				</tbody>
			</table>
		</div> -->
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