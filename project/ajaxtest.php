<!--  ���� ���� �Ϸ�Ǿ ������ �ʴ� ���� �Դϴ�. -->
<!DOCTYPE HTML>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$('#test').click(function(){
		var value = $('#user_search_text').val(); 
		$("div#div1").html(value);
	});

});

	</script>

	</head>


	<body>
	<input id="user_search_text" type="text"placeholder="Search for...">
	
	<button id ="test" > post() button</button>
	<div id="div1">
	
	</body>






	</html>