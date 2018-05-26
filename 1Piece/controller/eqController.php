<?php
include_once 'controller/controller.php';

class EqController extends Controller
{
	public function index()
	{
		$view = $this->loadView('eq');
		$model = $this->loadModel('eq');
		$wv = $this->loadView('window');
		
		if(isset($_GET['wear']))
		{
			/*$wear = $this->safeData($_GET['wear']);
			$state = $model->wearItem($wear);
			if(is_string($state))
			{
				$wv->createWindow('eq_box', '%', 47, 45, 10, 6, $state);
				$wv->showWindow('eq_box');
				$view->showEq();
			}
			else $view->showEq($state);*/
		}
		else
			if(isset($_GET['drop']))
			{
				/*$drop = $this->safeData($_GET['drop']);
				$state = $model->dropItem($drop);
				if(is_string($state))
				{
					$wv->createWindow('eq_box', '%', 47, 45, 10, 6, $state);
					$wv->showWindow('eq_box');
					$view->showEq();
				}
				else $view->showEq($state);*/
			}
			else
				if(isset($_GET['use']))
				{
					$use = $this->safeData($_GET['use']);
					$state = $model->useItem($use);
					if(is_string($state))
					{
						$wv->createWindow('eq_box', '%', 47, 45, 10, 6, $state);
						$wv->showWindow('eq_box');
						$view->showEq(7);
					}
					else $view->showEq(7);
				}
				else
					if(isset($_GET['part'])) $view->showEq( $this->safeData($_GET['part']) );
					else $view->showEq();
	}
}
?>