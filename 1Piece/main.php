<?php include('templates/header.html.php'); ?>

<?php
if(isset($_SESSION['zalogowany']))
{
include('controller/mainController.php');
$main_cont = new MainController();
$main_cont->index();
if(isset($_GET['logout']))
{
	unset($_SESSION['zalogowany']);
	$main_cont->redirect('index.php');
}
$main_view = $main_cont->loadView('main');
$main_view->render('menu');
?>
<div style="position: absolute; left: 0px; top: 200px; width: 720px; min-height: 100%; background-color: #660000; padding: 20px 40px; border: solid 3px #ffffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ffffff; color: #ffffff; font-size: 18px;">
<?php
if(isset($_GET['action']))
{
	$action = $main_cont->safeData($_GET['action']);
	$ob = $main_cont->loadController($action);
	$ob->index();
}
else
{
	if(isset($_GET['id']))
	{
		include('controller/profileController.php');
		$pc = new ProfileController();
		$id = $pc->safeData($_GET['id']);
		$pc->showProfile($id, 0);
	}
	else
	{
		include('controller/profileController.php');
		$pc = new ProfileController();
		$pc->showProfile($_SESSION['zalogowany']);
	}
}
$main_view->newsIcon();
$main_view->checkPW();
?>
</div>

<div style="position: absolute; left: 815px; top: 200px; width: 305px; min-height: 100%; background-color: #660000; padding: 20px 40px; border: solid 3px #ffffff; border-radius: 50px; box-shadow: 0px 0px 20px 2px #ffffff;">
<? 
$main_view->whoOnline();
$chat_con = $main_cont->loadController('chat'); 
?>
<input type="text" id="ChatText" name="ChatText"/> <button id="ChatButton" style="width: 100px; height: 20px;">Wyślij</button>
<div id="Messages" style="width: 305px; min-height: 400px;">
<?php
if(isset($_GET['chat'])) $page = $chat_con->safeData($_GET['chat']);
else $page = 0;
$chat_con->index($page);
?>
</div>
</div>
<?php
}
else
{
	?><p style="position: absolute; top: 100px; left: 75px; color: #ffffff; font-size: 32px;">Nie jesteś zalogowany! <a href='index.php' style='color: #ffffff;'>Powrót</a></p><?php
}

?>
<div id="leftProfile" style="position: fixed; z-index: 9999; left: -340px; top: 20px; width: 300px; background-color: #660000; padding: 20px 20px; border: solid 3px #ffffff; border-top-right-radius: 50px; border-bottom-right-radius: 50px; box-shadow: 0px 0px 20px 2px #ffffff; color: #ffffff;"
		onmouseenter="$('#leftProfile').animate({left: [-10, 'easeOutQuart']}, 1000);" onmouseleave="$('#leftProfile').animate({left: [-340, 'easeOutQuart']}, 1000);">
<?php
$main_view->leftProfil();
?>
</div>
<?php include('templates/footer.html.php'); ?>