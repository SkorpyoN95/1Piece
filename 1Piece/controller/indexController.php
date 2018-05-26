<?php
include 'controller/controller.php';

class IndexController extends Controller
{

	public function log_in($login, $pass)
	{
		$model = $this->loadModel('index');
		$wrong_info = $model->log_in($login, $pass);
		if($wrong_info == '') $this->redirect('/main.php');
		else 
		{
			$win = $this->loadView('window');
			$win->createWindow('okno', '%' , 47, 45, 10, 6, $wrong_info);
			$win->showWindow('okno');
		}
	}
	
	public function register($login, $pass, $pass2, $nick, $email)
	{
		$model = $this->loadModel('index');
		$raport = $model->register($login, $pass, $pass2, $nick, $email);
		$win = $this->loadView('window');
		$win->createWindow('okno', '%' , 47, 42, 16, 6, $raport);
		$win->showWindow('okno');
	}
	
	public function remind($email)
	{
		$model = $this->loadModel('index');
		$raport = $model->remind($email);
		$win = $this->loadView('window');
		$win->createWindow('okno', '%' , 47, 42, 16, 6, $raport);
		$win->showWindow('okno');
	}

	public function active($mail, $code)
	{
		$model = $this->loadModel('index');
		$raport = $model->active($mail, $code);
		$win = $this->loadView('window');
		$win->createWindow('okno', '%' , 47, 42, 16, 6, $raport);
		$win->showWindow('okno');
	}
	
	public function changePass($mail, $pass)
	{
		$model = $this->loadModel('index');
		$raport = $model->changePass($mail, $pass);
		$win = $this->loadView('window');
		$win->createWindow('okno', '%' , 47, 42, 16, 6, $raport);
		$win->showWindow('okno');
	}
}

?>