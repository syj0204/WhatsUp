<?php
include "permission.php";
?>
<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
Permission <small>Permission Overview</small>
</h1>
<ol class="breadcrumb">
<li class="active">
<i class="fa fa-dashboard"></i> Permission
</li>
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
                    <div class="col-xs-4">
					<select name="device" id="device" class="form-control" size="10" multiple="multiple">
						<?php

							$DBControlObject = new DBController();
							$rows = $DBControlObject->getDeviceList();
							if(count($rows)>0) {
								for($i=0; $i<count($rows); $i++) {
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
							$rows = $DBControlObject->getUserList();
							if(count($rows)>0) {
								for($i=0; $i<count($rows); $i++) {
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

<div class="row">
<!-- <div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Donut Chart</h3>
</div>
<div class="panel-body">
<div id="morris-donut-chart"></div>
<div class="text-right">
<a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
</div>
</div> -->
<div class="col-lg-4">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
</div>
<div class="panel-body">
<div class="list-group">
<a href="#" class="list-group-item">
<span class="badge">just now</span>
<i class="fa fa-fw fa-calendar"></i> Calendar updated
</a>
<a href="#" class="list-group-item">
<span class="badge">4 minutes ago</span>
<i class="fa fa-fw fa-comment"></i> Commented on a post
</a>
<a href="#" class="list-group-item">
<span class="badge">23 minutes ago</span>
<i class="fa fa-fw fa-truck"></i> Order 392 shipped
</a>
<a href="#" class="list-group-item">
<span class="badge">46 minutes ago</span>
<i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
</a>
<a href="#" class="list-group-item">
<span class="badge">1 hour ago</span>
<i class="fa fa-fw fa-user"></i> A new user has been added
</a>
<a href="#" class="list-group-item">
<span class="badge">2 hours ago</span>
<i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
		</a>
		<a href="#" class="list-group-item">
		<span class="badge">yesterday</span>
		<i class="fa fa-fw fa-globe"></i> Saved the world
		</a>
		<a href="#" class="list-group-item">
		<span class="badge">two days ago</span>
		<i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
				</a>
				</div>
				<div class="text-right">
				<a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
				</div>
				</div>
				</div>
				</div>
				<div class="col-lg-4">
				<div class="panel panel-default">
				<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
				</div>
				<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
				<th>Order #</th>
				<th>Order Date</th>
				<th>Order Time</th>
				<th>Amount (USD)</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>3326</td>
				<td>10/21/2013</td>
				<td>3:29 PM</td>
				<td>$321.33</td>
				</tr>
				<tr>
				<td>3325</td>
				<td>10/21/2013</td>
				<td>3:20 PM</td>
				<td>$234.34</td>
				</tr>
				<tr>
				<td>3324</td>
				<td>10/21/2013</td>
				<td>3:03 PM</td>
				<td>$724.17</td>
				</tr>
				<tr>
				<td>3323</td>
				<td>10/21/2013</td>
				<td>3:00 PM</td>
				<td>$23.71</td>
				</tr>
				<tr>
				<td>3322</td>
				<td>10/21/2013</td>
				<td>2:49 PM</td>
				<td>$8345.23</td>
				</tr>
				<tr>
				<td>3321</td>
				<td>10/21/2013</td>
				<td>2:23 PM</td>
				<td>$245.12</td>
				</tr>
				<tr>
				<td>3320</td>
				<td>10/21/2013</td>
				<td>2:15 PM</td>
				<td>$5663.54</td>
				</tr>
				<tr>
				<td>3319</td>
				<td>10/21/2013</td>
				<td>2:13 PM</td>
				<td>$943.45</td>
				</tr>
				</tbody>
				</table>
				</div>
				<div class="text-right">
				<a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
				</div>
				</div>
				</div>
				</div>
				<div class="col-lg-4">
				<div class="panel panel-default">
				<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Permission Panel</h3>
				</div>
				<div class="panel-body">
				<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
				<thead>
				<tr>
				<th>User #</th>
				<th>Order Date</th>
				<th>Order Time</th>
				<th>Amount (USD)</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td>3326</td>
				<td>10/21/2013</td>
				<td>3:29 PM</td>
				<td>$321.33</td>
				</tr>
				<tr>
				<td>3325</td>
				<td>10/21/2013</td>
				<td>3:20 PM</td>
				<td>$234.34</td>
				</tr>
				<tr>
				<td>3324</td>
				<td>10/21/2013</td>
				<td>3:03 PM</td>
				<td>$724.17</td>
				</tr>
				<tr>
				<td>3323</td>
				<td>10/21/2013</td>
				<td>3:00 PM</td>
				<td>$23.71</td>
				</tr>
				<tr>
				<td>3322</td>
				<td>10/21/2013</td>
				<td>2:49 PM</td>
				<td>$8345.23</td>
				</tr>
				<tr>
				<td>3321</td>
				<td>10/21/2013</td>
				<td>2:23 PM</td>
				<td>$245.12</td>
				</tr>
				<tr>
				<td>3320</td>
				<td>10/21/2013</td>
				<td>2:15 PM</td>
				<td>$5663.54</td>
				</tr>
				<tr>
				<td>3319</td>
				<td>10/21/2013</td>
				<td>2:13 PM</td>
				<td>$943.45</td>
				</tr>
				</tbody>
				</table>
				</div>
				<div class="text-right">
				<a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
				</div>
				</div>
				</div>
				</div>
				</div>
				<!-- /.row -->

				</div>
				<!-- /.container-fluid -->

				</div>
				<!-- /#page-wrapper -->