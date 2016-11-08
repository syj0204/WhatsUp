<?php

include "DBController.php";
?>

<!DOCTYPE html>
<html lang="kr">

<head>

<meta charset="euc-kr">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>WhatsUp SMS Setting</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/sb-admin.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="jquery-hover-dropdown-box.js"></script>
	<link rel="stylesheet" href="jquery-hover-dropdown-box.css" />

</head>


<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">WhatsUp SMS</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                        </li>
                        <li>
                            <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="#" id="dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#" id="user"><i class="fa fa-fw fa-edit"></i> User</a>
                    </li>
                    <li>
                        <a href="#" id="device"><i class="fa fa-fw fa-desktop"></i> Device</a>
                    </li>
                    <li>
                        <a href="#" id="permission"><i class="fa fa-fw fa-table"></i> Permission</a>
                    </li>
                    <li>
                        <a href="#" id="search"><i class="fa fa-fw fa-dashboard"></i> Search</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

       <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
User <small>Users Overview</small>
</h1>
<ol class="breadcrumb">
<li class="active">
<i class="fa fa-dashboard"></i> User
</li>
</ol>
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
<!-- <div id="morris-area-chart"></div> -->

<div class="row">
					<div class="col-lg-12">
               		<label>Devices</label>
				</div>
                <div class="row">
                    <div class="col-xs-4">
					<select name="device" id="device" class="form-control" size="10" multiple="multiple">
						<?php

							$DBControlObject = new DBController();
							$rows = $DBControlObject->getDeviceList();
							if(count($rows)>0) {
								for($i=0; $i<count($rows); $i++) {
									///$row = $rows[i]
						?>
									<option value=<?php $rows[$i][0]?>>
						<?php
										echo $rows[$i][1]." <br> \n";
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
							$rows = $DBControlObject->getUserList();
							if(count($rows)>0) {
								for($i=0; $i<count($rows); $i++) {
						?>
										<option value=<?php $rows[$i][0]?>>
						<?php
										echo $rows[$i][1]." <br> \n";
									}
						?>
										</option>
						<?php

								$DBControlObject->disconnectDB();
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
</div>
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script src="js/jqueryevent.js"></script>

</body>
<script type="text/javascript">

		$(function(){
			$('#toRightAllDevice').click(function(){
				$('#device option').each(function() {
					$(this).remove().appendTo('#selected_device');
				});
			});

			

		$(window).load(function(e){

		});

	</script>
</html>
