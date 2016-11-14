
<!--  현재 Divce 목록 호출 부분 제작중 -->

<?php
	include "DBController.php";
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>


/*
$.ajax({
	url: 'test_post.php'
	type: 'post'
	data: {
		Name: '$("#Device_List option:selected").text()'
	}
	datatype: 'text'
});

$.post("test_post2.php",{
		name:user_department_to_update
		}, 
		function(data,status) {
			alert(data);
		}
		}
	);


*/
function update() {

	var device_list_1 = $("#device_list option:selected").val();
	alert(device_list_1);
	
	$.post("test_post2.php",{
		name:device_list_1
		}, 
		function(data,status) {
			$("div#div1").html(data); 
		}
		);
	 }

	



</script>


	<div class="row">
	   <div class="col-xs-6">
    	<div class="row">
        	<div class="col-xs-4">
				<select name ="device_list" id="device_list" class="form-control" size="12" onchange="update()"  >
					<?php
						$DBControlObject = new DBController();
						$rows = $DBControlObject->DeviceGroupsView();
						if(count($rows)>0) {
							for($i=0; $i<count($rows)-1; $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
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
		</div>
		<!-- /.row -->
 <div id="div1" > </div> 
		</div>
	<!-- /.col-xs-6 -->
</div>
<!-- /.row -->

