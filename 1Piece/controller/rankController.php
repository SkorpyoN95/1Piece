<?php
include_once 'controller/controller.php';

class RankController extends Controller
{
	public function index()
	{
		$page = $this->safeData($_GET['page']);
		$model = $this->loadModel('rank');
		$data = $model->getRank();
		$view = $this->loadView('rank');
		$view->showRank($data, $page);
	}
}
?>