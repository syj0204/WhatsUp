
<?php require("basic_templete.html")?>
    
    <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Permission
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Main</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Permission
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

				<div class="row">
					<div class="col-lg-12">
               		<label>Devices</label>
				</div>
                <div class="row">
                    <div class="col-xs-4">
					<select name="device" id="device" class="form-control" size="10" multiple="multiple">
						<?php

							include "C:\Sites\whatsup\MVC\Controller\Database.php";

							$DBObject = new Database();
							$connection=$DBObject->connectDB();
							if($connection) {
								$query = "SELECT nDeviceID, sDisplayName FROM device";
								$statement = $DBObject->executeQuery($query);

									while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
						?>
										<option value=<?php $row[0]?>>
						<?php
										echo $row[1]." <br> \n";
									}
						?>
										</option>
						<?php
									}
						?>
					</select>
					</div>

					<div class="col-xs-2">
						<!-- <button type="button" id="delete" class="btn btn-primary btn-block">delete</button> -->
						<button type="button" id="toRightAllDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
						<button type="button" id="toRightSelectedDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
						<button type="button" id="toLeftSelectedDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
						<button type="button" id="toLeftAllDevice" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
						<!-- <button type="button" id="reset" class="btn btn-warning btn-block">reset</button> -->
					</div>

					<div class="col-xs-4">
						<select name="selected_device" id="selected_device" class="form-control" size="12" multiple="multiple"></select>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-12">
               		<label>Users</label>
				</div>
                <div class="row">
                    <div class="col-xs-4">
					<select name="user" id="user" class="form-control" size="10" multiple="multiple">
						<?php
							if($connection) {
								$query = "SELECT nUserID, sUserName FROM users";
								$statement = $DBObject->executeQuery($query);

									while( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_NUMERIC)) {
						?>
										<option value=<?php $row[0]?>>
						<?php
										echo $row[1]." <br> \n";
									}
						?>
										</option>
						<?php

								$DBObject->disconnectDB();
							}
						?>
					</select>
					</div>

					<div class="col-xs-2">
						<!-- <button type="button" id="delete" class="btn btn-primary btn-block">delete</button> -->
						<button type="button" id="toRightAllUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-forward"></i></button>
						<button type="button" id="toRightSelectedUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
						<button type="button" id="toLeftSelectedUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
						<button type="button" id="toLeftAllUser" class="btn btn-default btn-block"><i class="glyphicon glyphicon-backward"></i></button>
						<!-- <button type="button" id="reset" class="btn btn-warning btn-block">reset</button> -->
					</div>

					<div class="col-xs-4">
						<select name="selected_user" id="selected_user" class="form-control" size="12" multiple="multiple"></select>
					</div>
					
					<div class="row">
					<div class="col-lg-12">
               		<button type="button" id="register" class="btn btn-primary btn-block">Register</button>
				</div>
				</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/multiselect.js"></script>
	<script type="text/javascript">
	$(function(){

		$("#toRightAllDevice").on("click",function(){
			$('#device option').each( function() {
			$(this).remove().appendTo('#selected_device');
			});
		});

		$("#toRightSelectedDevice").on("click",function(){
			$('#device option:selected').each( function() {
				$(this).remove().appendTo('#selected_device');
			});
		});

		$("#toLeftAllDevice").on("click",function(){
			$('#selected_device option').each( function() {
				$(this).remove().appendTo('#device');
			});
		});

		$("#toLeftSelectedDevice").on("click",function(){
			$('#selected_device option:selected').each( function() {
				$(this).remove().appendTo('#device');
			});
		});


		$("#toRightAllUser").on("click",function(){
			$('#user option').each( function() {
				$(this).remove().appendTo('#selected_user');
			});
		});

		$("#toRightSelectedUser").on("click",function(){
			$('#user option:selected').each( function() {
				$(this).remove().appendTo('#selected_user');
			});
		});

		$("#toLeftAllUser").on("click",function(){
			$('#selected_user option').each( function() {
				$(this).remove().appendTo('#user');
			});
		});

		$("#toLeftSelectedUser").on("click",function(){
			$('#selected_user option:selected').each( function() {
				$(this).remove().appendTo('#user');
			});
		});

		$("#register").on("click",function(){
			var device = "";
			var user = "";
			$('#selected_device option').each( function() {
				device += device + $(this).val() + ",";
			});
			$('#selected_user option').each( function() {
				user += user + $(this).val() + ",";
			});
			var form_data = {
					device: $device,
					user: $user
			};
	
			$.ajax({
				type: 'POST',
				url: '"C:\Sites\whatsup\MVC\Controller\PermissionControl.php',
				data: form_data,
				
				success: function(response) {
					console.log(response);
				}
			});
		});

	});

	$(window).load(function(e){

	});

	</script>

	</body>

	</html>

