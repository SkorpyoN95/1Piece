<?php
include_once 'controller/controller.php';

class StatsController extends Controller
{
	public function index()
	{
		$model = $this->loadModel('stats');
		$view = $this->loadView('stats');
		$model->checkStatsArray();
		
		if(isset($_GET['eot']))	
		{
			$result = $model->endOfTraining();
			if($result != '')
			{
				$wv = $this->loadView('window');
				$wv->createWindow('effect', '%', 45, 40, 20, 10, $result);
				$wv->showWindow('effect');
			}
		}
		
		$text = $model->checkStats($stats);
		if($text)
		{
			$wv = $this->loadView('window');
			$wv->createWindow('stats', '%', 45, 40, 20, 10, $text);
			$wv->showWindow('stats');
		}
		$text2 = $model->checkProfs();
		if($text2)
		{
			$wv = $this->loadView('window');
			$wv->createWindow('profs', '%', 45, 40, 20, 10, $text2);
			$wv->showWindow('profs');
		}
		$stats = $model->getStats();
		$view->showStats($stats);
	}
}
?>