<?php 
//include "Database.php";
include "Search_user.php";

?>

<div id="page-wrapper">
<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
<h1 class="page-header">
User  Search
</h1>
	<ol class="breadcrumb">
   		<li>
        	<i class="fa fa-dashboard"></i> <a href="templete.html">Dashboard</a>
        </li>
        <li class="active">
            <i class="fa fa-edit"></i> User Search
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

<!-- 
	<li>
		<p>
        	<a href="javascript:;" data-toggle="collapse" data-target="#demo1" ><i class="btn btn-primary">Insert</i></a>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo2" ><i class="btn btn-success">Delete</i></a>     
            <a href="javascript:;" data-toggle="collapse" data-target="#demo3" ><i class="btn btn-info">Update</i></a>              	
         
        </p>
        	<form role="form" id="Insert_from" action="new.php", method="post">
   			 <ul id="demo1" class="collapse"  >
   			 	<li>
   			 		<input type="text" placeholder="Enter User" name="Insert_User">
        			<input type="text" placeholder="Enter CellPhone" name="Insert_CellPhone">
        			<input type="submit" class="btn btn-primary" value="Insert">
        		 </li>
       	     </ul>
       	     </form>
       	     <form role="form" id="Insert_from">
       	     <ul id="demo2" class="collapse"  >
   			 	<li>
   			 		<input type="text" placeholder="Enter User" id="Delete_User">
        			<input type="text" placeholder="Enter CellPhone" id="Delete_CellPhone">
        			<button type="button" class="btn btn-success" id="Delete_btn">Delete</button>
        		 </li>
       	     </ul>
       	     </form>
       	     <form role="form" id="Insert_from">
       	     <ul id="demo3" class="collapse"  >
   			 	<li>
   			 		<input type="text" placeholder="Enter User" id="Update_User">
        			<input type="text" placeholder="Enter CellPhone" id="Update_CellPhone">
        			<button type="button" class="btn btn-info" id="Update_btn">Update</button>
        		 </li>
       	     </ul>
       	     </form>
  	</li>
        -->	  
<!-- <div id="morris-area-chart"></div> -->
<div class="table-responsive">
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<!-- <th>check</th>  -->
				<th>Number</th>
				<th>User</th>
				<th>CellPhone</th>
			</tr>
		</thead>
<tbody>


<?php 

$UserObject = new User();
$rows = $UserObject->getUserList();


if(count($rows)>0) {
	for($i=0; $i<count($rows); $i++) {
		$rows1 = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
		?>
		<tr>
			
			
			 
			<!-- <td><input type = "checkbox" value =""></td> -->
			<td><?php echo $rows[$i][0]?></td>
			<td><?php echo $rows1?></td>
			<td><?php echo $rows[$i][2]?></td>
			
		</tr>
		<?php
		
	}
	//$UserObject->DBObject->disconnectDB();
}
else echo "fail!!";
?>


</tbody>
</table>
<!-- 유저 정보를 넣은 테이블 -->

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
				
				
				
				
				
				
<!-- 		
<script src="js/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	$(document).ready(function()
	{
		$('#Insert_btn').click(function()
		{
			var data1 = {request : $('#Insert_User').val()
			var data2 = {request : $('#Insert_CellPhone').val()
		};
		$.ajax({
			type:"Post",
			url: "new.php"
			data: data1, data2,
			success: function(data1, data2, dataType)
			{
				alert('ok');
			}
			error: function(XMLHttpRequest, textStatus, errorThrow)
			{
				alert('error');
			}
			});
		return false;
		});
	});
</script>
 -->		
				

		