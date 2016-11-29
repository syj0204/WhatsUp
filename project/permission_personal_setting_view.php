<?php
	include "DBController.php";
	include "String.php";
?>
<link rel="stylesheet" href="css/jquery.auto-complete.css">
<script src="js/jquery.auto-complete.js"></script>
<script src="js/jquery.auto-complete.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	var available_tags=[];
	var current_rows_length = -1;

	function load_permission_table() {
		reset_permission_table();
		reset_public_variables();
		toggle_add_and_groupselect_view();

		var user_id = $('#user_list option:selected').val();
		var devicegroup_id = $('#devicegroup_list option:selected').val();

		$.post("get_permission_all.php",{
			user:user_id
			}, 
			function(data,status) {
				if(data!=-1) {
					var data_list = data.split('|');
					for(var i=0; i<data_list.length-1; i++) {
						var value = data_list[i].split(',');
						$.newtr = $("<tr><td>"+(i+1)+"</td><td style='display:none'>"+value[3]+"</td><td>"+value[4]+"</td><td style='display:none'>"+value[1]+"</td><td>"+value[2]+"</td><td><button id='delete_permission' class='btn btn-default' type='button' onclick='delete_permission(this)'><?php echo $han2?></button></td></tr>");
						$('#permission_list_table tbody').append($.newtr);

						if(devicegroup_id!=-1) {
							current_row_devicegroup_id = value[3];
							if(current_row_devicegroup_id==devicegroup_id) {
								$.newtr.show();
								available_tags.push(value[2]);
								current_rows_length++;
							}
							else $.newtr.hide();
						} else {
							$.newtr.show();
							available_tags.push(value[2]);
							current_rows_length++;
						}
					}
				}
				toggle_views_related_with_tbody();
			}
		);
	}

	function reset_permission_table() {
		$('#permission_list_table tbody tr').remove();
	}
	
	function reset_public_variables() {
		available_tags.length = 0;
		current_rows_length = 0;
	}
	
	function toggle_add_and_groupselect_view() {
		var user_id = $('#user_list option:selected').val();
		if(user_id>0) {
			$('#add_permission').removeAttr('disabled');
			$('#devicegroup_list').removeAttr('disabled');
		} else {
			$('#add_permission').attr('disabled', 'true');
			$('#devicegroup_list').attr('disabled', 'true');
		}
	}
	
	function toggle_views_related_with_tbody() {
		//var permission_table_rows = $('#permission_list_table tbody tr').length;
		if(current_rows_length>0) {
			$('#permission_search_text').removeAttr('disabled');
			$('#search_permission').removeAttr('disabled');
			$('#delete_permission_multiple').removeAttr('disabled');
		}
		else {
			$('#permission_search_text').attr('disabled', 'true');
			$('#search_permission').attr('disabled', 'true');
			$('#delete_permission_multiple').attr('disabled', 'true');
		} 
	}

	function delete_permission_multiple_mode_in() {
		$('#permission_search_text').attr('disabled', 'true');
		
		$('#search_permission').attr('disabled', 'true');
		$('#add_permission').attr('disabled', 'true');
		$('#delete_permission_multiple').hide();
		$('#delete_permission_multiple_save').show();
		$('#user_list').attr('disabled', 'true');
		$('#devicegroup_list').attr('disabled', 'true');
		
		$("#permission_list_table thead tr").find('th').eq(5).hide();
		$("#permission_list_table tbody tr").each(function(){
			$(this).find('td').eq(5).hide();
		});
		
		$("#permission_list_table thead tr").prepend("<th><input type='checkbox' onchange='toggle_all_check(this)' /></th>");
		$("#permission_list_table tbody tr").each(function(){
			$(this).prepend("<td><input type='checkbox' onchange='toggle_each_check(this)' /></td>");
		});
	}

	function delete_permission_multiple_mode_out() {
		//var permission_table_rows = $('#permission_list_table tbody tr').length;
		$('#user_list').removeAttr('disabled');
		$('#devicegroup_list').removeAttr('disabled');
		$("#permission_list_table thead tr").find('th').eq(0).remove();
		$("#permission_list_table thead tr").find('th').eq(5).show();
		$("#permission_list_table tbody tr").each(function(){
			$(this).find('td').eq(5).show();
		});
		$('#delete_permission_multiple_save').hide();
		$('#delete_permission_multiple').show();
		if(current_rows_length>0) {
			$('#permission_search_text').removeAttr('disabled');
			$('#search_permission').removeAttr('disabled');
		} else {
			$('#delete_permission_multiple').attr('disabled', 'true');
		}
		$('#add_permission').removeAttr('disabled');
	}

	function delete_permission(td) {
		var user_id = $('#user_list option:selected').val();
		var index = td.parentElement.parentElement.rowIndex;
		var td_list = document.getElementById("permission_list_table").rows.item(index).cells;
		
		$.post("delete_permission2.php",{
			user:user_id,
			device:td_list[3].innerHTML
			}, 
			function(data,status) {
				load_permission_table();
			}
		);
	}

	function delete_permission_multiple(devicelist) {
		var user_id = $('#user_list option:selected').val();
		if(devicelist.length>0) {
			$.post("delete_permission3.php",{
				user:user_id,
				devicelist:devicelist
				}, 
				function(data,status) {
					if(data!=-1) {
						
					} else alert("fail!");
				}
			);
		}
		delete_permission_multiple_mode_out();
		load_permission_table();
	}
	
	function toggle_all_check(th) {
		if(th.checked) {
			$("#permission_list_table tbody tr").each(function(){
				if($(this).is(':visible')) {
					$(this).find("td input[type='checkbox']").prop('checked', true);
				}
			});
			/*$("#permission_list_table tbody tr td input[type='checkbox']").each(function(){
				$(this).prop('checked', true);
			});*/
		} else {
			$("#permission_list_table tbody tr").each(function(){
				if($(this).is(':visible')) {
					$(this).find("td input[type='checkbox']").prop('checked', false);
				}
			});
			/*$("#permission_list_table tbody tr td input[type='checkbox']").each(function(){
				$(this).prop('checked', false);
			});*/
		}
	}

	function toggle_each_check(td) {
		var th = $("#permission_list_table thead tr th input[type='checkbox']");
		var count = 0;
		
		if(th.is(':checked')) {
			$("#permission_list_table tbody tr td input[type='checkbox']").each(function(){
				if($(this).is(':checked')) {
					count++;
				}
				if(count!=current_rows_length) {
					th.prop('checked', false);
				}
			});
		} else {
			$("#permission_list_table tbody tr td input[type='checkbox']").each(function(){
				if($(this).is(':checked')) {
					count++;
				}
				if(count==current_rows_length) {
					th.prop('checked', true);
				}
			});
		}
	}
	
	$(function(){
				
		$('#user_list').change(function(){
			load_permission_table();
			toggle_views_related_with_tbody();
		});
		
		$('#devicegroup_list').change(function(){
			load_permission_table();
			toggle_views_related_with_tbody();
		});
		
		$('#add_permission').click(function(){
			var user_id = $('#user_list option:selected').val();
			var devicegroup_id = $('#devicegroup_list option:selected').val();
			if(devicegroup_id==-1) {
				$.post("get_no_permission_all.php",{
					user:user_id
					}, 
					function(data,status) {
						if(data!=-1) {
							var data_list = data.split('|');
							for(var i=0; i<data_list.length-1; i++) {
								var value = data_list[i].split(',');
								$.newtr = $("<option value="+value[1]+">"+value[3]+" / "+value[2]+"</option>");
								$('#available_devices_list').append($.newtr);
							}
						}
					}
				);
			} else {
				$.post("get_no_permission_by_devicegroup.php",{
					user:user_id,
					devicegroup:devicegroup_id
					}, 
					function(data,status) {
						$('#available_devices_list option').each(function() {
							$(this).remove();
						});
						
						if(data!=-1) {
							var data_list = data.split('|');
							for(var i=0; i<data_list.length-1; i++) {
								var value = data_list[i].split(',');
								$.newtr = $("<option value="+value[1]+">"+value[3]+" / "+value[2]+"</option>");
								$('#available_devices_list').append($.newtr);
							}
						}
					}
				);
			}
		});
		
		$('#add_permission_save').click(function(){
			var user_id = $('#user_list option:selected').val();
			var devices = [];
			devices.length=0;
			$('#selected_devices_list option').each(function() {
				devices.push($(this).val());
				$(this).remove();
			});
			if(devices.length>0) {
				$.post("add_permission.php",{
					user:user_id,
					devicearray:devices
					}, 
					function(data,status) {
						if(data==1) {
							load_permission_table();
						} else alert(data);
					}
				);
			}
		});
				
		$('#add_permission_close').click(function(){
			$('#available_devices_list option').each(function() {
				$(this).remove();
			});
		});

		$('#delete_permission_multiple').click(function(){
			var checklist_to_delete = [];
			checklist_to_delete.length = 0;
			delete_permission_multiple_mode_in();
		});

		$('#delete_permission_multiple_save').click(function(){
			var checklist_to_delete = [];
			checklist_to_delete.length = 0;

			var device = "";
			$("#permission_list_table tbody tr td input[type='checkbox']").each(function(){
				if($(this).is(':checked')) {
					device = $(this).closest("tr").find('td:nth-child(5)').html();
					checklist_to_delete.push(device);
				}
			});
			delete_permission_multiple(checklist_to_delete);
		});
		
		$('#permission_search_text').autoComplete({
            minChars: 1,
            source: function(term, suggest){
                term = term.toLowerCase();
                var suggestions = [];
                var choices = available_tags;
                for (i=0;i<choices.length;i++)
                    if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            }
        });
        
		$('#permission_search_text').keyup(function() {
			var value = $('#permission_search_text').val();
			if(value=="") {
				var devicegroup_id = $('#devicegroup_list option:selected').val();
				if(devicegroup_id!=-1) {
					$("#permission_list_table tbody tr").each(function(){
						current_row_devicegroup_id = $(this).find('td').eq(1).text();
						if(current_row_devicegroup_id==devicegroup_id) $(this).show();
						else $(this).hide();
					});
				} else {
					$("#permission_list_table tbody tr").each(function(){
						$(this).show();
					});
				}
			}
		});
	
		$('#search_permission').click(function(){
			var value = $('#permission_search_text').val(); 
			if(value.length>0) {
				$("#permission_list_table tbody tr").each(function(){
					$row = $(this);
					var text = $row.find("td:eq(4)").text();
					if(text.toLowerCase()==value.toLowerCase()) {
						$row.show();
					} else $row.hide();
				});
			}
		});
		
		$('#toRightAllDevices').click(function(){
			$('#available_devices_list option').each(function() {
				var current_item_value = $(this).val();
				var current_item_text = $(this).text();
				$('#selected_devices_list').append("<option value="+current_item_value+">"+current_item_text+"</option>");
				$(this).remove();
			});
		});
			
		$('#toRightSelectedDevices').click(function(){
			$('#available_devices_list option:selected').each(function() {
				var current_item_value = $(this).val();
				var current_item_text = $(this).text();
				$('#selected_devices_list').append("<option value="+current_item_value+">"+current_item_text+"</option>");
				$(this).remove();
			});
		});
			
		$('#toLeftSelectedDevices').click(function(){
			$('#selected_devices_list option:selected').each(function() {
				var current_item_value = $(this).val();
				var current_item_text = $(this).text();
				$('#available_devices_list').append("<option value="+current_item_value+">"+current_item_text+"</option>");
				$(this).remove();
			});
		});
			
		$('#toLeftAllDevices').click(function(){
			$('#selected_devices_list option').each(function() {
				var current_item_value = $(this).val();
				var current_item_text = $(this).text();
				$('#available_devices_list').append("<option value="+current_item_value+">"+current_item_text+"</option>");
				$(this).remove();
			});
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
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Personal Setting</h3>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="form-group">
			<!-- <div class="col-sm-2"> -->
			<div class="col-xs-4">
			<label>Select User</label>
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
			<!-- <div class="col-xs-2"> -->
			<!-- <div class="col-xs-4">
				<label>Select Device Group</label>
	    		<select name="devicegroup_list" id="devicegroup_list" class="form-control selcls">
	    			<option value=-1> -- Select Device Group -- </option>
		    		<?php
						$DBControlObject = new DBController();
						$rows = $DBControlObject->DeviceGroupsView();
						if(count($rows)>0) {
							for($i=0; $i<count($rows); $i++) {
								$device_group_name = ICONV("EUC-KR","UTF-8",$rows[$i][2]);
					?>
		
								<option value=<?php echo $rows[$i][0]?>>
					<?php
								echo "Device / " .$device_group_name." <br> \n";
							}
					?>
								</option>
					<?php
						}
					?>
	    		</select>
			</div> -->
		</div>
		</div>
		<br />
	
		<div class="row">
		<div class="col-lg-6">
   			<div id="permission_search_add_view" class="input-group" disabled>
      			<input id="permission_search_text" class="form-control" type="text" disabled placeholder="<?php echo $han6?>">
     			<span class="input-group-btn">
        			<button id="search_permission" class="btn btn-default" type="button" disabled><?php echo $han3?></button>
        			<button id="add_permission" class="btn btn-default" type="button" disabled data-toggle="modal" data-target="#add_permission_dialog"><?php echo $han?></button>
        			<button id="delete_permission_multiple" class="btn btn-default" type="button" disabled><?php echo $han2?></button>
        			<button id="delete_permission_multiple_save" class="btn btn-default" type="button" style="display:none"><?php echo $han5?></button>
      			</span>
    		</div>
    		<!-- /input-group -->

    		<!-- Modal -->
			<div class="modal fade" id="add_permission_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			        <h4 class="modal-title" id="myModalLabel">Add New Permission</h4>
			      </div>
			      <div class="modal-body">
			        

					<div class="row">
					<div class="col-lg-12">
						<label>Available Devices List</label>
					</div>
					<div class="col-xs-8">
						<select name="available_devices_list" id="available_devices_list" class="form-control" size="10" multiple="multiple">
						</select>
					</div>
					<!-- /.col-xs-4 -->
					<div class="col-xs-4">
						<button type="button" id="toRightAllDevices" class="btn btn-default btn-block">Add All Device</button>
						<button type="button" id="toRightSelectedDevices" class="btn btn-default btn-block">Add Selected Device</button>
					</div>
					<!-- /."col-xs-2" -->
					</div>
					<br />
					<div class="row">
					<div class="col-lg-12">
						<label>Newly Added Devices List</label>
					</div>
					<div class="col-xs-8">
						<select name="selected_devices_list" id="selected_devices_list" class="form-control" size="10" multiple="multiple"></select>
					</div>
					<div class="col-xs-4">
						<button type="button" id="toLeftSelectedDevices" class="btn btn-default btn-block">Cancel Selected Device</button>
						<button type="button" id="toLeftAllDevices" class="btn btn-default btn-block">Cancel All Device</button>
					</div>
					</div>
					<!-- /.row -->


			      </div>
			      <div class="modal-footer">
			        <button id="add_permission_close" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <button id="add_permission_save" type="button" class="btn btn-primary">Save Changes</button>
			      </div>
			    </div>
			  </div>
			</div>
  		</div>
  		<!-- /.col-lg-6 -->
  		
  		</div>
  		<!-- /.row -->
  		<br />
  		<div id="permission_table_view">
  			<table id="permission_list_table" class="table table-bordered table-hover table-striped">
  				<thead id="thead_all">
					<tr>
						<th>Row No.</th>
						<th style="display:none">Device Group ID</th>
						<th><!-- Device Group  -->
							<select name="devicegroup_list" id="devicegroup_list" class="form-control selcls" disabled>
				    			<option value=-1>Device Group</option>
					    		<?php
									$DBControlObject = new DBController();
									$rows = $DBControlObject->DeviceGroupsView();
									if(count($rows)>0) {
										for($i=0; $i<count($rows); $i++) {
											$device_group_name = ICONV("EUC-KR","UTF-8",$rows[$i][2]);
								?>
					
											<option value=<?php echo $rows[$i][0]?>>
								<?php
											echo $device_group_name." <br> \n";
										}
								?>
											</option>
								<?php
									}
								?>
	    					</select>
	    				</th>
	    				<th style="display:none">Device ID</th>
	    				<th>Device Name</th>
	    				<th>Option</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
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