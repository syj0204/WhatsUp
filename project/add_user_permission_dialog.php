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

		$('#toRightAllDevices').click(function(){
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
			
		$('#toLeftAllDevices').click(function(){
			$('#selected_device_list option').each(function() {
				$(this).remove().appendTo('#device_list');
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

</script>
<div class="col-lg-12">
	<label>Available Devices List</label>
</div>
<div class="row">
<div class="col-xs-4">
	<select name="available_devices_list" id="available_devices_list" class="form-control" size="10" multiple="multiple">
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
	<button type="button" id="toRightAllDevices" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
	<button type="button" id="toRightSelectedDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
	<button type="button" id="toLeftSelectedDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
	<button type="button" id="toLeftAllDevices" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
</div>
<!-- /."col-xs-2" -->

<div class="col-xs-4">
	<select name="selected_devices_list" id="selected_devices_list" class="form-control" size="12" multiple="multiple"></select>
</div>
</div>
<!-- /.row -->