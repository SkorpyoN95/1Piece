<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<link rel="shortcut icon" href="/templates/img/favicon.ico" type="image/x-icon">
<link rel="icon" href="/templates/img/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="templates/css/basestyle.css" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="templates/css/popupstyle.css" />
<link rel="stylesheet" type="text/css" href="templates/css/menu.css" />
<title>Grand Line</title>
<style type="text/css">
div.slot
{
width: 90px; 
height: 90px; 
background-color: #a0a0a0;
border: solid 5px #1a1a1a; 
border-radius: 30px;
z-index: 3;
overflow: hidden;
}

div.slot2
{
width: 60px; 
height: 60px; 
background-color: #a0a0a0;
border: solid 5px #1a1a1a; 
border-radius: 10px;
z-index: 3;
overflow: hidden;
}
</style>
<script type="text/javascript">
$(document).ready(function()
{
	$("#ChatText").keyup(function(e)
	{
		if(e.keyCode == 13)
		{
			var ChatText = $("#ChatText").val();
			$.ajax(
			{
				type: "POST",
				url: "main.php",
				data: {ChatText: ChatText},
				success: function()
				{
					$("#ChatText").val("");
					$('#Messages').load('chat.php', {"page":<? if(isset($_GET['chat'])) echo $_GET['chat']; else echo 0;?>} );
				},
				complete : function(r) {	},
				error:    function(error) {    }
			});
			//$('#Messages').load('message.php');
		}
	});
	
	$("#ChatButton").click(function()
	{
			var ChatText = $("#ChatText").val();
			$.ajax(
			{
				type: "POST",
				url: "main.php",
				data: {ChatText: ChatText},
				success: function()
				{
					$("#ChatText").val("");
					$('#Messages').load('chat.php', {"page":<? if(isset($_GET['chat'])) echo $_GET['chat']; else echo 0;?>});
				},
				complete : function(r) {	},
				error:    function(error) {    }
			});
			//$('#Messages').load('message.php');
	});
	
	var interval = setInterval(function(){$('#Messages').load('chat.php', {"page":<? if(isset($_GET['chat'])) echo $_GET['chat']; else echo 0;?>});}, 3000);
});
</script>
<script type="text/javascript">
$(function(){
	
	$("input:text[name=currentValue]").attr('readonly', false);
	
	$("#slider").slider({ 
		max: 10,
		min: 1,
		slide: function(event, ui) {
			$("input:text[name=currentValue]").val(ui.value);
		}
	});
	
	$("input:text[name=currentValue]").attr('readonly', true);
});
</script>
<?php
if(isset($_COOKIE['width']) && isset($_COOKIE['height']) && $_COOKIE['width'] > 1200)
{
	$width = $_COOKIE['width'];
	$height = $_COOKIE['height'];
}
else
{
	$width = 1200;
	$height = 1024;
}
?>
<div class="logo">
<img style="position:absolute; top: 0px; left: <?php echo ($width-800)/2; ?>px; width: 800px; height: 100%;" src="/templates/img/logo.png" alt="Grand Line"/>
<div id='newsId' style='position: absolute; top: 0px; left: <?php echo ($width-800)/2 + 800; ?>px; width: 200px; height: 100%;'></div>
</div>
</head>
<body>
<script type="text/javascript">
document.cookie = 'width=' + screen.width; 
document.cookie = 'height=' + screen.height;
</script>
<div style='position:absolute; top: 300px; left: <?php echo ($width-1200)/2;?>px; width: 1200px;'>