<?php
	include "DBController.php"; 
	$han="템플릿명을 입력하세요";
	$han = ICONV("EUC-KR","UTF-8",$han);
	$han1="선택한 템플릿에 저장된 디바이스";
	$han1 = ICONV("EUC-KR","UTF-8",$han1);
	$han2="수정";
	$han2 = ICONV("EUC-KR","UTF-8",$han2);
	$han3="삭제";
	$han3 = ICONV("EUC-KR","UTF-8",$han3);
	$han4="추가";
	$han4 = ICONV("EUC-KR","UTF-8",$han4);
	$han5="템플릿 선택";
	$han5 = ICONV("EUC-KR","UTF-8",$han5);
	$han6="템플릿 생성";
	$han6 = ICONV("EUC-KR","UTF-8",$han6);
	$han7="취소";
	$han7 = ICONV("EUC-KR","UTF-8",$han7);
	$han8="디바이스 그룹 선택";
	$han8 = ICONV("EUC-KR","UTF-8",$han8);
	$han9="선택한 디바이스 그룹내 리스트";
	$han9 = ICONV("EUC-KR","UTF-8",$han9);
	
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#add_temp').click(function(){
			$('#list20 option').remove();
			$('#select_temp').hide();
			$('#delete_temp').hide();
			$('#list10').hide();
			$('#add_temp').hide();
			$('#enter_temp').show();
			$('#Temp_Name').show();
			$('#close').show();
			
		});
		$('#close').click(function(){
			$('#list20 option').remove();
			$('#select_temp').show();
			$('#delete_temp').show();
			$('#add_temp').show();
			$('#list10').show();
			$('#enter_temp').hide();
			$('#Temp_Name').hide();
			$('#close').hide();

		});
		$('#list1').change(function(){
			//initSelectBoxes();
			var selected_category = $('#list1 option:selected').val();
			$('#list2 option').remove();
			//$('#list2_title').text($('#list1 option:selected').text()+" List");
			
			alert(selected_category);
			$.post("category.php",{
				category:selected_category
				}, 
				function(data,status) {
					var data_by_category = data.split('|');
					for(var i=0; i<data_by_category.length-1; i++) {
						var value = data_by_category[i].split(',');
						$('#list2').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");
					}
				}
			);
		});
		$('#select_temp').click(function(){

		    var list_save = new Array();
		    var list_string1=""
			var list_size = $('#list20 option').size();
			alert(list_size);

			var Temp = $('#list10 option:selected').val();
			alert(Temp);
			//for(var j=0 j<list_size; j++){
				for(var i=0; i<list_size; i++) {
					 list_save[i] = $('#list20 option:eq('+i+')').val();	
					 var list_string = list_save[i]+",";
					 var list_string1 = list_string1 + list_string;
				}
				
			//}
			 alert(list_string1);
			$.post("test4.php",{
				name:Temp,
				category:list_string1
				}, 
				function(data,status) {
					alert(status);
				}
			);
		});
		$('#delete_temp').click(function(){
			$('#list20 option').remove();
		  //  var list_save = new Array();
		    //var list_string1=""
			//var list_size = $('#list20 option').size();
			//alert(list_size);
			var Temp = $('#list10 option:selected').val();
			alert(Temp);
			//for(var j=0 j<list_size; j++){
			/*	for(var i=0; i<list_size; i++) {
					 list_save[i] = $('#list20 option:eq('+i+')').val();	
					 var list_string = list_save[i]+",";
					 var list_string1 = list_string1 + list_string;
				}
			*/	
			//}
			 //alert(list_string1);
			$.post("test5.php",{
				name:Temp,
				//category:list_string1
				}, 
				function(data,status) {
					alert(status);
				}
			);
		});
		
		
		$('#enter_temp').click(function(){
	    var list_save = new Array();
	    var list_string1=""
		var list_size = $('#list20 option').size();
		alert(list_size);

		var Temp = $('#Temp_Name').val();
		alert(Temp);
		//for(var j=0 j<list_size; j++){
			for(var i=0; i<list_size; i++) {
				 list_save[i] = $('#list20 option:eq('+i+')').val();	
				 var list_string = list_save[i]+",";
				 var list_string1 = list_string1 + list_string;
			}
			
		//}
		 alert(list_string1);
		$.post("test2.php",{
			name:Temp,
			category:list_string1
			}, 
			function(data,status) {
				alert(data);
			}
		);
		
	});
	
		
		$('#list2').change(function(){
			var to_add_item = $('#list2 option:selected').text();
			var to_add_item1 = $('#list2 option:selected').val();
			//alert(to_add_item);
			$('#list20').append("<option value="+to_add_item1+">"+to_add_item+"</option>");
			//to_add_list.push(to_add_item);
		
	});

		$('#list20').change(function(){
			var to_add_item1 = $('#list20 option:selected').remove();
			//alert(to_add_item);
			$('#list20').append("<option value="+to_add_item1+">"+to_add_item+"</option>");
			//to_add_list.push(to_add_item);
		
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
		$(window).load(function(e){

		});

		
	});
		</script>






<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
<div class="col-lg-12">
	<h1 class="page-header">Template </h1>

</div>
</div>

<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Setting Template</h3>
	</div>
	<div class="panel-body">
	<!-- <div id="morris-area-chart"></div> -->


		<!-- <div class="col-lg-12">
    		<label>Permission Search</label>
		</div> -->
    	<div class="row">
        	<div class="col-xs-6">
        	  <label id="list1_title"><?php echo $han8?></label>
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
				<label id="list2_title"><?php echo $han9?></label>
				<select name="list2" id="list2" class="form-control" size="25" ></select>
        		</div>
			<!-- /.col-xs-4 -->			

			<div class="col-xs-6">
			<label id="list10_title"><?php echo $han5?></label>
			 <div class="form-group input-group ">
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
										echo $device_name." <br> \n";
									}
								}
						?>
					</option>
			   </select><span class="input-group-btn">
				<button id="select_temp" class="btn btn-success" type="button"><?php echo $han2?></button>
				<button id="delete_temp" class="btn btn-success" type="button"><?php echo $han3?></button>
				<button id="add_temp" class="btn btn-success" type="button"><?php echo $han4?></button></span>
				<input type="textbox" id="Temp_Name" class="form-control panel-yellow" placeholder="Enter Template Name ~" style="display: none"></input>
				<span class="input-group-btn">
				<button id="enter_temp" class="btn btn-success" type="button" style="display: none" ><?php echo $han6?></button>
				<button id="close" class="btn btn-success" type="button" style="display: none" ><?php echo $han7?></button></span>
				</div>
				<label id="list20_title"><?php echo $han1?></label>
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



