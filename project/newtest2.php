
<?php
	include "DBController.php"; 
	$han="템플릿명을 입력하세요";
	$han = ICONV("EUC-KR","UTF-8",$han);
	$han1="선택한 템플릿에 포함된 디바이스 정보";
	$han1 = ICONV("EUC-KR","UTF-8",$han1);
	$han2="사용자 선택";
	$han2 = ICONV("EUC-KR","UTF-8",$han2);
	$han3="템블릿 선택";
	$han3 = ICONV("EUC-KR","UTF-8",$han3);
	$han4="템블릿 적용";
	$han4 = ICONV("EUC-KR","UTF-8",$han4);
	
?>
<link href="css/multiple-select.css" rel="stylesheet" type="text/css" />
<script src="js/multiple-select.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('#enter').click(function(){
		var list_size = $('#list1 option:selected').size();
		//alert(list_size);
		$('#list20 option').remove();
		var list_save = new Array();
		var list_string1= ""
		var temp_select = $('#list10 option:selected').val();
		if($('#list10 option:selected').val()=='-- Select Template --'){
			alert("Not Select Tmeplete.");
			$('#page-wrapper').load("newtest2.php");
		}
		else{
			if($('#list1 option:selected').size()==0){
				alert("Not Select User");
				$('#page-wrapper').load("newtest2.php");
			}
			else{
		for(var i=0; i<list_size; i++) {
			list_save[i] = $('#list1 option:selected:eq('+(i)+')').val();
			var list_string = list_save[i]+",";
			var list_string1 = list_string1 + list_string; 
		 }
		// alert(list_string1);
		
		//alert(temp_select);
		$.post("newtest1.php",{
			list: list_string1,
			size: list_size,
			temp: temp_select
			}, 
		
			function(data,status) {
				if(status=='fail'){alert(status);};
			}
		);
		$('#page-wrapper').load("newtest2.php");
			}
		}
	});

	$('#list10').change(function(){
		var template_select = $('#list10 option:selected').val();
		$('#list20 option').remove();
		//alert(template_select);
		$.post("test3.php",{
			category:template_select
			}, 
			function(data,status) {
				var test = data.substring(2);
				//alert(test);
				var data_by_category = test.split('|');
				//alert(data_by_category[3]);
				data_by_category.sort();
				for(var i=0; i<data_by_category.length; i++) {
					var value = data_by_category[i].split(',');
					$('#list20').append("<option value="+value[1]+">"+value[0]+" / ["+value[2]+"] </option>");
					//alert(value[1]);
				}
			}
		);
	});

    $('#list1').multipleSelect({
        isOpen: true,
        keepOpen: true,
        minimumCountSelected: 7
    });
	
});
</script>

<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Templates Match</h1>
			
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Templates Match</h3>
					</div>
					<div class="panel-body">
    					<div class="row">
					    	<div class="col-xs-12" >
					        	<div class="col-xs-5" >
					        		<label id="list1_title"><?php echo $han2?></label><br>
					        		<select multiple="multiple" name="list1" id="list1" class="form-control" >
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
								<div class="col-xs-1"><div><label ></label><br></div>
								</div>
								<div class="col-xs-6"> 
									<label id="list10_title"><?php echo $han3?></label>
									<div class="form-group input-group">
									   <select name="list10" id="list10" class="form-control">
							       			<option>-- Select Template --</option>
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
										</select>
										<span class="input-group-btn"><button id="enter" class="btn btn-success" type="button"><?php echo $han4?></button></span>
									</div>
									<div class="col-xs-12">
										<label id="list20_title"><?php echo $han1?></label>
										<select name="list20" id="list20" class="form-control" size="23.5"></select>		
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





