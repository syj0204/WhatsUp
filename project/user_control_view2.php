<?php
	include "DBController.php";
?>

<script type="text/javascript">

	function edit_user(td) {
		var index = td.parentElement.parentElement.rowIndex;
		var td_list = document.getElementById("user_list_table").rows.item(index).cells;
		var pre_td_values = new Array(td_list.length);
		for(var i=0; i<td_list.length; i++) {
			pre_td_values[i] = td_list[i].innerHTML;
		}
	
		td_list[1].innerHTML = "<input type='text' class='form-control' name='user_name_input' value='"+td_list[1].innerHTML+"' placeholder='Enter User Name'>";
		td_list[2].innerHTML = "<input type='text' class='form-control' name='user_cellphone_input' value='"+td_list[2].innerHTML+"' placeholder='Enter User Cellphone'>";
		td_list[3].innerHTML = "<select class='form-control'><option value='infra'>infra</option><option value='Security Network'>Security</option><option value='other'>other</option></select>";
		td_list[4].innerHTML = "<button id='update_button' class='btn btn-default' type='button' onclick='edit_user_update()'>Update</button>"
		+ "       <button id='cancel_button' class='btn btn-default' type='button' onclick='edit_user_cancel()'>Cancel</button>";
	}

	function delete_user(td) {
		var index = td.parentElement.parentElement.rowIndex;
		alert(index);
		var td_list = document.getElementById("user_list_table").rows.item(index).cells;
		var user_id = td_list[0].innerHTML;
		$.post("delete_user.php",{
			userid:user_id
			}, 
			function(data,status) {
				alert(data);
			}
		);
		document.getElementById("user_list_table").rows.item(index).remove();
	}

	function add_user() {
		var new_user_name = document.getElementById("user_name_to_add").value;
		var new_user_cellphone = document.getElementById("user_cellphone_to_add").value;
		var new_user_department = document.getElementById("user_department_to_add")
		new_user_department = new_user_department.options[new_user_department.selectedIndex].text;
		
		$.newtr = $("<tr><td>"+new_user_name+"</td><td>"+new_user_cellphone+"</td><td>"+new_user_department+"</td><td><button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'>Edit User</button>      <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'>Delete User</button></td></tr>");
		$('#user_list_table').append($.newtr);
		document.getElementById("user_list_table").rows.item(1).remove();
		/* if get 'td' parameter 
		var index = td.parentElement.parentElement.rowIndex;
		var td_list = document.getElementById("user_list_table").rows.item(index).cells;*/
		//alert("New User Added Successfully!!");

		$.post("user.php",{
			username:new_user_name,
			cellphone:new_user_cellphone,
			department:new_user_department
			}, 
			function(data,status) {
			//$("div#div1").html(data);
				alert(data);
				/*if(data=='success') {
					alert("New User Added Successfully!!");
				}*/
			}
		);
	}

	$(function(){
		
		$('#search_user').click(function(){
			//alert(''+$('#device_search_text').val());
			var value = $('#user_search_text').val(); 

			$("#user_list_table tbody tr").each(function(){
				$row = $(this);
				var text = $row.find("td:eq(0)").text();
				if(text.toLowerCase()==value.toLowerCase()) {
					$row.show();
				} else $row.hide();
			});
		});


		$('#add_user').click(function(){

			//$('#add_user_view').html('<input type="text" name="user_add_name" class="form-control" placeholder="Enter User Name"><br /><input type="text" name="user_add_cellphone" class="form-control" placeholder="Enter User CellPhone"><br />');

			//$.trClone = $('#user_list_table tr:last').clone().html();
			$.newtr = $("<tr><td><input type='text' id='user_name_to_add' class='form-control' placeholder='Enter User Name'></td><td><input type='text' id='user_cellphone_to_add' class='form-control' placeholder='Enter User Cellphone'></td><td><select id='user_department_to_add'  class='form-control'><option value='infra'>infra</option><option value='security'>security</option><option value='other'>other</option></select></td><td><button id='add_button' class='btn btn-default' type='button' onclick='add_user()'>Add</button></td></tr>");
			$('#user_list_table').prepend($.newtr);
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
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> User List</h3>
	</div>
	<div class="panel-body">
		<div class="row">
		<div class="col-lg-6">
   			<div class="input-group">
      			<input id="user_search_text" type="text" class="form-control" placeholder="Search for...">
     			<span class="input-group-btn">
        			<button id="search_user" class="btn btn-default" type="button">Search</button>
      			</span>
    		</div>
    		<!-- /input-group -->
  		</div>
  		<!-- /.col-lg-6 -->
  		<button id="add_user" class="btn btn-default" type="button">Add User</button>
  		</div>
  		<!-- /.row -->
  		<br />
  		
  		<div class="table-responsive">
			<table id="user_list_table" class="table table-bordered table-hover table-striped">
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
						<td><button id="edit_user" class="btn btn-default" type="button" onclick="edit_user(this)">Edit User</button>      <button id="delete_user" class="btn btn-default" type="button" onclick="delete_user(this)">Delete User</button></td>
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