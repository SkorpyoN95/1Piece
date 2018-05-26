<?php
include_once 'controller/controller.php';

class MainController extends Controller
{
	public function index()
	{
		$model = $this->loadModel('main');
		$lvl = $model->checkLvl();
		if($lvl != 0)
		{
			$win = $this->loadView('window');
			$win->createWindow('okno', '%' , 47, 42, 16, 6, 'Gratulacje! <br>Awansowałeś na '.$lvl.' lvl!');
			$win->showWindow('okno');
		}
		$model->updateBars();
		$model->updateBStats();
		$model->regeneration();
		$model->online();
	}
}
?>