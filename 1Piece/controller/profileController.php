<?php
include_once 'controller/controller.php';

class ProfileController extends Controller
{
	public function showProfile($id, $mode=1)
	{
		$model = $this->loadModel('profile');
		$data = $model->showProfile($id, $mode);
		$view = $this->loadView('profile');
		$view->showProfile($data, $mode);
	}
}
?>