<?php
include_once 'controller/controller.php';

class TechqsController extends Controller
{
	public function index()
	{
		if(isset($_GET['techq']))
		{
			$techq = $this->safeData($_GET['techq']);
			$model = $this->loadModel('techqs');
			$info = $model->setTechnique($techq);
			$wv = $this->loadView('window');
			$wv->createWindow('techq', '%', 47, 40, 20, 6, $info);
			$wv->showWindow('techq');
		}
		$view = $this->loadView('techqs');
		$view->render('techqs');
	}
}
?>