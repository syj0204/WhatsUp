<?php
	include "DBController.php"; 
	$han="���ø����� �Է��ϼ���";
	$han = ICONV("EUC-KR","UTF-8",$han);
	$han1="������ ���ø��� ���Ե� ����̽� ����";
	$han1 = ICONV("EUC-KR","UTF-8",$han1);
	$han2="����� ����(���߼��� Ctrl+Ŭ��)";
	$han2 = ICONV("EUC-KR","UTF-8",$han2);
	$han3="�ۺ��� ����";
	$han3 = ICONV("EUC-KR","UTF-8",$han3);
	$han4="�ۺ��� ����";
	$han4 = ICONV("EUC-KR","UTF-8",$han4);
	
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#enter').click(function(){
		var list_size = $('#list1 option:selected').size();
		alert(list_size);
	    var list_save = new Array();
	    var list_string1=""
		//var list_select = $('#list1').val();
		for(var i=0; i<list_size; i++) {
			 list_save[i] = $('#list1 option:eq('+i+')').val();	
			 var list_string = list_save[i]+",";
			 var list_string1 = list_string1 + list_string;
		}
		alert(list_string1);
		var temp_select = $('#list10 option:selected').val();
		alert(temp_select);
		$.post("newtest1.php",{
			list:list_string1,
			size: list_size,
			temp: temp_select
			}, 
		
			function(data,status) {
				alert(data);
			}
		);
	});

	$('#list10').change(function(){
		var template_select = $('#list10 option:selected').val();
		$('#list20 option').remove();
		alert(template_select);
		$.post("test3.php",{
			category:template_select
			}, 
			function(data,status) {
				var data_by_list1 = data.split('|');
				for(var i=0; i<data_by_list1.length-1; i++) {
					var value = data_by_list1[i].split(',');
					$('#list20').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
				}
			}
		);
	
});

	
});
</script>

<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
	<h1 class="page-header">Match</h1>

</div>
</div>

<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Match User/Template</h3>
	</div>
	<div class="panel-body">
	<!-- <div id="morris-area-chart"></div> -->


		<!-- <div class="col-lg-12">
    		<label>Permission Search</label>
		</div> -->
    	<div class="row">
        	<div class="col-xs-6">
        		<label id="list1_title"><?php echo $han2?></label>
        		<select name="list1" id="list1" class="form-control " size="25" multiple="multiple" >
						<?php $DBControlObject = new DBController();
							  $rows = $DBControlObject->getUserList();
								if(count($rows)>0) {		
									for($i=0; $i<count($rows); $i++) {
									$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
						?>
					<option value=<?php echo $rows[$i][0]?>>      		 		
						<?php
										echo $device_name." <br> \n";
									}
								}
						?>
					</option>
				</select>
		
        		</div>
			<!-- /.col-xs-4 -->			

			<div class="col-xs-6"> 
				<label id="list10_title"><?php echo $han3?></label>
					<div class="form-group input-group">
					   <select name="list10" id="list10" class="form-control panel-yellow"">
		        			<option>--Select Template --</option>
								<?php $DBControlObject = new DBController();
									  $rows = $DBControlObject->getSelecttemp();// �ʱ� Template select���� ��Ÿ���� ��
										if(count($rows)>0) {		
											for($i=0; $i<count($rows); $i++) {
											$device_name = ICONV("EUC-KR","UTF-8",$rows[$i][1]);
								?>
							<option value=<?php echo $rows[$i][0]?>>      		 		
								<?php
												echo "Template / " .$device_name." <br> \n";
											}
										}
								?>
							</option>
					   </select>
					   <span class="input-group-btn"><button id="enter" class="btn btn-success" type="button"><?php echo $han4?></button></span>
					 </div>
			</div>
			<div class="col-xs-6">
				
				
				<label id="list20_title"><?php echo $han1?></label>
				<select name="list20" id="list20" class="form-control" size="23.5"></select>
				
				
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
				