$(document).ready(function(){
	$('#ui_view').load("dashboard.html");
	
	$('#dashboard').click(function(){
		$('#ui_view').load("dashboard.html");
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
		$('#ui_view').load("permission_view.php", function() {
			$('#toRightAllDevice').click(function(){
				$('#device option').each(function() {
					$(this).remove().appendTo('#selected_device');
				});
			});
			
			$('#toRightSelectedDevice').click(function(){
				$('#device option:selected').each(function() {
					$(this).remove().appendTo('#selected_device');
				});
			});
			
			$('#toLeftSelectedDevice').click(function(){
				$('#selected_device option:selected').each(function() {
					$(this).remove().appendTo('#device');
				});
			});
			
			$('#toLeftAllDevice').click(function(){
				$('#selected_device option').each(function() {
					$(this).remove().appendTo('#device');
				});
			});
			
			$('#toRightAllUser').click(function(){
				$('#user option').each(function() {
					$(this).remove().appendTo('#selected_user');
				});
			});
			
			$('#toRightSelectedUser').click(function(){
				$('#user option:selected').each(function() {
					$(this).remove().appendTo('#selected_user');
				});
			});
			
			$('#toLeftSelectedUser').click(function(){
				$('#selected_user option:selected').each(function() {
					$(this).remove().appendTo('#user');
				});
			});
			
			$('#toLeftAllUser').click(function(){
				$('#selected_user option').each(function() {
					$(this).remove().appendTo('#user');
				});
			});
		});
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