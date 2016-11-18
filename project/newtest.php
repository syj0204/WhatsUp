<?php
	include "DBController.php"; 
	$han="템플릿명을 입력하세요";
	$han = ICONV("EUC-KR","UTF-8",$han);
	$han1="선택한 템플릿에 포함된 디바이스 정보";
	$han1 = ICONV("EUC-KR","UTF-8",$han1);
	$han2="사용자 선택(다중선택 Ctrl+클릭)";
	$han2 = ICONV("EUC-KR","UTF-8",$han2);
	$han3="템블릿 선택";
	$han3 = ICONV("EUC-KR","UTF-8",$han3);
	$han4="템블릿 적용";
	$han4 = ICONV("EUC-KR","UTF-8",$han4);
	
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#enter').click(function(){
		var list_size = $('#list1 option:selected').size();		//list1에 선택된 값의 수를 전달함
		alert(list_size);
	    var list_save = new Array();	// jquery에서  배열을 선언하기 위해서 new릉 이용해서 Array를 생성
	    var list_string1=""
		//var list_select = $('#list1').val();
		for(var i=0; i<list_size; i++) {		
			 list_save[i] = $('#list1 option:eq('+i+')').val();	
			 var list_string = list_save[i]+",";
			 var list_string1 = list_string1 + list_string;
		}		//list1 에서 선택된 다수의 값을 전달 받기위해서 option:eq를 이용하여서 값을 전달 받음
		alert(list_string1);
		var temp_select = $('#list10 option:selected').val(); //Template 선택한 list에서 값을 전달 받음
		alert(temp_select);
		$.post("newtest1.php",{  
			list:list_string1,
			size: list_size,
			temp: temp_select
			},  //		post를 이용하여 newtest1.php -> 3개의 값을 전달
		
			function(data,status) {
				alert(data);		//전송 여부를 위해서  alert를 띄어서 확인
			}
		);
	});

	$('#list10').change(function(){		// Template른 선택하기 위한 list
		var template_select = $('#list10 option:selected').val();
		$('#list20 option').remove();
		alert(template_select);
		$.post("test3.php",{
			category:template_select
			}, 
			function(data,status) {
				var data_by_list1 = data.split('|'); // DB에서 받은 값을 |을 구분으로 나눠서 저장
				for(var i=0; i<data_by_list1.length-1; i++) {
					var value = data_by_list1[i].split(','); // 한번 나눠진 값을 다시 ,으로 구분하여서 나눠 저장
					$('#list20').append("<option value="+value[1]+">"+value[1]+","+value[2]+"</option>");		// 저장된 값을 list20에 나눠서 표시함
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
        		<select name="list1" id="list1" class="form-control" size="25" multiple="multiple" >
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
						?> <!-- 사용자 리스트를 띄우기 위해 DB에 접근하여 리스트 호출 -->
					</option>
				</select>
		
        		</div>
			<!-- /.col-xs-4 -->			

			<div class="col-xs-6"> 
				<label id="list10_title"><?php echo $han3?></label>
					<div class="form-group input-group">
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
				
