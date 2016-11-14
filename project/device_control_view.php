<?php
	include "DBController.php";
?>

<script type="text/javascript">

	function edit_device(td) {
		var index = td.parentElement.parentElement.rowIndex;
		var td_list = document.getElementById("device_list_table").rows.item(index).cells;
		var pre_td_values = new Array(td_list.length);
		for(var i=0; i<td_list.length; i++) {
			pre_td_values[i] = td_list[i].innerHTML;
		}
		
		td_list[0].innerHTML = "<input type='text' name='device_name_input' value='"+td_list[0].innerHTML+"' placeholder='Enter Device Name'>";
		td_list[1].innerHTML = "<button id='update_button' class='btn btn-default' type='button' onclick='edit_device_update("+index+")'>Update</button>" + "       <button id='cancel_button' class='btn btn-default' type='button' onclick='edit_device_cancel("+index+","+pre_td_values+")'>Cancel</button>";
	}


	$(function(){
		$('#device_search').click(function(){
			//alert(''+$('#device_search_text').val());
			var value = $('#device_search_text').val(); 

			$("#device_list_table tbody tr").each(function(){
				$row = $(this);
				var text = $row.find("td:eq(0)").text();
				if(text.toLowerCase()==value.toLowerCase()) {
					$row.show();
				} else $row.hide();
				
			});
		});

		$('#add_device').click(function(){

			//$('#add_user_view').html('<input type="text" name="user_add_name" class="form-control" placeholder="Enter User Name"><br /><input type="text" name="user_add_cellphone" class="form-control" placeholder="Enter User CellPhone"><br />');

			//$.trClone = $('#user_list_table tr:last').clone().html();
			$.newtr = $("<tr><td>-</td><td><input type='text' id='device_name_to_add' class='form-control' placeholder='Enter Device Name'></td><td><button id='add_button' class='btn btn-default' type='button' onclick='add_device()'>Add</button></td></tr>");
			$('#device_list_table').prepend($.newtr);
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
	<h1 class="page-header">Device</h1>
</div>
</div>

<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Device List</h3>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-lg-6">
   			<div class="input-group">
      			<input id="device_search_text" type="text" class="form-control" placeholder="Search for...">
     			<span class="input-group-btn">
        			<button id="device_search" class="btn btn-default" type="button">Search</button>
      			</span>
    		</div>
    		<!-- /input-group -->
  		</div>
  		<!-- /.col-lg-6 -->
  		<!-- <button id="add_device" class="btn btn-default" type="button">Add Device</button> -->
  		</div>
  		<!-- /.row -->
  		
  		<br />
  		
  		<div class="table-responsive">
			<table id="device_list_table" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<!-- <th>Device ID</th> -->
						<th>Device Name</th>
						<!-- <th>Option</th> -->
					</tr>
				</thead>
				<tbody>

				<?php 
					$DBControlObject = new DBController();
					$rows = $DBControlObject->getDeviceList();
					if(count($rows)>0) {
						for($i=0; $i<count($rows); $i++) {
							$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
				?>
					<tr>
						<!-- <td><?php //echo $rows[$i][0]?></td> -->
						<td><?php echo $device_name?></td>
						<!-- <td><button id="edit_device" class="btn btn-default" type="button" onclick="edit_device(this)">Edit Device</button>      <button id="delete_device" class="btn btn-default" type="button">Delete Device</button></td> -->
					</tr>
				<?php
		
						}
					}
				?>
				</tbody>
			</table>
		</div>
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