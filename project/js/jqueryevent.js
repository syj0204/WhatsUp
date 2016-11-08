$(document).ready(function(){
	$('#ui_view').load("dashboard.php");
	
	$('#dashboard').click(function(){
		$('#ui_view').load("dashboard.php");
		return false;
	});	
	$('#device').click(function(){
		$('#ui_view').load("device_view.php");
		return false;
	});
	$('#user').click(function(){
		$('#ui_view').load("user_view.php");
		return false;
	});
	$('#permission').click(function(){
		$('#ui_view').load("permission_view.php");
		return false;
	});
	$('#search').click(function(){
		$('#ui_view').load("search_view.html");
		return false;
	});
	$('#user_edit').click(function(){
		//$('#ui_view').load("chart.html");
		return false;
	});
	$('#user_delete').click(function(){
		//$('#ui_view').load("chart.html");
		return false;
	});

});