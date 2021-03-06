<?php
	include "DBController.php";
	
	$han="사용자 추가";
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
<link rel="stylesheet" href="css/jquery.auto-complete.css">
<script src="js/jquery.auto-complete.js"></script>
<script src="js/jquery.auto-complete.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">

	function edit_user(td) {
		var index = td.parentElement.parentElement.rowIndex;
		//alert("index="+index);
		var td_list = document.getElementById("user_list_table").rows.item(index).cells;
		var pre_td_values = new Array(td_list.length);
		for(var i=0; i<td_list.length; i++) {
			pre_td_values[i] = td_list[i].innerHTML;
			//alert(td_list[i].innerHTML);
		}
		td_list[0].innerHTML = "<input type='text' style='display: none' id='user_id_to_update' value="+td_list[0].innerHTML+">";
		td_list[1].innerHTML = "<input type='text' class='form-control' id='user_name_to_update' value='"+td_list[1].innerHTML+"' placeholder='Enter User Name'>";
		td_list[2].innerHTML = "<input type='text' class='form-control' id='user_cellphone_to_update' value='"+td_list[2].innerHTML+"' placeholder='Enter User Cellphone'>";
		td_list[3].innerHTML = "<select id='user_department_to_update' class='form-control'><option value='infra'>infra</option><option value='Security Network'>Security</option><option value='other'>other</option></select>";
		td_list[4].innerHTML = "<button id='update_button' class='btn btn-default' type='button' onclick='edit_user_update(this)'><?php echo $han5?></button>"
		+ "       <button id='cancel_button' class='btn btn-default' type='button' onclick='edit_user_cancel(this)'><?php echo $han4?></button>";
	}

	function edit_user_update(td) {
		var index = td.parentElement.parentElement.rowIndex;
		var td_list = document.getElementById("user_list_table").rows.item(index).cells;
		//alert(index);
		//alert(td_list[1].innerHTML);
		var user_id = document.getElementById("user_id_to_update").value;
		//alert(user_id);
		var user_name_to_update = document.getElementById("user_name_to_update").value;
		//alert(user_name_to_update);
		var user_cellphone_to_update = document.getElementById("user_cellphone_to_update").value;
		//alert(user_cellphone_to_update);
		//var user_department_to_update = document.getElementById("user_department_to_update");
		//user_department_to_update = new_user_department.options[new_user_department.selectedIndex].text;
		var user_department_to_update = $("#user_department_to_update option:selected").val();
		//alert(user_department_to_update);
		
		$.post("update_user.php",{
			userid:user_id,
			username:user_name_to_update,
			cellphone:user_cellphone_to_update,
			department:user_department_to_update
			}, 
			function(data,status) {
				//alert(data);
				var user_info_array = null;
				if(data!=-1) {
					user_info_array = data.split(',');
					alert(user_info_array);
					td_list[0].innerHTML = "<td style='display: none'>"+user_info_array[0]+"</td>";
					td_list[1].innerHTML = "<td>"+user_info_array[1]+"</td>";
					td_list[2].innerHTML = "<td>"+user_info_array[2]+"</td>";
					td_list[3].innerHTML =  "<td>"+user_info_array[3]+"</td>";
					td_list[4].innerHTML = "<button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'><?php echo $han1?></button>"
					+ "       <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'><?php echo $han2?></button>";
				}
			}
		);
	}
	
	function edit_user_cancel(td) {
		var index = td.parentElement.parentElement.rowIndex;
		var td_list = document.getElementById("user_list_table").rows.item(index).cells;
		//alert(td_list[0].innerHTML);
		var user_id = document.getElementById("user_id_to_update").value;
		//alert(user_id);
		var user_name = document.getElementById("user_name_to_update").value;
		//alert(user_name);
		var user_cellphone = document.getElementById("user_cellphone_to_update").value;
		//alert(user_cellphone);
		var user_department = $("#user_department_to_update option:selected").text();
		//alert(user_department);

		td_list[0].innerHTML = "<td style='display: none'>"+user_id+"</td>";
		td_list[1].innerHTML = "<td>"+user_name+"</td>";
		td_list[2].innerHTML = "<td>"+user_cellphone+"</td>";
		td_list[3].innerHTML =  "<td>"+user_department+"</td>";
		td_list[4].innerHTML = "<button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'><?php echo $han1?></button>"
		+ "       <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'><?php echo $han2?></button>";
		
	}

	function delete_user(td) {
		var index = td.parentElement.parentElement.rowIndex;
		alert(index);
		var td_list = document.getElementById("user_list_table").rows.item(index).cells;
		alert(td_list[0].innerHTML+"/"+td_list[1].innerHTML+"/"+td_list[2].innerHTML+"/"+td_list[3].innerHTML);
		alert(typeof(td_list[0].innerHTML)+"/"+typeof(td_list[1].innerHTML)+"/"+typeof(td_list[2].innerHTML)+"/"+typeof(td_list[3].innerHTML));
		var user_id = td_list[0].innerHTML;
		$.post("delete_user.php",{
			userid:user_id
			}, 
			function(data,status) {
				if(data) {
					document.getElementById("user_list_table").rows.item(index).remove();
					alert("success!");
				} else alert("fail!");
			}
		);
	}

	function add_user() {
		var new_user_name = document.getElementById("user_name_to_add").value;
		var new_user_cellphone = document.getElementById("user_cellphone_to_add").value;
		var new_user_department = document.getElementById("user_department_to_add");
		new_user_department = new_user_department.options[new_user_department.selectedIndex].value;
		
		$.post("user.php",{
			username:new_user_name,
			cellphone:new_user_cellphone,
			department:new_user_department
			}, 
			function(data,status) {
				//alert(data);
				if(data) {
					$.newtr = $("<tr><td style='display: none'>"+data+"</td><td>"+new_user_name+"</td><td>"+new_user_cellphone+"</td><td>"+new_user_department+"</td><td><button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'><?php echo $han1?></button>      <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'><?php echo $han2?></button></td></tr>");
					$('#user_list_table').append($.newtr);
					document.getElementById("user_list_table").rows.item(1).remove();
					alert("success!");
				} else alert("fail");
				
			}
		);
	}

	function get_userlist() {
		$.post("get_userlist.php",
			function(data,status) {
				//alert(data);
				if(data!=-1) {
						var data_by_list1 = data.split('|');
						for(var i=0; i<data_by_list1.length-1; i++) {
							var value = data_by_list1[i].split(',');
							$.user_name = ICONV("EUC-KR","UTF-8",value[2]);
							$.newtr = $("<tr><td style='display: none'>"+value[1]+"</td><td>"+$.user_name+"</td><td>"+value[3]+"</td><td>"+value[4]+"</td><td><button id='edit_user' class='btn btn-default' type='button' onclick='edit_user(this)'><?php echo $han1?></button>      <button id='delete_user' class='btn btn-default' type='button' onclick='delete_user(this)'><?php echo $han2?></button></td></tr>");
							$('#user_list_table').append($.newtr);
							
						}
				}
			}
		);
	}

	$(function(){
		
		$('#search_user').click(function(){
			var value = $('#user_search_text').val(); 
			
			$("#user_list_table tbody tr").each(function(){
				$row = $(this);
				var text = $row.find("td:eq(1)").text();
				if(text.toLowerCase()==value.toLowerCase()) {
					$row.show();
				} else $row.hide();
			});
		});

		$('#user_search_text').autoComplete({
            minChars: 1,
            source: function(term, suggest){
                term = term.toLowerCase();
                var choices = devices_name;
                var suggestions = [];
                for (i=0;i<choices.length;i++)
                    if (~choices[i].toLowerCase().indexOf(term)) suggestions.push(choices[i]);
                suggest(suggestions);
            }
        });

		$('#add_user').click(function(){
			//$('#add_user_view').html('<input type="text" name="user_add_name" class="form-control" placeholder="Enter User Name"><br /><input type="text" name="user_add_cellphone" class="form-control" placeholder="Enter User CellPhone"><br />');
			//$.trClone = $('#user_list_table tr:last').clone().html();
			
			$.newtr = $("<tr><td><input type='text' id='user_name_to_add' class='form-control' placeholder='Enter User Name'></td><td><input type='text' id='user_cellphone_to_add' class='form-control' placeholder='Enter User Cellphone'></td><td><select id='user_department_to_add'  class='form-control'><option value='infra'>infra</option><option value='Security Network'>Security</option><option value='other'>other</option></select></td><td><button id='add_button' class='btn btn-default' type='button' onclick='add_user()'><?php echo $han5?></button></td></tr>");
			$('#user_list_table').prepend($.newtr);
		});

		$(window).load(function(e){
			alert("ABCDEFG");
			//get_userlist();
		});
		
		$(document).ready(function () {
			//alert("ABCDEFG");
			get_userlist();
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
  		
  		<div class="table-responsive">
			<table id="user_list_table" class="table table-bordered table-hover table-striped">
				<tr>
					<th style="display: none">User ID</th>
					<th>User Name</th>
					<th>Cell Phone</th>
					<th>Department</th>
					<th>Option</th>
				</tr>
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