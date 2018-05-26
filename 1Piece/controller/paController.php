<?php
include_once 'controller/controller.php';

class PaController extends Controller
{
	public function index()
	{
		if($_SESSION['zalogowany'] != 1) $this->redirect('main.php');
		
		$view = $this->loadView('pa');
		$model = $this->loadModel('pa');
		if(isset($_POST['dnS'])) $model->addNews($_POST['dn1'], $_POST['dn2'], $_POST['dn3']);
		if(isset($_POST['nmS'])) $model->addMove($_POST['nm1'], $_POST['nm2'], $_POST['nm3'], $_POST['nm4'], $_POST['nm5'], $_POST['nm6'], $_POST['nm7'], $_POST['nm8'], $_POST['nm9']);
		if(isset($_GET['op'])) $view->$_GET['op']();
		else $view->choice();
	}
}
?>