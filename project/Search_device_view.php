<?php
	include "DBController.php";
?>
<!-- 
<script type="text/javascript">

	$(function(){
		$('#device_search').click(function(){
			//alert(''+$('#device_search_text').val());
			var value = $('#device_search_text').val(); 

			$("#device_list_table tbody tr").each(function(){
				$row = $(this);
				var text = $row.find("td:eq(2)").text();
				alert(text);
				/*if(text.toLowerCase()==value.toLowerCase()) {
					
				}*/
				
			});
		});

	});

	$(window).load(function(e){

	});

</script>
 -->
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
   		<!-- <div class="input-group">
      			<input id="device_search_text" type="text" class="form-control" placeholder="Search for...">
     			<span class="input-group-btn">
        			<button id="device_search" class="btn btn-default" type="button">Search</button>
      			</span>
    		</div>
    			<button id="add_device" class="btn btn-default" type="button">Add Device</button>
    	 -->	
    		<!-- /input-group -->
  		</div>
  		<!-- /.col-lg-6 -->
  	
  		</div>
  		<!-- /.row -->
  		
  		<br />
  		
  		<div class="table-responsive">
			<table id="device_list_table" class="table table-bordered table-hover table-striped">
				<thead>
					<tr>
						<th>Device ID</th>
						<th>Device Name</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$DBControlObject = new DBController();
					$rows = $DBControlObject->getDeviceList();
					if(count($rows)/2>0) {
						for($i=0; $i<count($rows)/2; $i++) {
								$rows1 = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
								$rows2 = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
				?> 					
					<tr>
						<td><?php echo $rows1?></td>
						<td><?php echo $rows2?></td>
					</tr>
				<?php 
						}
					}
				?>
				</tbody>

				<thead>
					<tr>
						<th>Device ID</th>
						<th>Device Name</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if (count($rows)>count($rows)/2+1){
						for($i=count($rows)/2+1; $i<count($rows); $i++) {
								$rows3 = ICONV("EUC-KR","UTF-8",$rows[$i][0]);
								$rows4 = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
				?> 					
					<tr>
						<td><?php echo $rows3?></td>
						<td><?php echo $rows4?></td>
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