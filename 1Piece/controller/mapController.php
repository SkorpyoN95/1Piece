<?php
include_once 'controller/controller.php';

class MapController extends Controller
{
	public function index()
	{
		$model = $this->loadModel('map');
		$view = $this->loadView('map');
		$wv = $this->loadView('window');
		
		if(isset($_POST['items']) && $_POST['gold'])
		{
			$model->sellItems($_POST['items'], $_POST['gold']);
		}
		
		if(isset($_POST['currentValue']) && isset($_POST['weight']))
		{
			$raport = $model->startTrain($_POST['currentValue'], $_POST['weight'], $_POST['atr']);
			if($raport != '')
			{
				$wv->createWindow('train', '%', 45, 42, 16, 10, $raport); 
				$wv->showWindow('train');
			}
		}
		
		if(isset($_GET['h']))
		{
			$model->startBattle($_GET['h']);
		}
		
		if(isset($_GET['break']))
		{
			$model->breakTraining();
		}
		
		$wynik = $model->select('training', 'is_train', 'id='.$_SESSION['zalogowany']);
		$is_train = $wynik[0]['is_train'];
		
		$wynik2 = $model->select('fights', 'is_pvm', 'id='.$_SESSION['zalogowany']);
		$is_pvm = $wynik2[0]['is_pvm'];
		
		if($is_pvm == 1) $this->redirect('main.php?action=fight');
		
		if($is_train == 1)
		{	
			$wynik = $model->select('training', 'end', 'id='.$_SESSION['zalogowany']);
			$end = $wynik[0]['end'];
			$now = time();
			if($now >= $end)
			{
				echo '<p style="text-align: center; font-weight: bolder; font-size: 30px;">Trening dobiegł końca.<img src="/templates/img/Stages/youtrain.jpg"/></p><p style="text-align: center; font-weight: bolder; font-size: 20px;"><a href="main.php?action=stats&eot">Zakończ</a></p>';
			}else
			{
				$time = $end - $now;
				$h = (int)($time/3600);
				$time -= $h*3600;
				$m = (int)($time/60);
				$time -= $m*60;
				$s = $time;
				
				echo '<p style="text-align: center; font-weight: bolder; font-size: 30px;">Aktualnie trenujesz.</p>';
				echo '<p style="text-align: center; font-weight: bolder; font-size: 20px;"><img src="/templates/img/Stages/youtrain.jpg"/><br>';
				echo 'Będziesz jeszcze trenować przez: '.$h.' godzin, '.$m.' minut i '.$s.' sekund';
				echo '<br><a href="main.php?action=map&break">Przerwij</a><br>(złoto nie zostanie zwrócone)</p>';
			}
		}
		else
			if(isset($_GET['city']))
			{
				$city = $this->safeData($_GET['city']);
				switch($city)
				{
					case 1: if(isset($_POST['meat']) && $_POST['meat'] > 0) {$raport = $model->buyMeat($_POST['meat']); $wv->createWindow('bar1', '%', 45, 42, 16, 10, $raport); $wv->showWindow('bar1');}
							if(isset($_POST['sake']) && $_POST['sake'] > 0) {$raport = $model->buySake($_POST['sake']); $wv->createWindow('bar2', '%', 45, 42, 16, 10, $raport); $wv->showWindow('bar2');}
							$view->barView(); break;
					case 2: if(isset($_GET['train'])) $view->letsTrain($_GET['train']);
							else $view->trainingView(); break;
					case 3: if($_GET['shop'] == 1) $view->buySth();
							else if($_GET['shop'] == 2) 
								{
									$part = 1;
									if(isset($_GET['part'])) $part = $_GET['part'];
									$view->sellSth($part);
								}
								 else $view->shopView(); break;
					default: $view->render('map'); break;
				}
			}
			else
				if(isset($_GET['habit']))
				{
					$view->render('map');
				}
				else $view->render('map');
				
		if(isset($_POST['sell']) && isset($_POST['offerButton']))
			{
				$view->dialog($_POST['sell']);
			}
	}
}
?>