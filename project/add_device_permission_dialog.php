<?php
	include "DBController.php";
	$category =$_GET["category"];
	$user_id =$_GET["userid"];
?>
<script type="text/javascript">

	$(function(){

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

		$('#add_permission_btn').click(function(){
			var devices = [];
			
			$('#selected_devices_list option').each(function() {
				devices.push($(this).val());
			});
			alert(devices);
			if(devices.length>0) {
				$.post("add_permission.php",{
					user:$('#user_id').val(),
					devicearray:devices
					}, 
					function(data,status) {
						if(data==1) {
							alert("success");
							$('#selected_devices_list option').each(function() {
								$(this).remove();
							});
						} else alert(data);
					}
				);
			} else alert("Choose Device");	
			
		});

	});

</script>

<div class="row">
<div class="col-lg-12">
	<label>Available Devices List</label>
</div>
<div class="col-xs-8">
	<input id="user_id" type="hidden" value=<?php echo $user_id?> />
	<select name="available_devices_list" id="available_devices_list" class="form-control" size="10" multiple="multiple">
		<?php
			$DBControlObject = new DBController();
			$rows = $DBControlObject->getDeviceListNotForUser($user_id);
			if(count($rows)>0) {
				for($i=0; $i<count($rows); $i++) {
					$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
		?>
					<option value=<?php echo $rows[$i][0]?>>
		<?php
					echo $rows[$i][0].",".$device_name." <br> \n";
				}
		?>
					</option>
		<?php
			}
		?>
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
	<select name="selected_devices_list" id="selected_devices_list" class="form-control" size="12" multiple="multiple"></select>
</div>
<div class="col-xs-4">
	<button type="button" id="toLeftSelectedDevices" class="btn btn-default btn-block">Cancel Selected Device</button>
	<button type="button" id="toLeftAllDevices" class="btn btn-default btn-block">Cancel All Device</button>
</div>
</div>
<!-- /.row -->
<br />
<div class="row">
<div class="col-xs-2" align="center">
	<button id="add_permission_btn" class="btn btn-default" type="button">Add Permission</button>
</div>
</div>