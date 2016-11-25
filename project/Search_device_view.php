<?php
	include "DBController.php";?>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>

</script>
</head>
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
					
					<div class="panel-heading"  >
					<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Device List
					</h3> 
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6">

  							</div>
  						</div>  	        									<br>					
						<div class="row">
                   			<div class="col-lg-6">

                       			 <div class="table-responsive">
                            		<table class="table table-bordered table-hover" id="user_list_table">
										<thead>
											<th style="text-align:center; "class="bg-primary">Device List(1) </th>


										</thead>
    									<tbody>
										<?php 
										$test = "test";
										$DBControlObject = new DBController();
										$rows = $DBControlObject->getDeviceList();
										$cnt = count($rows);
											if(count($rows)>0) {
												for($i=0; $i<count($rows)/2; $i++) {
													$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
										?>
                                    <tr>
                                        <td align="center"><?php echo $device_name;?></td>
                                    </tr>
										<?php	
													}
										?>
                                		</tbody>
                           			 </table>
                           			 	</div>

                    		</div>
                   		 <div class="col-lg-6">

					 			   <div class="table-responsive">
                            		<table class="table table-bordered table-hover" id="user_list_table">	

										<thead>
											<th style="text-align:center; "class="bg-primary"> Device List(2)</td>
										</thead>
    									<tbody>
    									<?php 
    											for($i=count($rows)/2; $i<count($rows); $i++) {
    												$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
    											
    									?>
                                   		 <tr>
                                   		 
                                        	<td align="center"><?php echo $device_name;?></td>
                                    	</tr>
										
										<?php 
												}
										?>

										
										</tbody>
                           			 	</table>
                           			 	
								 	

                        		</div>
                        		
                     		 </div>
                     		 <div id="div1" > </div> 
                    	 </div>


					<?php	
							}
					?>	

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

</div>

