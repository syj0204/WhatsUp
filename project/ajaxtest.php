
<!DOCTYPE HTML>
<html>
<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script>
$(document).ready(function(){
	$("button").click(function(){
		$.post("test_post.php",{ 
			name:"1"
		},
			function(data,status){

			$("div#div1").html(data);
			});		
	});

});

	</script>

	</head>


	<body>
	<button> post() button</button>
	<div id="div1">
	</div>
	</body>






	</html>