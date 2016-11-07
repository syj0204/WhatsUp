$(document).ready(function(){
	$('#ui_view').load("dashboard.html");
	
	$('#device').click(function(){
		$('#ui_view').load("dashboard.html");
		return false;
	});
	$('#user').click(function(){
		$('#ui_view').load("user_view.php");
		return false;
	});
	$('#permission').click(function(){
		$('#ui_view').load("chart.html");
		return false;
	});
	$('#search').click(function(){
		$('#ui_view').load("chart.html");
		return false;
	});
	
});