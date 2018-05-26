<?php
include_once 'controller/controller.php';

class OptionController extends Controller
{
	public function index()
	{
		if(isset($_POST['changeObject']))
		{
			$model = $this->loadModel('option');
			$info = $model->$_POST['changeObject']();
			$wv = $this->loadView('window');
			$wv->createWindow('infoBox', '%', 45, 40, 20, 5, $info);
			$wv->showWindow('infoBox');
		}
		$view = $this->loadView('option');
		$view->render('options');
	}
}
?>