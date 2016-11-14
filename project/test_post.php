<?php
	include "DBController.php";
?>

<script type="text/javascript">

	$(function(){

		$('#list1').change(function(){
			var selected_category = $('#list1 option:selected').val();
			alert(selected_category);
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

	/*	$('#list2').change(function(){
			var selected_category = $('#list1 option:selected').val();
			var selected_item = $('#list2 option:selected').val();
			alert(selected_category);
			alert(selected_item);
			//alert(selected_category);

			$.post("item1.php",{
				category:selected_category,
				item:selected_item
				}, 
				function(data,status) {
					alert(data);
					var data_by_list1 = data.split('/');
					for(var i=0; i<data_by_list1.length; i++) {
						alert(data_by_list1[i]);
						var value = data_by_list1[i].split(',');
						$('#list3').append("<option value='"+value[1]+"'>"+value[2]+"</option>");
					}
				}
			);
		});*/
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
						<?php
						$DBControlObject = new DBController();
						$rows = $DBControlObject->DeviceGroupsView();
						if(count($rows)>0) {
							for($i=0; $i<count($rows)-1; $i++) {
								$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][2]);
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
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<!-- /.col-xs-3 -->
        	<div class="col-xs-3">
				<select name="list2" id="list2" class="form-control" size="25">
				</select>
			</div>
			<!-- /.col-xs-3 -->			

			<div class="col-xs-3">
				<select name="list3" id="list3" class="form-control" size="25">
				</select>
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
				
