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
<link href="css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap-dialog.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	function delete_permission(td) {

		var user_id = $('#list1 option:selected').val();
		var devicegroup_id = $('#list2 option:selected').val();
		var index = td.parentElement.parentElement.rowIndex;
		alert(index);
		var td_list = document.getElementById("permission_list_table").rows.item(index).cells;
		alert(td_list[0].innerHTML+"/"+td_list[1].innerHTML+"/"+td_list[2].innerHTML);

		$.post("delete_permission2.php",{
			user:user_id,
			device:td_list[0].innerHTML
			}, 
			function(data,status) {
				alert(data);
				document.getElementById("permission_list_table").rows.item(index).remove();
			}
		);
	}
	
	function initSelectBoxes() {
		$('select').find('option:first').attr('selected', 'selected');  
		$('#list2 option').remove();
		$('#list3 option').remove();
		$('#list2_title').text("List By Category");
		$('#list3_title').text("Permission List");
		$('#permission_list_table tr').remove();
		$('#permission_search_add_view').hide();
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
			//$.headtr = $("<tr><th>Device ID</th><th>Device Group</th><th>Device Name</th><th>Option</th></tr>");
			$.headtr = $("<tr><th>Device ID</th><th>Device Name</th><th>Option</th></tr>");
			$('#permission_list_table').append($.headtr);
			
			$('#permission_search_add_view').show();
			$('#permission_list_table').show();
			
			var user_id = $('#list1 option:selected').val();
			var devicegroup_id = $('#list2 option:selected').val();

			$.post("get_permission_by_devicegroup.php",{
				user:user_id,
				devicegroup:devicegroup_id
				}, 
				function(data,status) {
					alert(data);
					if(data!=null) {
						var data_by_list1 = data.split('|');
						alert(data_by_list1);

						for(var i=0; i<data_by_list1.length-1; i++) {
							var value = data_by_list1[i].split(',');
							//$.newtr = $("<tr><td style='display: none'>"+data+"</td><td>"+new_user_name+"</td><td>"+new_user_cellphone+"</td><td>"+new_user_department+"</td><td><button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'><?php echo $han1?></button>      <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'><?php echo $han2?></button></td></tr>");
							//$.newtr = $("<tr><td>"+value[1]+"</td><td>"+value[2]+"</td><td>"+value[3]+"</td><td><button id='delete_permission' class='btn btn-default' type='button' onclick='delete_permission(this)'><?php echo $han2?></button></td></tr>");
							$.newtr = $("<tr><td>"+value[1]+"</td><td>"+value[2]+"</td><td><button id='delete_permission' class='btn btn-default' type='button' onclick='delete_permission(this)'><?php echo $han2?></button></td></tr>");
							$('#permission_list_table').append($.newtr);
						}
					} else alert("No Permission in this group!!");
				}
			);
		});

		$('#add_permission').click(function(){
			var list1_item = $('#list1 option:selected').val();
			var list2_item = $('#list2 option:selected').val();
			BootstrapDialog.show({
				title: "Add Permission",
	            message: $('<div></div>').load('add_device_permission_dialog.php?category='+list1_item+'&userid='+list2_item),
	            onhide: function(dialogRef){
		            //alert("abcde"+dialogRef);
	            	//$("#list2").change();
	            	//$('#list2').trigger('change'); 
		            //$.newtr = $("<tr><td>"+value[1]+"</td><td>"+value[2]+"</td><td>"+value[3]+"</td><td><button id='delete_permission' class='btn btn-default' type='button' onclick='delete_permission(this)'><?php echo $han2?></button></td></tr>");
					//$('#permission_list_table').append($.newtr);
	            }
	        });
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

		$('#search_permission').click(function(){
			var value = $('#permission_search_text').val(); 
			
			$("#permission_list_table tbody tr").each(function(){
				$row = $(this);
				var text = $row.find("td:eq(2)").text();
				if(text.toLowerCase()==value.toLowerCase()) {
					$row.show();
				} else $row.hide();
			});
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
			<label id="list1_title">Select User</label>
	    	<select name="user_list" id="user_list" class="form-control selcls">
	    		<option> -- Select User -- </option>
				<?php
					$DBControlObject = new DBController();
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
					}
				?>
			</select>
			</div>
			<div class="col-xs-2">
				<label id="list2_title">Select Device Group</label>
	    		<select name="devicegroup_list" id="devicegroup_list" class="form-control selcls">
	    			<option> -- Select Device Group -- </option>
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
		</div>
		</div>
		<br />
	
		<div id="permission_search_add_view" class="row" style="display:none">
		<div class="col-lg-6">
   			<div class="input-group">
      			<input id="permission_search_text" type="text" class="form-control" placeholder="<?php echo $han6?>~~">
     			<span class="input-group-btn">
        			<button id="search_permission" class="btn btn-default" type="button"><?php echo $han3?></button>
      			</span>
    		</div>
    		<!-- /input-group -->
    		<button id="add_permission" class="btn btn-default" type="button"><?php echo $han?></button>
  		</div>
  		<!-- /.col-lg-6 -->
  		
  		</div>
  		<!-- /.row -->
  		<br />
  		<div id="permission_table_view">
  			<table id="permission_list_table" class="table table-bordered table-hover table-striped" style="display: none">
  				<!-- <tr><th>Device ID</th><th>Device Group</th><th>Device Name</th><th>Option</th></tr> -->
  			</table>
  		</div>
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