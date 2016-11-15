<?php
	include "DBController.php";
?>

<script type="text/javascript">

	$(function(){

		$('#list1').change(function(){
			$('#list2 option').remove();
			$('#list3 option').remove();
			var selected_category = $('#list1 option:selected').val();
			//alert(selected_category);
			$.post("test_post2.php",{
				category:selected_category
				}, 
				function(data,status) {
					//alert(data);
					var data_by_category = data.split('/');
					for(var i=0; i<data_by_category.length-1; i++) {
						//alert(data_by_category[i]);
						var value = data_by_category[i].split(',');
						$('#list2').append("<option value='"+value[1]+"'>"+value[2]+"</option>");
					}
				}
			);
		});

	$('#list2').change(function(){
		$('#list3 option').remove();
		var selected_category = $('#list1 option:selected').val();
		var selected_item = $('#list2 option:selected').val();
			//alert(selected_item);
			//alert(selected_category);

			$.post("test_post3.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					var data_by_list1 = data.split('/');
					for(var i=0; i<data_by_list1.length-1; i++) {
						var value = data_by_list1[i].split(',');
						$('#list3').append("<option value='"+value[1]+"'>"+value[2]+"</option>");
					}
				}
			);
		});
	});
	$('#edit_permission').click(function(){

		$('#list3').attr( "size", 11 );
		$('#list4').show();
		//$('#edit_permission').text("SAVE");
		$('#edit_permission').hide();
		$('#edit_permission_save').show();
		$('#edit_permission_cancel').show();

		/*var list3_array = [];
		$('#list3 option').each(function() {
			list3_array.push($(this));
		});

		$('#list3 option').remove();
		for(var i=3; i<list3_array.length; i++) {
			$('#list3').append("<option value="+list3_array[i].val()+">"+list3_array[i].text()+"</option>");
		}*/

		var selected_category = $('#list1 option:selected').val();
		var selected_item = $('#list2 option:selected').val();

		$.post("get_no_permission_device_list.php",{
			category:selected_category,
			item:selected_item
			}, 
			function(data,status) {
				//alert(data);
				var data_by_category_item = data.split('/');
				//alert(data_by_category.length);
				for(var i=0; i<data_by_category_item.length-1; i++) {
					//alert(data_by_category[i]);
					var value = data_by_category_item[i].split(',');
					//alert(value.length);
					$('#list4').append("<option value="+value[1]+">"+value[1]+"."+value[2]+"</option>");
				}
			}
		);
		/*var $dialog_select = $('<select>');
        $text.append('<option>temp</option>');
        $text.append('</select>');
        
        BootstrapDialog.show({
            title: 'Edit Permission',
            message: $text,
            buttons: [{
                label: 'Save',
                action: function(dialogRef){
                    dialogRef.close();
                }
            }, {
                label: 'cancel',
                action: function(dialogRef){
                    dialogRef.close();
                }
            }]
        });*/
	});

	$('#list3').change(function(){
		var to_delete_item = $('#list3 option:selected').remove().appendTo('#list4').val();
		to_delete_list.push(to_delete_item);
	});

	$('#list4').change(function(){
		var to_add_item = $('#list4 option:selected').remove().appendTo('#list3').val();
		//new_added_lists.push(new_list_item);
		to_add_list.push(to_add_item);
	});

	$('#edit_permission_save').click(function(){
		var selected_category = $('#list1 option:selected').val();
		var selected_item = $('#list2 option:selected').val();

		alert(selected_category);
		alert(selected_item);

		switch(selected_category) {
			case 'user':
				//alert("user");
				//alert(to_add_list);
				$.post("permission_update.php",{
					user:selected_item,
					devicearray:to_add_list
					}, 
					function(data,status) {
						alert(data);
					}
				);
				break;
			case 'device':
				break;
			case 'devicegroup':
				break;
			case 'host':
				//$result = $DBControlObject->;
				break;
		}
		
		$('#list4').hide();
		$('#list3').attr( "size", 25 );
		$('#edit_permission').show();
		$('#edit_permission_save').hide();
		$('#edit_permission_cancel').hide();
		
	});

</script>
	
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
	<h1 class="page-header">Permission <small>Permission Overview</small></h1>
	<ol class="breadcrumb">
		<li class="active"><i class="fa fa-dashboard"></i> Permission</li>
	</ol>
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
	<!-- <div id="morris-area-chart"></div> -->

	<div class="row">
		<div class="col-lg-12">
    		<label>DeviceGroups</label>
		</div>
    	<div class="row">
        	<div class="col-xs-3">
				<select name="list1" id="list1" class="form-control" size="25">	
					<option value="User">User</option>	
					<option value="Device">Device / ALL</option>					
						<?php
						$DBControlObject = new DBController();
						$rows = $DBControlObject->DeviceGroupsView();
						if(count($rows)>0) {
							for($i=0; $i<count($rows)-1; $i++) {
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
		<!-- /.col-xs-3 -->
        	<div class="col-xs-3">
				<select name="list2" id="list2" class="form-control" size="25">
				</select>
			</div>
			<!-- /.col-xs-3 -->			

			
			<div class="col-xs-2">
				<select name="list3" id="list3" class="form-control" size="25">
				</select>
				<br />
				<select name="list4" id="list4" class="form-control" size="11" style="display: none">
				</select>
			</div>
			<!-- /.col-xs-2 -->	
			<div class="col-xs-3" align="center">
				<button id="edit_permission" class="btn btn-default" type="button">Edit Permission</button>
				<button id="edit_permission_save" class="btn btn-default" type="button" style="display: none">Save</button>
				<button id="edit_permission_cancel" class="btn btn-default" type="button" style="display: none">Cancel</button>
			</div>
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
				
