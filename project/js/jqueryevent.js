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
		$('#ui_view').load("search_view.php");
		return false;
	});
	$('#Search_user_view').click(function(){
		$('#ui_view').load("Search_user_view.php");
		return false;
	});
	$('#Search_device_view').click(function(){
		$('#ui_view').load("Search_device_view.php");
		return false;
	});
	
});