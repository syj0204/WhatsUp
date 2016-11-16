<?php
	include "DBController.php"; 
	$han="템플릿명을 입력하세요";
	$han = ICONV("EUC-KR","UTF-8",$han);
?>
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
	<h1 class="page-header">Select</h1>
	<ol class="breadcrumb">
		<li class="active"><i class="fa fa-dashboard"></i>Select</li>
	</ol>
</div>
</div>

<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Select Template</h3>
	</div>
	<div class="panel-body">
	<!-- <div id="morris-area-chart"></div> -->


		<!-- <div class="col-lg-12">
    		<label>Permission Search</label>
		</div> -->
    	<div class="row">
        	<div class="col-xs-6">
        		<select name="list1" id="list1" class="form-control"  >
        			<option>--Select Device Group --</option>
						<?php $DBControlObject = new DBController();
							  $rows = $DBControlObject->DeviceGroupsView();
								if(count($rows)>0) {		
									for($i=0; $i<count($rows); $i++) {
									$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][2]);
						?>
					<option value=<?php echo $rows[$i][0]?>>      		 		
						<?php
										echo "Device / " .$device_name." <br> \n";
									}
								}
						?>
					</option>
				</select>
					
					<br>
				<select name="list2" id="list2" class="form-control" size="10" ></select>
        		</div>
			<!-- /.col-xs-4 -->			

			<div class="col-xs-6">
			   <select name="list10" id="list10" class="form-control">
        			<option>--Select Template --</option>
						<?php $DBControlObject = new DBController();
							  $rows = $DBControlObject->getSelecttemp();// 초기 Template select문에 나타내는 것
								if(count($rows)>0) {		
									for($i=0; $i<count($rows); $i++) {
									$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
						?>
					<option value=<?php echo $rows[$i][0]?>>      		 		
						<?php
										echo "Template / " .$device_name." <br> \n";
									}
								}8
						?>
					</option>
			   </select>
				<input type="textbox" id="Temp_Name" style="display: none"></input><button id="enter_temp" style="display: none" >enter_temp</button></input><button id="close" style="display: none" >close</button>
				<br><button id="select_temp">select_temp</button>
				<button id="delete_temp">delete_temp</button>
				<button id="add_temp">add_temp</button>
				
				

				<select name="list20" id="list20" class="form-control" size="25"></select>
				
				
			</div>
			<!-- /.col-xs-4 -->	
	
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
				
