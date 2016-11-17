<?php
include "DBController.php";

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#add_temp').click(function(){
			var Temp = $('#Temp_Name').val();
			alert(Temp);

			/*$.post("action1.php",{
				name:Temp,
				}, 
				function(data,status) {
					alert(status);
				}
			);*/
		});
	});
</script>

<button id="add_temp" class="btn btn-success" type="button">enter</button></span>
<input type="textbox" id="Temp_Name" class="form-control panel-yellow" placeholder="15556"></input>
