<?php
include_once 'controller/controller.php';

class FightController extends Controller
{
	public function index()
	{
		$view = $this->loadView('fight');
		$model = $this->loadModel('fight');
		
		if(isset($_GET['eob'])) 
			if($model->endOfBattle() == 1) $this->redirect('main.php?action=map');
		
		$wynik2 = $model->select('fights', 'is_pvm', 'id='.$_SESSION['zalogowany']);
		$is_pvm = $wynik2[0]['is_pvm'];
		
		if($is_pvm == 0) $this->redirect('main.php');
		
		if(isset($_POST['fight'])) $model->attack($_POST['tech']);
		$model->checkBattleStatus();
		$wynik3 = $model->select('fights', 'is_end', 'id='.$_SESSION['zalogowany']);
		$is_end = $wynik3[0]['is_end'];
		if($is_end == false)
			$view->displayBattle();
		else
			$view->displayEoB();
	}
}
?>