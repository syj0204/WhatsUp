<!--  현재 적용 완료되어서 사용되지 않는 파일 입니다. -->
<!DOCTYPE HTML>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$("button").click(function(){
		var value = $('#user_search_text').val(); 
		$.post("test_post.php",{ 
			name: value
		}, 
			function(data,status){

			$("div#div1").html(data);
			});		
	});

});

	</script>

	</head>


	<body>
	<input id="user_search_text" type="text" class="form-control" placeholder="Search for...">
	
	<button> post() button</button>
	<div id="div1">
	
	</body>






	</html>